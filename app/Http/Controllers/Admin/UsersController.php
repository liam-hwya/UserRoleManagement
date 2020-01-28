<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index')->with('users',$users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-users')){

            return redirect()->route('admin.users.index');
        }

        $roles = Role::all();

        return view('admin.users.edit',[
            'user'  =>  $user,
            'roles' =>  $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if($user->save()){

            $request->session()->flash('success','Updated Successfully');
        }
        else{

            $request->session()->flash('error','Cannot be updated');
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){

            return redirect()->route('admin.users.index');
        }

        $user->roles()->detach(); //disconnect relationship

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
