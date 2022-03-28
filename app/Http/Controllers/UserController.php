<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserFormRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function info()
    {
        return view('info');
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditUserFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserFormRequest $request)
    {

        $user = User::find(auth()->user()->id);
        $user->update($request->validated());

        return response()->json(true);
    }
}
