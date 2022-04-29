<?php

namespace App\Http\Requests;

use App\Http\Controllers\Dashboard\ProductController;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:32'],
            'price' => ['required', 'numeric', 'between:1,999999.99'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
            'code' => ['required', 'max:20', 'unique:products'],
            'status' => ['nullable', 'in:' . implode(',', array_keys(ProductController::STATUSES))],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'desc_en' => ['required', 'string'],
            'desc_ar' => ['required', 'string'],
            'image' => ['required', 'max:' . ProductController::MAX_UPLOAD_SIZE, 'mimes:' . implode(',', ProductController::AVAIALBE_EXTENSIONS)]
        ];
    }
}
