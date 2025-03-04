<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => 'required|string|max:255',
            'categorios' => 'required',
            'url' => 'required',
            'description' => 'required|string',
        ];
    }

    /**
     * پیام‌های خطای سفارشی برای قوانین اعتبارسنجی.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الزامی است.',
            'title.string' => 'عنوان باید یک متن باشد.',
            'title.max' => 'عنوان نباید بیش از ۲۵۵ کاراکتر باشد.',
            'url.required' => 'لینک الزامی است.',
            'text.required' => 'توضیحات الزامی است.',
            'text.string' => 'توضیحات باید به صورت متن باشد.',
            'categorios.required' => ' دسته بندی الزامی است..',

        ];
    }
}
