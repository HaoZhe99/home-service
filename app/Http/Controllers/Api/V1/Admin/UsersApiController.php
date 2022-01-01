<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\Address;
use App\Models\State;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    public function index()
    {
        return new UserResource(User::with(['roles', 'addresses'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->addresses()->sync($request->input('addresses', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        return new UserResource($user->load(['roles', 'addresses', 'addresses.state']));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->addresses()->sync($request->input('addresses', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $user->roles()->sync(2);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $user = User::with(['roles'])->where('email', $request->email)->first();

        if ($user == null) {
           return "false";
        } else {
            if (Hash::check($request->password, $user->password)) {
                return "true";
            } else {
                return "false";
            }
        }
    }

    public function checkUser(Request $request)
    {
        $user = User::with(['roles'])->where('email', $request->email)->first();

        if ($user == null) {
           return "false";
        } else {
            if (Hash::check($request->password, $user->password)) {
                return new UserResource($user);
            } else {
                return "false";
            }
        }
    }

    public function userUpdate(Request $request, User $user)
    {
        $user->update([
            "name" => $request->name,
            "usrname" => $request->username,
            "email" => $request->email,
            "phone" => $request->phone,
        ]);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function userAddAddress(Request $request, User $user)
    {
        $postcode = State::where("postcode", $request->state_id)->pluck("id");

        $address = Address::create([
            'address' => $request->address,
            'state_id'  => $postcode[0],
            'created_by_id' => $user->id,
        ]);
        
        $a = Address::where("created_by_id", $user->id)->pluck('id');

        $user->addresses()->sync($a);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function userUpdateAddress(Request $request, Address $address)
    {
        $postcode = State::where("postcode", $request->state_id)->pluck("id");

        $address->update([
            'address' => $request->address,
            'state_id'  => $postcode[0],
        ]);

        return $address;
    }
}
