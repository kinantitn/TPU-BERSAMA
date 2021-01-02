<?php

namespace App\Http\Controllers;

use App\Models\Funeral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utilities\Helpers;
use App\Http\Requests\Funeral\CapacityFuneralRequest;
use App\Http\Requests\Funeral\CreateFuneralRequest;
use App\Http\Requests\Funeral\UpdateFuneralRequest;
use Illuminate\Support\Facades\Crypt;

class FuneralController extends Controller
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
        $funerals = Funeral::latest()->get();
        $funerals = collect($funerals)->map(function ($item, $key) {
            $class_a = Crypt::decrypt($item['area_class_a']);
            $class_a_available = collect($class_a)->where('available', true)->count();
            $class_b = Crypt::decrypt($item['area_class_b']);
            $class_b_available = collect($class_b)->where('available', true)->count();
            $class_c = Crypt::decrypt($item['area_class_c']);
            $class_c_available = collect($class_c)->where('available', true)->count();
            $value = $item;
            $value['capacity'] = count($class_a)+count($class_b)+count($class_c);
            $value['available'] = $class_a_available+$class_b_available+$class_c_available;
            return $value;
        });
        return view('funeral.index')->with('funerals', $funerals);
    }
    public function createForm(CapacityFuneralRequest $request)
    {
        $data = [];
        $data['class_a'] = $request['class_a'];
        $data['class_b'] = $request['class_b'];
        $data['class_c'] = $request['class_c'];
        return view('funeral.create')->with('data', $data);
    }
    public function create(CreateFuneralRequest $request)
    {
        $data = [];
        $dir = env('DIR_IMAGE_FUNERAL', 'funeral/');
        $image = Str::lower(Str::slug($request['name'])).'-'.Str::random(20).'.'.$request['image']->getClientOriginalExtension();
        $data['name'] = Str::upper($request['name']);
        $data['area'] = $request['area'];
        $data['whatsapp'] = $request['whatsapp'];
        $data['address'] = $request['address'];
        $data['maps'] = $request['maps'];
        $data['price_a'] = $request['price_a'];
        $data['price_b'] = $request['price_b'];
        $data['price_c'] = $request['price_c'];
        $data['image'] = $image;
        $area_class_a = collect($request['area_class_a'])->map(function($item, $key) {
            $value['type'] = $item;
            $value['available'] = true;
            return $value;
        });
        $area_class_b = collect($request['area_class_b'])->map(function($item, $key) {
            $value['type'] = $item;
            $value['available'] = true;
            return $value;
        });
        $area_class_c = collect($request['area_class_c'])->map(function($item, $key) {
            $value['type'] = $item;
            $value['available'] = true;
            return $value;
        });
        $data['area_class_a'] = Crypt::encrypt($area_class_a);
        $data['area_class_b'] = Crypt::encrypt($area_class_b);
        $data['area_class_c'] = Crypt::encrypt($area_class_c);
        $funeral = Funeral::create($data);
        $request->file('image')->storeAs("public/{$dir}{$funeral['id']}", $data['image']);
        return Helpers::successRedirect('funeral','Berhasil menambahkan TPU!');
    }
    public function detail($id)
    {
        $funeral = Funeral::find($id);
        $data['funeral'] = $funeral;
        $data['area_class_a'] = Crypt::decrypt($funeral['area_class_a']);
        $data['area_class_b'] = Crypt::decrypt($funeral['area_class_b']);
        $data['area_class_c'] = Crypt::decrypt($funeral['area_class_c']);
        return view('funeral.detail')->with('data', $data);
    }
    public function update($id, UpdateFuneralRequest $request)
    {
        $data = [];
        $dir = env('DIR_IMAGE_FUNERAL', 'funeral/');
        $funeral = Funeral::find($id);
        $area_class_a = Crypt::decrypt($funeral['area_class_a']);
        $area_class_b = Crypt::decrypt($funeral['area_class_b']);
        $area_class_c = Crypt::decrypt($funeral['area_class_c']);
        $data['name'] = Str::upper($request['name']);
        $data['area'] = $request['area'];
        $data['whatsapp'] = $request['whatsapp'];
        $data['address'] = $request['address'];
        $data['maps'] = $request['maps'];
        $data['price_a'] = $request['price_a'];
        $data['price_b'] = $request['price_b'];
        $data['price_c'] = $request['price_c'];
        $data['area_class_a'] = Crypt::encrypt($area_class_a->map(function($item, $key) use ($request) {
            $area_class = collect($request['area_class_a']);
            foreach ($area_class as $key_class => $value_class) {
                if ($key === $key_class) {
                    $item['type'] = $value_class;
                }
            }
            return $item;
        }));
        $data['area_class_b'] = Crypt::encrypt($area_class_b->map(function($item, $key) use ($request) {
            $area_class = collect($request['area_class_b']);
            foreach ($area_class as $key_class => $value_class) {
                if ($key === $key_class) {
                    $item['type'] = $value_class;
                }
            }
            return $item;
        }));
        $data['area_class_c'] = Crypt::encrypt($area_class_c->map(function($item, $key) use ($request) {
            $area_class = collect($request['area_class_c']);
            foreach ($area_class as $key_class => $value_class) {
                if ($key === $key_class) {
                    $item['type'] = $value_class;
                }
            }
            return $item;
        }));
        if ($request->has('image')) {
            $image = Str::lower(Str::slug($request['name'])).'-'.Str::random(20).'.'.$request['image']->getClientOriginalExtension();
            $data['image'] = $image;
            $request->file('image')->storeAs("public/{$dir}{$funeral['id']}", $data['image']);
        }
        $funeral->update($data);
        return Helpers::successRedirect('funeral.detail','Berhasil menambahkan TPU!', ['id' => $id]);
    }
}
