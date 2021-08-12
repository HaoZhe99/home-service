<?php

namespace App\Http\Requests;

use App\Models\Servicer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServicerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('servicer_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
