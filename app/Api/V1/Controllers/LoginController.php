<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;
use App\Permission;
use App\Role;
use App\User;

class LoginController extends Controller
{
    /**
     * Log the user in
     *
     * @param LoginRequest $request
     * @param JWTAuth $JWTAuth
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = $request->only(['email', 'password']);

        try {
            $token = Auth::guard()->attempt($credentials);

            if(!$token) {
                throw new AccessDeniedHttpException();
            }

        } catch (JWTException $e) {
            throw new HttpException(500);
        }

        return response()
            ->json([
                'status' => 'ok',
                'token' => $token,
                'expires_in' => Auth::guard()->factory()->getTTL() * 60
            ]);
    }

    public function createRole(Request $request){
        // Todo   
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return response()->json("created");    
    }

    public function createPermission(Request $request){
        // Todo 
        $viewUsers = new Permission();
        $viewUsers->name = $request->input('name');
        $viewUsers->save();

        return response()->json("created");      
    }

    public function assignRole(Request $request){
         // Todo
         $user = User::where('email', '=', $request->input('email'))->first();

        $role = Role::where('name', '=', $request->input('role'))->first();
        //$user->attachRole($request->input('role'));
        $user->roles()->attach($role->id);

        return response()->json("created");
    }

    public function attachPermission(Request $request){

        // Todo 
         $role = Role::where('name', '=', $request->input('role'))->first();
        $permission = Permission::where('name', '=', $request->input('name'))->first();
        $role->attachPermission($permission);

        return response()->json("created");      
    }


     public function checkRoles(Request $request){
        $user = User::where('email', '=', $request->input('email'))->first();
        Log::info($user);
        return response()->json([
            "user" => $user,
            "owner" => $user->hasRole('owner'),
            "admin" => $user->hasRole('admin'),
            "editUser" => $user->can('edit-user'),
            "listUsers" => $user->can('list-users')
        ]);
    }

}
