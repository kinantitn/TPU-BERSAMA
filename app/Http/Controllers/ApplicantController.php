<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\Helpers;
use App\Models\Order;
use App\Models\Funeral;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Status\CancelOrderRequest;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware(function ($request, $next) {
            if (Helpers::checkRole(['admin'])) {
                return $next($request);
            }
        });
    }

    public function index()
    {
        $orders = Order::with('users','funerals')->latest()->get();
        return view('applicant.index')->with('orders', $orders);
    }

    public function detail($id)
    {
        $order = Order::where('id',$id)->with('users','funerals')->first();
        return view('applicant.detail')->with('order', $order);
    }
    public function cancel(CancelOrderRequest $request)
    {
        $token = $request['token'];
        $order = Order::where('token', $token)->first();
        if ($order['payment_status'] !== 'PAID' && $order['status'] !== 'CANCEL') {
            if ($order['status'] !== 'COMPLETE') {
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
                return Helpers::successRedirect('applicant.detail', 'Permohonan berhasil dibatalkan!', ['id' => $order['id'] ]);
            }
        }
        return Helpers::errorRedirect('applicant.detail','Permohonan tidak dapat dibatalkan!', ['id' => $order['id'] ]);
    }
    public function confirm($id)
    {
        $order = Order::where('id', $id)->first();
        if ($order['status'] === 'PENDING') {
            $order->update([
                'status' => 'CONFIRM'
            ]);
            return Helpers::successRedirect('applicant.detail','Permohonan berhasil dikonfirmasi!', ['id' => $order['id'] ]);
        }
        return Helpers::errorRedirect('applicant.detail','Permohonan tidak dapat dikonfirmasi!', ['id' => $order['id'] ]);
    }
    public function complete($id)
    {
        $order = Order::where('id', $id)->first();
        if ($order['status'] === 'ARRIVE') {
            $order->update([
                'status' => 'COMPLETE'
            ]);
            return Helpers::successRedirect('applicant.detail','Permohonan berhasil diselesaikan!', ['id' => $order['id'] ]);
        }
        return Helpers::errorRedirect('applicant.detail','Permohonan tidak dapat diselesaikan!', ['id' => $order['id'] ]);
    }
}
