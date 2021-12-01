<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMerchantRequest;
use App\Http\Requests\StoreMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class MerchantController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('merchant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd(Auth::id() == 1);
        if (Auth::id() == 1) {
            $merchants = Merchant::with(['state', 'categories', 'media'])->get();
        } else{
            $merchants = Merchant::where('created_by_id', Auth::id())->with(['state', 'categories', 'media'])->get();
        }


        return view('admin.merchants.index', compact('merchants'));
    }

    public function create()
    {
        abort_if(Gate::denies('merchant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $states = State::pluck('postcode', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        return view('admin.merchants.create', compact('states', 'categories'));
    }

    public function store(StoreMerchantRequest $request)
    {
        // dd($destinationPath = public_path().'/images' );
        if($request->file('ssm_document')){
            $ssm_document = $request->file('ssm_document');
            $ssm_document->move(public_path().'/images/merchant/ssm_document', $img_ssm = 'img_'.Str::random(6).'.jpg');
        }

        if($request->file('logo')){
            $logo = $request->file('logo');
            $logo->move(public_path().'/images/merchant/logo', $img_logo = 'img_'.Str::random(6).'.jpg');
        }

        $merchant = Merchant::create([
            'name'  => $request->name,
            'description' => $request->description,
            'contact_number' => $request->contact_number,
            'status' => 'pending',
            'address' => $request->address1 . "," . $request->address2 . "," . $request->address3,
            'state_id' => $request->state_id,
            // 'longitude' => $request->longitude,
            // 'latitude' => $request->latitude,
            'ssm_number' => $request->ssm_number,
            'ssm_document' => ($request->file('ssm_document')) ? $img_ssm : null,
            'logo' => ($request->file('logo')) ? $img_logo : null,
            'created_by_id' => Auth::id(),
        ]);
        $merchant->categories()->sync($request->input('categories', []));

        // if ($request->file('ssm_document', false)) {
        //     $merchant->addMedia(storage_path('tmp/uploads/' . basename($request->file('ssm_document'))))->toMediaCollection('ssm_document');
        // }

        // if ($request->input('logo', false)) {
        //     $merchant->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        // }

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $merchant->id]);
        // }

        return redirect()->route('admin.merchants.index');
    }

    public function edit(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $merchant->load('state', 'categories');

        return view('admin.merchants.edit', compact('states', 'categories', 'merchant'));
    }

    public function update(UpdateMerchantRequest $request, Merchant $merchant)
    {
        if($request->file('ssm_document')){
            $ssm_document = $request->file('ssm_document');
            $ssm_document->move(public_path().'/images/merchant/ssm_document', $img_ssm = 'img_'.Str::random(6).'.jpg');
        }

        if($request->file('logo')){
            $logo = $request->file('logo');
            $logo->move(public_path().'/images/merchant/logo', $img_logo = 'img_'.Str::random(6).'.jpg');
        }

        $merchant->update([ 
            'name'  => $request->name,
            'description' => $request->description,
            'contact_number' => $request->contact_number,
            'status' => 'pending',
            'address' => $request->address1 . "," . $request->address2 . "," . $request->address3,
            'state_id' => $request->state_id,
            // 'longitude' => $request->longitude,
            // 'latitude' => $request->latitude,
            'ssm_number' => $request->ssm_number,
            'ssm_document' => ($request->file('ssm_document')) ? $img_ssm : $merchant->ssm_document,
            'logo' => ($request->file('logo')) ? $img_logo : $merchant->logo,
            'created_by_id' => Auth::id(),]);

        $merchant->categories()->sync($request->input('categories', []));
        // if ($request->input('ssm_document', false)) {
        //     if (!$merchant->ssm_document || $request->input('ssm_document') !== $merchant->ssm_document->file_name) {
        //         if ($merchant->ssm_document) {
        //             $merchant->ssm_document->delete();
        //         }
        //         dd(basename($request->input('ssm_document')));
        //         $merchant->addMedia(storage_path('tmp/uploads/' . basename($request->input('ssm_document'))))->toMediaCollection('ssm_document');
        //     }
        // } elseif ($merchant->ssm_document) {
        //     $merchant->ssm_document->delete();
        // }

        // if ($request->input('logo', false)) {
        //     if (!$merchant->logo || $request->input('logo') !== $merchant->logo->file_name) {
        //         if ($merchant->logo) {
        //             $merchant->logo->delete();
        //         }
        //         $merchant->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        //     }
        // } elseif ($merchant->logo) {
        //     $merchant->logo->delete();
        // }

        return redirect()->route('admin.merchants.index');
    }

    public function show(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchant->load('state', 'categories');

        return view('admin.merchants.show', compact('merchant'));
    }

    public function destroy(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchant->delete();

        return back();
    }

    public function massDestroy(MassDestroyMerchantRequest $request)
    {
        Merchant::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('merchant_create') && Gate::denies('merchant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Merchant();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function approve(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_approve'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchant->update([
            'status' => 'approved'
        ]);

        return redirect()->route('admin.merchants.index');
    }

    public function reject(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_reject'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchant->update([
            'status' => 'reject'
        ]);

        return redirect()->route('admin.merchants.index');
    }
}
