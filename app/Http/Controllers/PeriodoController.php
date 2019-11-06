<?php

namespace App\Http\Controllers;

use App\Periodo;
use App\CantidadDiasPeriodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::paginate(5);
        return view('periodo.index',
                    compact('periodos')
                   )->with('i', (request()->input('page', 1) - 1) * 5);
        //$periodo =>periodo::orderBy('id', 'Asc')=>paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('periodo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rango' => 'required',
            'dias_disp' => 'required',
        ]);

        $periodo = new Periodo;
        $periodo->rango = $request->rango;
        $periodo->dias_disp = $request->dias_disp;
        $periodo->save();
        $periodo = $periodo->id;

        $total = $request->vacaciones1 + $request->vacaciones2;
        if($request->vacaciones1 == $request->vacaciones2){
            if($total == $request->dias_disp){
                $cantidaduno = new CantidadDiasPeriodo();
                $cantidaduno->cantidad_dias = $request->vacaciones1;
                $cantidaduno->periodo_id = $periodo;
                $cantidaduno->save();

                $cantidaduno->save();
                $cantidaddos = new CantidadDiasPeriodo();
                $cantidaddos->cantidad_dias = $request->dias_disp;
                $cantidaddos->periodo_id = $periodo;
                $cantidaddos->save();
            } else {
                $periodo->delete();
                return redirect()->route('periodos.create')->with('danger','vaciones por partes no coinciden con el total de dias diponibles');
            }
        } else {
            if($total == $request->dias_disp){
                $cantidaduno = new CantidadDiasPeriodo();
                $cantidaduno->cantidad_dias = $request->vacaciones1;
                $cantidaduno->periodo_id = $periodo;
                $cantidaduno->save();

                $cantidaddos = new CantidadDiasPeriodo();
                $cantidaddos->cantidad_dias = $request->vacaciones2;
                $cantidaddos->periodo_id = $periodo;
                $cantidaddos->save();

                $cantidadtres = new CantidadDiasPeriodo();
                $cantidadtres->cantidad_dias = $request->dias_disp;
                $cantidadtres->periodo_id = $periodo;
                $cantidadtres->save();
            } else {
                $periodo->delete();
                return redirect()->route('periodos.create')->with('danger','vaciones por partes no coinciden con el total de dias diponibles');
            }
        }

        // return redirect('users');
        return redirect()->route('periodos.index')->with('success', 'Periodo registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instance = Periodo::find($id);
        return view('periodo.show', ['periodo' => $instance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instance = Periodo::find($id);
        return view('periodo.edit', ['periodo' => $instance]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rango' => 'required',
            'dias_disp' => 'required',
        ]);

        $periodo = Periodo::findOrFail($id);
        $periodo->rango = $request->rango;
        $periodo->dias_disp = $request->dias_disp;
        $periodo->save();

        return redirect()->route('periodos.index')->with('success', 'periodo editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $instance = Periodo::findOrFail($id);
        $instance->delete();
        return redirect()->route('periodos.index')->with('success', 'periodo eliminado');
    }

}
