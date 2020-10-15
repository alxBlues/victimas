<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Grupo;
use App\log_session;
use Caffeinated\Shinobi\Models\Role;

class UserController extends Controller
{

    /**
     * Vista para crear los usuarios.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
          return view('users.create');
    }
    //Metodo que guarda la creaccion de usuarios por parte del administrador
    public function store(Request $request)
    {
      $this->validate($request, array(
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ));

    $users  = new User;
    $users->name = $request->name;
    $users->email = $request->email;
    $users->password = bcrypt($request->password);
    $users->estado = '1';
    $users->save();

    $sesion = new log_session;
    $sesion->id_user = $users->id;
    $sesion->ip_user = '1';
    $sesion->tipo = '1';
    $sesion->save();

    return redirect()->route('users.index')->with('info', 'Usuario creado con exito');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('users.index',compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $grupos = Grupo::all();

        return view('users.edit',compact('user','roles','grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      if(isset($request->password))
      {
        $this->validate($request,[
            'name' =>'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
      }else{

        $this->validate($request,[
            'name' =>'required',
            'email' => 'required|string|email|max:255',
        ]);
      }

        // dd($request->all());
       // 1.- Actualizar usaurio
        $user  = User::findOrFail($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(isset($request->password))
        {
          $user->password = bcrypt($request->password);
        }else{

        }

        $user->save();

        //2.- Actualizar rol

        $user->roles()->sync($request->get('roles'));
        $user->grupos()->sync($request->get('grupos'));

        return redirect()->route('users.edit',$user->id)
                    ->with('info','Usuario Actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('info','Usuario eliminado exitosamente');
    }
}
