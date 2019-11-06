<?php

namespace App\Http\Controllers;

use App\User;
use App\Area;
use App\Cargo;
use App\UsuarioDetalle;
use Illuminate\Http\Request;

class UserController extends Controller{

    public function index()
    {
        $users = User::all();
        return view('usuarios.index',compact('users'));
        //$users => user::orderBy('id', 'Asc')=>paginate(5);
    }


    public function create()
    {
        $area = Area::pluck('nombre','id');
        $cargo_all = Cargo::pluck('nombre','id');

        return view('usuarios.add',compact('area','cargo_all'));
    }

    public function store(Request $request)
    {

        // creando usuario
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        // usuario creado y guardado en $user

        // creando usuario_detalle
        $user_detalle = new UsuarioDetalle();
        $user_detalle->user_id = $user->id;
        $user_detalle->area_id = $request->area_id;
        $user_detalle->cargo_id = $request->cargo_id;
        $user_detalle->save();
        // usuario_detalle y guardado en $user_detalle

        return redirect()->route('users.index');

    }

    public function show($id)
    {
        //
        $mostrar = User::find($id);
        return view('usuarios.mostrar')->with('mostrar',$mostrar);
    }

    public function edit($id)
    {
        //
        $area = Area::pluck('nombre','id');
        $cargo_all = Cargo::pluck('nombre','id');
        $user = User::find($id);
        $user_detalle = UsuarioDetalle::where('user_id',$user->id)->with('user','area','cargo')->first();
        if(empty($user_detalle->id) != true){
            $area_id = $user_detalle->area_id;
            $cargo_id = $user_detalle->cargo_id;
        } else {
            $area_id = null;
            $cargo_id = null;
        }
        return view('usuarios.editar',compact('user','cargo_id','area_id','area','cargo_all'));
    }

    public function update(Request $request, $id)
    {
        //
        //dd($request->all());
        $actualizar = User::findOrFail($id);
        $actualizar->name = $request->usuarios;
        $actualizar->email = $request->email;
        $actualizar->update();
        $user_detalle = UsuarioDetalle::where('user_id',$actualizar->id)->first();
        if(empty($user_detalle)){
            $user_detalle = new UsuarioDetalle();
            $user_detalle->user_id = $id;
        }
        $user_detalle->area_id = $request->area_id;
        $user_detalle->cargo_id = $request->cargo_id;
        $user_detalle->save();
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        //
        User::destroy($id);
        return redirect()->route('users.index');
    }

    public function destroydos($id)
    {
        //
        User::destroy($id);
        return redirect()->route('users.index');

    }

    //Creando un method
    public function MostarDetalles($user_id){
        // hago la consulta donde el user_id de la tabla sea igual al $user_id, y ademas  trae las relaciones de las de los metodos 
        // especificados en el modelo UsuarioDetalle ( user, area, cargo) 
        $user_detalle = UsuarioDetalle::where('user_id',$user_id)->with('user','area','cargo')->first();

        return view('usuarios.detalles',compact('user_detalle'));
    }



    public function UpdateDetalles(Request $request,$user_detalle_id)
    {

        // creando usuario
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        // usuario creado y guardado en $user

        // creando usuario_detalle
        $user_detalle = new UsuarioDetalle();
        $user_detalle->user_id = $user->id;
        $user_detalle->area_id = $request->area_id;
        $user_detalle->cargo_id = $request->cargo_id;
        $user_detalle->save();
        // usuario_detalle y guardado en $user_detalle

        return redirect()->route('users.index');

    }
}
