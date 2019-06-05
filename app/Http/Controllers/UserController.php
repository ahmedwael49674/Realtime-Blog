<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;

class UserController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::findOrFail(auth()->id());
        return view ('users.edit',compact('user'));
    }

    public function auth()
    {
        return Auth::user()->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required',
        'image' => 'file',
        ]);
        $user               = User::findOrFail(auth()->id());
        $user->name         = $request->name;
        $user->email        = $request->email;
        if($request->password){
            $user->password     = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
         $user->image = Storage::disk('public')->putFile('storage/image', $request->file('image'));
        }
        
        $user->save();
        return redirect()->route('posts.index');
    }

}
