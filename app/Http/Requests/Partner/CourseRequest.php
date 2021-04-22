<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $_id = ((\Request::segment(4)) ? (\Request::segment(4)) : (0));
        return [
            'catalog_id'  => ['required'],
            'level_id'    => ['required'],
            'name'        => ['required'],
            'title'       => ['required', 'max:100'],
            'description' => ['required'],
            'price'       => ['required'],
            'duration'    => ['required'],
            // 'filename'    => ['required', 'mimes:jpg,png,jpeg']
            'filename'    => ($_id < 1 ? ['required', 'mimes:jpg,png,jpeg'] : [''])
        ];
    }

    public function messages() {
        return [
            'catalog_id.required'  => 'Nama Catalog wajib diisi',
            'level_id.required'    => 'Level wajib diisi',
            'name.required'        => 'Nama Catalog Topic wajib diisi',
            'title.required'       => 'Title wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'price.required'       => 'Harga wajib diisi',
            'duration.required'    => 'Durasi wajib diisi',
            'filename.required'       => 'Cover wajib diisi',
            'filename.mimes'          => 'Extension cover harus .jpg, .png, .jpeg'
        ];
    }
}
