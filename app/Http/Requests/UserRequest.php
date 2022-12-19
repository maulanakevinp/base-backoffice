<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'peran_id'              => ['required','numeric'],
            'username'              => ['required','string','max:64','alpha_dash','unique:users,username'.(request()->isMethod('put') ?  ','.$this->pengguna->id : '')],
            'email'                 => ['required','email','max:64','unique:users,email'.(request()->isMethod('put') ?  ','.$this->pengguna->id : '')],
            'status'                => ['nullable','numeric'],
            'ganti_password'        => ['nullable','numeric'],
            'password'              => ['required_with:ganti_password','same:konfirmasi_password'],
            'konfirmasi_password'   => ['required_with:ganti_password','same:password'],
        ];

        if ($this->karyawan) {
            $rules['data_pribadi_id'] = [request()->isMethod('post') ? 'required' : 'nullable','numeric'];
        } else {
            $rules['nama'] = ['required','string','max:64'];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'peran_id.required' => 'peran wajib diisi.',
            'data_pribadi_id.required' => 'nama karyawan wajib diisi.',
        ];
    }
}
