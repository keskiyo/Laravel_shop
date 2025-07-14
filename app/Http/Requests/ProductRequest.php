<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules =[
            'category_id'=>'required|min:1|max:255',
            'name'=>'required|min:3|max:255',
            'code'=>'required|min:1|max:255',
            'manufacturer'=>'required|min:1|max:255',
            'article'=>'required|min:1|max:255|unique:products,article',
            'price'=>'required|numeric|min:1',
            'count'=>'required|numeric|min:0',

        ];

        if($this->route()->named('products.update')){
            $rules['article'] .= ',' . $this->route()->parameter('product')->id;
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
