<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json([
            'data' => $user,
            'response' => 200
        ]);
    }

    public function find(Request $request){
        if (User::where('email', $request->email)->first()){
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'data'  => $user,
                'response'  => 200,
            ]);
        }else{
            return response()->json([
                'message'   => 'Email tidak terdaftar',
                'data'      => $request->all(),
                'response'  => 404
            ]);
        }
    }

    public function destroy($id)
    {
        try{
            $destroy = User::findOrFail($id);
            $destroy->delete();
            return response()->json([
                'message'   => 'User deleted successfully',
                'status'    => 200
            ]);
        }catch(\Exception){
            return response()->json([
                'message'   => 'Not Found',
                'status'    => 404
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $userData = User::find($id);
        if(!$userData){
            return response()->json([
                'message' => 'User Not Found',
                'status' => 404
            ]);
        }

        $dataUpdate = [];
        
        // update name
        if($request->name){
            $dataUpdate['name'] = $request->name;
        }
        
        // update password
        if($request->password){
            $dataUpdate['password'] = $request->password;
            $dataUpdate['password'] = Hash::make($dataUpdate['password']);
        }

        // update weight
        if($request->weight){
            $dataUpdate['weight'] = $request->weight;
        }

        // update height
        if($request->height){
            $dataUpdate['height'] = $request->height;
        }

        $userData->update($dataUpdate);
        return response()->json([
            'message' => 'user data updated successfully',
            'data' => $userData,
            'status'  => 200
        ]);
    }
}
