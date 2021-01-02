<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\Helpers;
use App\Models\Order;
use App\Models\Funeral;
use App\Models\RatingFuneral;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Status\PaymentOrderRequest;
use App\Http\Requests\Status\CancelOrderRequest;
use App\Http\Requests\Status\CompleteOrderRequest;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware(function ($request, $next) {
            if (Helpers::checkRole(['user'])) {
                return $next($request);
            }
        });
    }
    public function index()
    {
        $user = auth()->user();
        $orders = Order::with('users','funerals')->where('user_id' , $user['id'])->latest()->get();
        return view('status.index')->with('orders', $orders);
    }
    public function cancel(CancelOrderRequest $request)
    {
        $token = $request['token'];
        $order = Order::where('token', $token)->first();
        if ($order['payment_status'] === 'PENDING' && $order['status'] === 'PENDING') {
            $funeral_number = $order['funeral_number'];
            $funeral = Funeral::find($order['funeral_id']);
            $area_class = config('constants.class_tpu')[$order['funeral_class']];
            $type_tpu = Crypt::decrypt($funeral[$area_class['area_table']]);
            $update_funeral = collect($type_tpu)->map(function ($item, $key) use ($funeral_number) {
                if ($key === $funeral_number) {
                    $item['available'] = true;
                }
                return $item;
            });
            $order->update([
                'status' => 'CANCEL'
            ]);
            $funeral->update([
                $area_class['area_table'] => Crypt::encrypt($update_funeral)
            ]);
            return Helpers::successRedirect('status','Permohonan berhasil dibatalkan!');
        }
        return Helpers::errorRedirect('status','Permohonan tidak dapat dibatalkan!');
    }
    public function payment(PaymentOrderRequest $request)
    {
        $data = [];
        $dir = env('DIR_IMAGE_ORDER', 'order/');
        $token = $request['token'];
        $order = Order::where('token', $token)->first();
        $data['payment_status'] = 'PAID';
        $data['payment_file'] = 'payment.'.$request['payment']->getClientOriginalExtension();
        $request->file('payment')->storeAs("public/{$dir}/{$token}", $data['payment_file']);
        $order->update($data);
        return Helpers::successRedirect('status','Bukti pembayaran berhasil di upload!');
    }
    public function arrive(CancelOrderRequest $request)
    {
        $token = $request['token'];
        $order = Order::where('token', $token)->first();
        if ($order['status'] === 'CONFIRM') {
            $order->update([
                'status' => 'ARRIVE'
            ]);
            return Helpers::successRedirect('status','Permohonan berhasil di update!', ['id' => $order['id'] ]);
        }
        return Helpers::errorRedirect('status','Terjadi kesalahan!', ['id' => $order['id'] ]);
    }
    public function complete(CompleteOrderRequest $request)
    {
        $token = $request['token'];
        $order = Order::where('token', $token)->first();
        if ($order['status'] === 'ARRIVE') {
            $order->update([
                'status' => 'COMPLETE'
            ]);
            RatingFuneral::create([
                'funeral_id' => $order['funeral_id'],
                'rating' => $request['rating'],
            ]);
            return Helpers::successRedirect('status','Permohonan berhasil di selesaikan!', ['id' => $order['id'] ]);
        }
        return Helpers::errorRedirect('status','Terjadi kesalahan!', ['id' => $order['id'] ]);
    }
}
