<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQrCodeRequest;
use App\Http\Requests\StoreQrCodeRequest;
use App\Http\Requests\UpdateQrCodeRequest;
use App\Models\QrCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class QrCodeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qr_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCodes = QrCode::all();

        return view('admin.qrCodes.index', compact('qrCodes'));
    }

    public function create()
    {
        abort_if(Gate::denies('qr_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.qrCodes.create');
    }

    public function store(StoreQrCodeRequest $request)
    {
        $qrCode = QrCode::create([
            'code' => Str::random(10),
            'status' => $request->status,
            'expired_at' => $request->expired_at,
        ]);

        return redirect()->route('admin.qr-codes.index');
    }

    public function edit(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.qrCodes.edit', compact('qrCode'));
    }

    public function update(UpdateQrCodeRequest $request, QrCode $qrCode)
    {
        $qrCode->update($request->all());

        return redirect()->route('admin.qr-codes.index');
    }

    public function show(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.qrCodes.show', compact('qrCode'));
    }

    public function destroy(QrCode $qrCode)
    {
        abort_if(Gate::denies('qr_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qrCode->delete();

        return back();
    }

    public function massDestroy(MassDestroyQrCodeRequest $request)
    {
        QrCode::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
