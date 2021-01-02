<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\WhatsappRule;

class CreateOrderRequest extends FormRequest
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
            'funeral_id' => ['required', 'numeric', 'exists:funerals,id'],
            'customer_type' => ['required', 'string', 'max:255'],
            'class_tpu' => ['required', 'string', 'max:255'],
            'pick_tpu' => ['required', 'string', 'max:255'],
            'name_applicant' => ['required', 'string', 'max:255'],
            'phone_applicant' => ['required', 'numeric', new WhatsappRule],
            'funeral_relation' => ['required', 'string', 'max:255'],
            'name_funeral' => ['required', 'string', 'max:255'],
            'age_funeral' => ['required', 'numeric', 'min:1'],
            'gender_funeral' => ['required', 'string', 'max:255'],
            'religion_funeral' => ['required', 'string', 'max:255'],
            'address_funeral' => ['required', 'string', 'max:255'],
            'date_funeral' => ['required', 'date', 'date_format:m/d/Y'],
            'payment_method' => ['required', 'string', 'max:255'],

            'identity_applicant' => ['required', 'file', 'max:10240'],
            'family_applicant' => ['required', 'file', 'max:10240'],
            'identity_funeral' => ['required', 'file', 'max:10240'],
            'certificate_funeral' => ['nullable', 'file', 'max:10240'],

            'permit_life_funeral' => ['required_if:customer_type,WNA,KELUARGA_MISKIN', 'file', 'max:10240'],

            'family_funeral' => ['required_if:customer_type,WARGA_JAKARTA', 'file', 'max:10240'],

            'name_heir' => ['required_if:customer_type,WARGA_LUAR_JAKARTA', 'string', 'max:255'],
            'address_heir' => ['required_if:customer_type,WARGA_LUAR_JAKARTA', 'string', 'max:255'],
            'funeral_relation_heir' => ['required_if:customer_type,WARGA_LUAR_JAKARTA', 'string', 'max:255'],
            'identity_heir' => ['required_if:customer_type,WARGA_LUAR_JAKARTA', 'file', 'max:10240'],
            'family_heir' => ['required_if:customer_type,WARGA_LUAR_JAKARTA', 'file', 'max:10240'],

            'not_capable_funeral' => ['required_if:customer_type,KELUARGA_MISKIN', 'file', 'max:10240'],
        ];
    }
    public function attributes()
    {
        return [
            'funeral_id' => 'TPU',
            'customer_type' => 'jenis jenazah',
            'class_tpu' => 'kelas',
            'pick_tpu' => 'lahan',
            'name_applicant' => 'nama pemohon',
            'phone_applicant' => 'nohp pemohon',
            'funeral_relation' => 'hubungan dengan jenazah',
            'name_funeral' => 'nama jenazah',
            'age_funeral' => 'usia',
            'gender_funeral' => 'jenis kelamin',
            'religion_funeral' => 'agama',
            'address_funeral' => 'alamat',
            'date_funeral' => 'tanggal meninggal',
            'payment_method' => 'metode pembayaran',

            'identity_applicant' => 'KTP/Paspor pemohon',
            'family_applicant' => 'KK pemohon',
            'identity_funeral' => 'KTP/Paspor jenazah',
            'certificate_funeral' => 'surat kematian',

            'permit_life_funeral' => 'kartu izin tinggal jenazah',
            'family_funeral' => 'KK jenazah',

            'name_heir' => 'nama ahli waris',
            'address_heir' => 'alamat ahli waris',
            'funeral_relation_heir' => 'hubungan dengan jenazah',
            'identity_heir' => 'KTP/Paspor ahli waris',
            'family_heir' => 'KK ahli waris',
        ];
    }
}
