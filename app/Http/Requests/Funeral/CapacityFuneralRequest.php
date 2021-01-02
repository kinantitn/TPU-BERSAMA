<?php

namespace App\Http\Requests\Funeral;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CapacityFuneralRequest extends FormRequest
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
            'class_a' => ['required', 'numeric', 'min:1'],
            'class_b' => ['required', 'numeric', 'min:1'],
            'class_c' => ['required', 'numeric', 'min:1'],
        ];
    }
    public function attributes()
    {
        return [
            'class_a' => 'Kelas A',
            'class_b' => 'Kelas B',
            'class_c' => 'Kelas C',
        ];
    }
}
