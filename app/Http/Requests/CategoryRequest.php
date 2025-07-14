<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'=>'required|min:3|max:255|unique:categories,code',
            'code'=>'required|min:3|max:255',
        ];
        
        if($this->route()->named('categories.update')){
            $rules['code'] .= ',' . $this->route()->parameter('category')->id;
        }

        return $rules;
    }

    public function messages(){
        return [
            'required'=>'Поле обязательно для ввода',
            'min'=>'Поле должно быть не меньше :min символов',
            'max'=>'Поле должно быть не больше :max символов',
            'unique'=>'Поле должно быть уникальным',
        ];
    }
}
