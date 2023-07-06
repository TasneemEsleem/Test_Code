<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function showRegister(){
        return response()->view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = $request->validate([
        'name' => 'required|string|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:3',
    ]);
    try {
        $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $isSaved = $user->save();
            return response()->json(
             ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
              $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }  catch (\Exception $e) {
        // Handle the exception
        return response()->json(
            ['message' => 'An error occurred while saving the user'],
            Response::HTTP_BAD_REQUEST
        );
    }

        // if (!$validator->fails()) {
        //     $user = new User();
        //     $user->name = $request->input('name');
        //     $user->email = $request->input('email');
        //     $user->password = Hash::make($request->input('password'));
        //     $isSaved = $user->save();

        //     return response()->json(
        //      ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
        //       $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        // } else {
        //     return response()->json(
        //         ['message' => $validator->getMessageBag()->first()],
        //         Response::HTTP_BAD_REQUEST);
        // }
    }



}
