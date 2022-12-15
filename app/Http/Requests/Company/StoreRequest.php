<?php

    namespace App\Http\Requests\Company;

    use App\Enums\CompanyCountryEnum;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class StoreRequest extends FormRequest
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
                'name' => [
                    'required',
                    'string',
                    'filled',
                    'min:0'
                ],
                'city' => [
                    'string',
                    'required',
                ],
                'district' => [
                    'nullable',
                    'string'
                ],
                'address' => [
                    'nullable',
                    'string'
                ],
                'country' => [
                    'required',
                    'string',
                    Rule::in(CompanyCountryEnum::getKeys()),
                ],
                'address2' => [
                    'nullable',
                    'string'
                ],
                'zipcode' => [
                    'nullable',
                    'string'
                ],
                'phone' => [
                    'nullable',
                    'string'
                ],
                'email' => [
                    'nullable',
                    'string'
                ],
                'logo' => [
                    'nullable',
                    'file',
                    'image',
                    'max:5000'
                ]
            ];
        }
    }
