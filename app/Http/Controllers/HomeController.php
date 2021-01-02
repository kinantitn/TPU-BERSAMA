<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Http\Requests\Profile\UpateProfileRequest;
use App\Http\Requests\Profile\UpatePasswordRequest;
use App\Utilities\Helpers;
use App\Models\Order;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        $data = [];
        $user = auth()->user();
        if ($user['role'] === 'admin') {
            $total_transaction = Order::count();
            $pending_payment = Order::where([
                'payment_status' => 'PENDING',
            ])->whereNotIn('status' ,['CANCEL','COMPLETE'])->count();
            $history_transaction = Order::with('funerals')->latest()->take(5)->get();
        } else {
            $total_transaction = Order::where('user_id', $user['id'])->count();
            $pending_payment = Order::where([
                'user_id' => $user['id'],
                'payment_status' => 'PENDING',
            ])->whereNotIn('status' ,['CANCEL','COMPLETE'])->count();
            $history_transaction = Order::with('funerals')->where('user_id', $user['id'])->latest()->take(5)->get();
        }
        $data['total_transaction']  = $total_transaction;
        $data['pending_payment']  = $pending_payment;
        $data['history_transaction']  = $history_transaction;
        return view('dashboard.index')->with('data', $data);
    }

    public function updateProfile(UpateProfileRequest $request)
    {
        $data = [];
        $user = auth()->user();
        $data['name'] = $request['name'];
        User::findOrFail($user['id'])->update($data);
        return Helpers::successRedirect('home','Berhasil merubah profil!');
    }

    public function updatePassword(UpatePasswordRequest $request)
    {
        $data = [];
        $data['password'] = Hash::make($request['new_password']);
        $user = auth()->user();
        $check_password = User::findOrFail($user['id']);
        if (Hash::check($request['old_password'], $check_password['password'])) {
            $check_password->update($data);
        } else {
            return Helpers::errorRedirect('home','Password lama anda tidak cocok!');
        }
        return Helpers::successRedirect('home','Berhasil merubah password!');
    }
}
