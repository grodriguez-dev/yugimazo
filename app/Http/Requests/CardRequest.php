<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255|unique:cards',
            'skill' => 'required|string',
            'type' => 'required|string|max:200',
            'atk' => 'nullable|integer',
            'def' => 'nullable|integer',
        ];

        if ($this->isMethod('post')) {
            $rules = array_merge($rules, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
        } else {
            $rules = array_merge($rules, [
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
        }

        return $rules;
    }
}
