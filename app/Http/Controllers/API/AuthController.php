<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RequestStack;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'id_card_number' => 'required|string|min:16|unique:users',
            'name' => 'required|string|max:100',
            'born_date' => 'required|date',
            'gender' => 'required',
            'address' => 'required|string|max:200',
            'password' => 'required|string|min:6',
            'regional_id' => 'required',
        ]);

        $user = User::create([
            'id_card_number' => $request->id_card_number,
            'name' => $request->name,
            'born_date' => $request->born_date,
            'gender' => $request->gender,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'regional_id' => $request->regional_id
        ]);

        return response()->json([
            'message' => 'Your account is successfully created!'
        ]);
    }

    public function login(Request $request)
    {
        try{
            $request->validate([
                'id_card_number' => 'required|string|min:16',
                'password' => 'required|string|min:6'
            ]);

            if (!Auth::attempt($request->only('id_card_number', 'password'))) {
                return response()->json([
                    'message' => 'Unauthorized'
                ] , 401);
            }

            $user = User::with('regional')->where('id_card_number', $request->id_card_number)->firstOrFail();
            $token = $user->createToken('auth-sanctum',['*'],$request->id_card_number)->plainTextToken;

            return response()->json([
                'name' => $user->name,
                'born-date' => $user->born_date,
                'address' => $user->address,
                'token' => $token,
                'regional' => $user->regional,
            ]);
        }catch(Exception $e){
            return response()->json($e);

        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'You have successfully logged out!'
        ]);
    }
}
