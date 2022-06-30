<?php 

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Validator;
use App\Http\Resources\User as UserResource;

class UserController extends BaseController
{

    public function index()
    {
        $users = User::all();
        return response()->json(UserResource::collection($users), 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Error en la validacion'],500);
    
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return response()->json(new UserResource($user), 200);
    } 

    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['error' => 'Usuario no encontrado'],404);
        }
        return response()->json(new UserResource($user), 200);
    }

    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Error en la validacion'],500);
        }

        $user->name = $input['name'];
        $user->save();
        return response()->json(new UserResource($user), 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['result' => 'El usuario ha sido eliminado'],201);

    }

}