<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Periodo;
use Carbon\Carbon;
use App\Vacaciones;
use App\UsuarioPeriodo;
use Laracasts\Flash\Flash;
use App\CantidadDiasPeriodo;
use Illuminate\Http\Request;


class VacacionesController extends Controller
{

    public function index(Request $request)
    {
        $usuario = Auth::user()->id;
        $vacaciones_totales = Vacaciones::whereHas('user_periodo',function( $query) use($usuario){
            $query->where('user_id',$usuario);
        })->with('user_periodo.user','user_periodo.periodo')->paginate(5);
        return view('vacacionesV.index',compact('vacaciones_totales'));
    }

    public function create(Request $request)
    {
        $periodos = Periodo::pluck('rango','id');
        //dd($periodos); 
        return view('vacacionesV.create',compact('periodos'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $user = Auth::user();
        $user_periodo = UsuarioPeriodo::where('user_id',$user->id)->where('periodo_id',$request->periodo_id)->first();

        $fecha = explode('-',$request->rango_fecha);
        $fechainicio = Carbon::parse(trim($fecha[0]))->format('Y/m/d');
        $fechafin = Carbon::parse(trim($fecha[1]))->format('Y/m/d');

        if(empty($user_periodo) != true){
            $user_periodo_id = $user_periodo->id;
        } else {
            $user_periodo = new UsuarioPeriodo();
            $user_periodo->user_id = $user->id;
            $user_periodo->periodo_id = $request->periodo_id;
            $user_periodo->save();
            $user_periodo_id = $user_periodo->id;
        }

        $periodo = Periodo::find($user_periodo->periodo_id);

        $vacaciones_existentes = Vacaciones::where('user_periodo_id',$user_periodo_id)->get();

        $crear_registro = false;

        if(count($vacaciones_existentes) == 1){
            // valido si son 15 o 30 dias que tiene ya registrado anteriormente
            foreach($vacaciones_existentes as $existente){
                $dias = null;
                $total_dias = null;
                $dias = $existente->dias_t;
                $total_dias = $request->dias + $dias;
                if($dias < $periodo->dias_disp){
                    if($total_dias == $periodo->dias_disp){
                        $crear_registro = true;
                    } else {
                        Flash::error("¡La cantidad de dias no corresponde con el total de las vaciones para el periodo seleccionado!");
                        return redirect()->route('vacaciones.create');
                    }

                } else {
                    Flash::error("¡La cantidad de dias no corresponde con el total de las vaciones para el periodo seleccionado! Vacciones completas para este Perido.");
                    return redirect()->route('vacaciones.create');
                }
            }            
        } else if(count($vacaciones_existentes) == 0){
            $crear_registro = true;
        } else if(count($vacaciones_existentes) == 2){
            Flash::error("¡La cantidad de dias no corresponde con el total de las vaciones para el periodo seleccionado! Vacciones completas para este Perido.");
            return redirect()->route('vacaciones.create');
        }

        if($crear_registro){

            $vacaciones =  new Vacaciones();
            $vacaciones->user_periodo_id = $user_periodo_id;
            $vacaciones->fecha_i = $fechainicio;
            $vacaciones->fecha_f = $fechafin;
            $vacaciones->dias_t = $request->dias;
            $vacaciones->save();
        }

        Flash::success("Vacciones solicitadas para este Perido.");
        return redirect()->route('vacaciones.create');

    }

    public function show(Request $request,$id)
    {

        // if($request->ajax()){
        $cantidaddias = CantidadDiasPeriodo::where('periodo_id',$id)->get();
        //dd($cantidaddias);
        //return json_encode($cantidaddias);
        return response()->json($cantidaddias);
        //}
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
