<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PickTPURequest extends FormRequest
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
            'id' => ['required', 'numeric', 'exists:funerals,id'],
            'customer_type' => ['required', 'string'],
            'class_tpu' => ['required', 'string']
        ];
    }
    public function attributes()
    {
        return [
            'id' => 'id',
            'customer_type' => 'jenis jenazah',
            'class_tpu' => 'kelas',
        ];
    }
}
