<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        
        // ganti jadi true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'nis' => 'unique:students|max:8|required', // ga boleh sama, di table students, max character 10
            'name' => 'max:50|required',
            'gender'=> 'required',
            'class_id' => 'required',
        ];
    }

    // Buat ubah nama dan sebagainya
    public function attributes(){
        return [
            'class_id' => 'class'
        ];
    }

    public function messages(){
        return [
            'nis.required' => 'NIS wajib diisi (custom message btw)',
            'nis.max' => 'NIS maksimal :max character',
            'name.required' => 'Jangan lupa isi namaa'
        ];
    }
}
