<?php

namespace App\Http\Requests;

use App\Models\Ebilling;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEbillingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ebilling_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ebillings,id',
        ];
    }
}
