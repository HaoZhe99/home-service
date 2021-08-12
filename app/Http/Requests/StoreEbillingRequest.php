<?php

namespace App\Http\Requests;

use App\Models\Ebilling;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEbillingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ebilling_create');
    }

    public function rules()
    {
        return [
            'remark' => [
                'string',
                'nullable',
            ],
        ];
    }
}
