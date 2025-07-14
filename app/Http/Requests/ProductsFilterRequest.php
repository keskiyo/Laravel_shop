<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsFilterRequest extends FormRequest
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
            'search_on_site'=>'required|min:3|max:255',

        ];

        return $rules;
    }
    public function messages(){
        return [
            'min'=>'Поле должно быть не меньше :min символов',
            'max'=>'Поле должно быть не больше :max символов',
        ];
    }
}
