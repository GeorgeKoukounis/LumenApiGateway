<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * return the list of users
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();

        return $this->validResponse($users);
    }

    /**
     * Create one new users
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();

        $fields['password'] = Hash::make($request->password);

        $users = User::create($fields);

        return $this->validResponse($users, Response::HTTP_CREATED);
    }

    /**
     * Obatins and show one users
     *
     * @return Illuminate\Http\Response
     */
    public function show($users)
    {
        $users = User::findOrFail($users);

        return $this->validResponse($users);
    }

    /**
     * Update an existing users
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $users)
    {

        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $user,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $users = User::findOrFail($users);

        $users->fill($request->all());

        if($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($users->isClean()) {
            return $this->errorResponse(
                'At least one value must change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $users->save();

        return $this->validResponse($users);
    }

    /**
     * Remove an existing users
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($users)
    {

        $users = User::findOrFail($users);

        $users->delete();

        return $this->validResponse($users);
    }

    /**
     * Identify existing user
     * @return Illuminate\Http\Response
     */

    public function me(Request $request){
        return $this->validResponse($request->user());
    }


}
