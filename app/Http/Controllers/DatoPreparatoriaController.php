<?php

namespace App\Http\Controllers;

use App\Models\DatoPreparatoria;
use App\Models\Estado;
use App\Models\Ficha;
use Illuminate\Http\Request;

class DatoPreparatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aspirante=session('aspirante');
        if(!DatoPreparatoria::where('aspirante_id',$aspirante)->exists()){
            $estados=Estado::select(['estado_id', 'estado'])
                ->orderBy('estado_id','ASC')
                ->get();
            return view('fichas.datos_preparatoria',compact('estados'));
        }
        $dato=DatoPreparatoria::where('aspirante_id',$aspirante)->first();
        return redirect()->route('datos_preparatoria.show',['datos_preparatorium' => $dato->id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre_preparatoria' => 'required',
            'egreso' => 'required',
            'promedio'=>'required',
        ],[
            'nombre_preparatoria.required' => 'Indique el nombre de la preparatoria',
            'egreso.required' => 'Indique el año de egreso',
            'promedio.required'=>'Por favor, indicar el promedio obtenido en la prepa',

        ]);
        $registro_preparatoria=new DatoPreparatoria();
        $registro_preparatoria->aspirante_id=session('aspirante');
        $registro_preparatoria->fill($request->all());
        $registro_preparatoria->save();
        Ficha::where('aspirante',session('aspirante'))->update([
            'bandera3'=>1
        ]);
        session(['bandera3'=>1]);
        return redirect()->route('datos_socioeconomicos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DatoPreparatoria $datos_preparatorium)
    {
        $estado=$datos_preparatorium->estado()->first();
        return view('fichas.datos_preparatoria_show',
            compact('datos_preparatorium','estado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatoPreparatoria $datos_preparatorium)
    {
        $estados=Estado::select(['estado_id', 'estado'])
            ->orderBy('estado_id','ASC')
            ->get();
        return view('fichas.datos_preparatoria_edit',
            compact('datos_preparatorium','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DatoPreparatoria $datos_preparatorium)
    {
        request()->validate([
            'nombre_preparatoria' => 'required',
            'egreso' => 'required',
            'promedio'=>'required',
        ],[
            'nombre_preparatoria.required' => 'Indique el nombre de la preparatoria',
            'egreso.required' => 'Indique el año de egreso',
            'promedio.required'=>'Por favor, indicar el promedio obtenido en la prepa',

        ]);
        DatoPreparatoria::where('id',$datos_preparatorium->id)->update([
            'estado_id'=>$request->estado_id,
            'nombre_preparatoria'=>$request->nombre_preparatoria,
            'egreso'=>$request->egreso,
            'promedio'=>$request->promedio,
        ]);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatoPreparatoria $datosPreparatoria)
    {
        //
    }
}
