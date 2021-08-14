<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class Usercontoller extends Controller
{
    public function index()
    {
        $user = User::all()->toArray();
        return array_reverse($user);
    }

    public function add(Request $request)
    {
    
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'image' => 'required',
        ]);
        $image = $request->file('image');
        $ext = $image->extension();
        $file = time() . '.' . $ext;
        $image->storeAs('ava', $file, 'public');

        $user = new User([

            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'profile_img' => $file
        ]);
        $user->save();
        return response()->json('The user successfully added');

    }

    // edit user
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    // update user
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        if ( $request->file('image')) {
            $user = User::find($id);
            storage::delete("./public/ava/$user->profile_img");  
            $image = $request->file('image');
            $ext = $image->extension();
            $file = time() . '.' . $ext;
            $image->storeAs('ava', $file, 'public');
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'profile_img' => $file
            ]);
        } else {
            $user = User::find($id);
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);
        }
        
        return response()->json('The user successfully updated');
    }

    // delete user
    public function delete($id)
    {
        $user = User::find($id);

        storage::delete("./public/ava/$user->profile_img");  
        $user->delete();

        return response()->json('The user successfully deleted');
    }
}
