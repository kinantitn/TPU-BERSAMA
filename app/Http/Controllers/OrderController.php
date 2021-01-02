<?php

namespace App\Http\Controllers;

use App\Models\Funeral;
use App\Models\Order;
use App\Utilities\Helpers;
use App\Http\Requests\Order\PickTPURequest;
use App\Http\Requests\Order\FormOrderRequest;
use App\Http\Requests\Order\CreateOrderRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
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

    public function index(Request $request)
    {
        if ($request->has('area')) {
            $funerals = Funeral::with('ratings')->where('area', $request['area'])->latest()->get();
        } else {
            $funerals = Funeral::with('ratings')->latest()->get();
        }
        return view('order.index')->with('funerals', $funerals);
    }

    public function form($id, FormOrderRequest $request)
    {
        $data = [];
        $data['customer_type'] = $request['customer_type'];
        $data['class_tpu'] = $request['class_tpu'];
        $data['pick_tpu'] = $request['pick_tpu'];
        $data['funeral'] = Funeral::find($id);
        $area_class = config('constants.class_tpu')[$data['class_tpu']];
        $type_tpu = Crypt::decrypt($data['funeral'][$area_class['area_table']]);
        $data['funeral']['funeral_number'] = $request['pick_tpu'];
        $data['funeral']['funeral_type'] = config('constants.type_tpu')[$type_tpu[$request['pick_tpu']]['type']]['name'];
        $data['funeral']['funeral_class'] = $area_class['param'];
        $data['funeral']['funeral_price'] = (float) $data['funeral'][$area_class['price_table']];
        $data['funeral']['funeral_tax'] = (float) $data['funeral']['funeral_price']*0.1;
        $data['funeral']['funeral_total_price'] = $data['funeral']['funeral_price'] + $data['funeral']['funeral_tax'];
        return view('order.form')->with('data', $data);
    }

    public function pickTPU(PickTPURequest $request)
    {
        $data = [];
        $data['id'] = $request['id'];
        $data['customer_type'] = $request['customer_type'];
        $data['class_tpu'] = $request['class_tpu'];
        $data['funeral'] = Funeral::find($data['id']);
        $area_class = config('constants.class_tpu')[$data['class_tpu']];
        $data['slot_funeral'] = Crypt::decrypt($data['funeral'][$area_class['area_table']]);
        return view('order.pick_tpu')->with('data', $data);
    }

    public function create($id, CreateOrderRequest $request)
    {
        $data = [];
        $dir = env('DIR_IMAGE_ORDER', 'order/');
        $user = auth()->user();
        $funeral = Funeral::find($id);
        $area_class = config('constants.class_tpu')[$request['class_tpu']];
        $type_tpu = Crypt::decrypt($funeral[$area_class['area_table']]);
        $funeral_price = (float) $funeral[$area_class['price_table']];
        $funeral_tax = (float) $funeral_price*0.1;
        $funeral_number = $request['pick_tpu'];
        $data['user_id'] = $user['id'];
        $data['status'] = 'PENDING';
        $data['payment_status'] = 'PENDING';
        $data['payment_file'] = null;
        $data['total_price'] = $funeral_price + $funeral_tax;
        $data['token'] = Str::random(80);
        $data['customer_type'] = $request['customer_type'];
        $data['name_applicant'] = $request['name_applicant'];
        $data['phone_applicant'] = $request['phone_applicant'];
        $data['funeral_relation'] = $request['funeral_relation'];
        $data['name_funeral'] = $request['name_funeral'];
        $data['age_funeral'] = $request['age_funeral'];
        $data['gender_funeral'] = $request['gender_funeral'];
        $data['religion_funeral'] = $request['religion_funeral'];
        $data['address_funeral'] = $request['address_funeral'];
        $data['date_funeral'] = Carbon::parse($request['date_funeral'])->format('Y-m-d');
        $data['payment_method'] = $request['payment_method'];
        $data['funeral_id'] = $id;
        $data['funeral_type'] = $type_tpu[$funeral_number]['type'];
        $data['funeral_class'] = $area_class['value'];
        $data['funeral_number'] = $funeral_number;
        $data['name_heir'] = $request['name_heir'];
        $data['address_heir'] = $request['address_heir'];
        $data['funeral_relation_heir'] = $request['funeral_relation_heir'];

        //FILE
        if ($request->has('identity_applicant')) {
            $data['identity_applicant'] = 'identity_applicant.'.$request['identity_applicant']->getClientOriginalExtension();
            $request->file('identity_applicant')->storeAs("public/{$dir}/{$data['token']}", $data['identity_applicant']);
        }
        if ($request->has('family_applicant')) {
            $data['family_applicant'] = 'family_applicant.'.$request['family_applicant']->getClientOriginalExtension();
            $request->file('family_applicant')->storeAs("public/{$dir}/{$data['token']}", $data['family_applicant']);
        }
        if ($request->has('identity_funeral')) {
            $data['identity_funeral'] = 'identity_funeral.'.$request['identity_funeral']->getClientOriginalExtension();
            $request->file('identity_funeral')->storeAs("public/{$dir}/{$data['token']}", $data['identity_funeral']);
        }
        if ($request->has('certificate_funeral')) {
            $data['certificate_funeral'] = 'certificate_funeral.'.$request['certificate_funeral']->getClientOriginalExtension();
            $request->file('certificate_funeral')->storeAs("public/{$dir}/{$data['token']}", $data['certificate_funeral']);
        }
        if ($request->has('permit_life_funeral')) {
            $data['permit_life_funeral'] = 'permit_life_funeral.'.$request['permit_life_funeral']->getClientOriginalExtension();
            $request->file('permit_life_funeral')->storeAs("public/{$dir}/{$data['token']}", $data['permit_life_funeral']);
        }
        if ($request->has('family_funeral')) {
            $data['family_funeral'] = 'family_funeral.'.$request['family_funeral']->getClientOriginalExtension();
            $request->file('family_funeral')->storeAs("public/{$dir}/{$data['token']}", $data['family_funeral']);
        }
        if ($request->has('identity_heir')) {
            $data['identity_heir'] = 'identity_heir.'.$request['identity_heir']->getClientOriginalExtension();
            $request->file('identity_heir')->storeAs("public/{$dir}/{$data['token']}", $data['identity_heir']);
        }
        if ($request->has('family_heir')) {
            $data['family_heir'] = 'family_heir.'.$request['family_heir']->getClientOriginalExtension();
            $request->file('family_heir')->storeAs("public/{$dir}/{$data['token']}", $data['family_heir']);
        }
        if ($request->has('not_capable_funeral')) {
            $data['not_capable_funeral'] = 'not_capable_funeral.'.$request['not_capable_funeral']->getClientOriginalExtension();
            $request->file('not_capable_funeral')->storeAs("public/{$dir}/{$data['token']}", $data['not_capable_funeral']);
        }
        Order::create($data);
        $update_funeral = collect($type_tpu)->map(function ($item, $key) use ($funeral_number) {
            if ($key === $funeral_number) {
                $item['available'] = false;
            }
            return $item;
        });
        $funeral->update([
            $area_class['area_table'] => Crypt::encrypt($update_funeral)
        ]);
        return Helpers::successRedirect('status','Permohonan berhasil diajukan, tunggu konfirmasi selama 3x24 jam!');
    }
}
