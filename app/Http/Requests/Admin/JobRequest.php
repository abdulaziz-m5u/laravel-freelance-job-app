<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
        return [
            'title'         => [
                'required',
            ],
            'description'   => [
                'required',
            ],
            'budget'        => [
                'required',
            ],
            'delivery_date' => [
                'date_format:' . 'Y-m-d',
                'nullable',
            ],
        ];
    }
}
