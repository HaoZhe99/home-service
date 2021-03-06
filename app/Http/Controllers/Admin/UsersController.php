<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (Auth::id() == 1) {
            $users = User::with(['roles', 'addresses'])->get();
        } else {
            $users = User::where('id', Auth::id())->orWhere('created_by_id', Auth::id())->with(['roles', 'addresses'])->get();
        }


        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        if (Auth::user()->roles[0]->id == 1) {
            $addresses = Address::pluck('address', 'id');
        } else if(Auth::user()->roles[0]->id == 2 || Auth::user()->roles[0]->id == 3 ){
            $addresses = Address::where('created_by_id', Auth::id())->pluck('address', 'id');
        }
        

        return view('admin.users.create', compact('roles', 'addresses'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->roles[0]->id == 1) {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'created_by_id' => Auth::id(),
                'verify' =>  $request->verify,
            ]);
        } else if(Auth::user()->roles[0]->id == 3){ 
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'created_by_id' => Auth::id(),
                'verify' => 1,
            ]);
        }
       
        
        if (Auth::user()->roles[0]->id == 1) {
            $user->roles()->sync($request->input('roles', []));
        } else if(Auth::user()->roles[0]->id == 3){
            $user->roles()->sync(4);
        }

        $user->addresses()->sync($request->input('addresses', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        if (Auth::user()->roles[0]->id == 1) {
            $addresses = Address::pluck('address', 'id');
        } else if(Auth::user()->roles[0]->id == 2 || Auth::user()->roles[0]->id == 3 || Auth::user()->roles[0]->id == 4){
            $addresses = Address::where('created_by_id', Auth::id())->pluck('address', 'id');
        }

        $user->load('roles', 'addresses');

        return view('admin.users.edit', compact('roles', 'addresses', 'user'));
    }

    public function update(Request $request, User $user)
    {

        if (Auth::user()->roles[0]->id == 1) {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'created_by_id' => Auth::id(),
                'verify' =>  $request->verify,
            ]);
        } else if(Auth::user()->roles[0]->id == 3){ 
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'created_by_id' => Auth::id(),
                'verify' => 1,
            ]);
        }

        if (Auth::user()->roles[0]->id == 1) {
            $user->roles()->sync($request->input('roles', []));
        } else if(Auth::user()->roles[0]->id == 3){
            $user->roles()->sync(4);
        }
        
        $user->addresses()->sync($request->input('addresses', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'addresses');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function merchant_register(Request $request)
    {
        $user = User::create([
            'name'   => $request->name,
            'email'    =>  $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->roles()->sync(3);

        return redirect('/login')->with('status', 'Register Successully!');
    }
}
