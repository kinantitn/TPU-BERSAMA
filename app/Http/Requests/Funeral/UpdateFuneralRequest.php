<?php

namespace App\Http\Requests\Funeral;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\WhatsappRule;

class UpdateFuneralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'numeric', new WhatsappRule],
            'address' => ['required', 'string', 'max:255'],
            'maps' => ['required', 'string', 'url'],
            'price_a' => ['required', 'numeric', 'min:1'],
            'price_b' => ['required', 'numeric', 'min:1'],
            'price_c' => ['required', 'numeric', 'min:1'],
            'area_class_a' => ['nullable', 'array'],
            'area_class_b' => ['nullable', 'array'],
            'area_class_c' => ['nullable', 'array'],
            'image' => ['nullable', 'file', 'image', 'max:10240'],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nama TPU',
            'area' => 'wilayah',
            'whatsapp' => 'whatsapp',
            'address' => 'alamat',
            'maps' => 'maps',
            'price_a' => 'harga kelas A',
            'price_b' => 'harga kelas B',
            'price_c' => 'harga kelas C',
            'area_class_a' => 'lahan kelas A',
            'area_class_b' => 'lahan kelas B',
            'area_class_c' => 'lahan kelas C',
            'image' => 'foto',
        ];
    }
}
