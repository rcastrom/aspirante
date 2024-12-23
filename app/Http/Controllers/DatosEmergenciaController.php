<?php

namespace App\Http\Controllers;

use App\Models\DatosEmergencia;
use App\Models\Ficha;
use App\Models\TiposSangre;
use Illuminate\Http\Request;

class DatosEmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aspirante=session('aspirante');
        if(!DatosEmergencia::where('aspirante_id',$aspirante)->exists()){
            $tipos=TiposSangre::all();
            return view('fichas.datos_emergencia',compact('tipos'));
        }
        $dato=DatosEmergencia::where('aspirante_id',$aspirante)->firstOrFail();
        return redirect()->route('datos_emergencia.show',$dato->id);
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
        $datos_emergencia=new DatosEmergencia();
        $datos_emergencia->aspirante_id=session('aspirante');
        $datos_emergencia->fill($request->all());
        $datos_emergencia->save();
        Ficha::where('aspirante',session('aspirante'))->update([
            'bandera5'=>1
        ]);
        session(['bandera5'=>1]);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(DatosEmergencia $datos_emergencium)
    {
        $tipo_sangre=$datos_emergencium->tipo_sangre()->first();
        return view('fichas.datos_emergencia_show',compact('datos_emergencium','tipo_sangre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatosEmergencia $datos_emergencium)
    {
        $tipos=TiposSangre::all();
        $tipo_sangre=$datos_emergencium->tipo_sangre()->first();
        return view('fichas.datos_emergencia_edit',
            compact('datos_emergencium','tipos','tipo_sangre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DatosEmergencia $datos_emergencium)
    {
        DatosEmergencia::where('id',$datos_emergencium->id)
            ->update([
                'tipo_sangre_id'=>$request->tipo_sangre_id,
                'comunicar_con'=>$request->comunicar_con??null,
                'tipo_alergia'=>$request->tipo_alergia??null,
                'enfermedad'=>$request->enfermedad??null,
                'calle_numero'=>$request->calle_numero??null,
                'colonia'=>$request->colonia??null,
                'municipio'=>$request->municipio??null,
                'telefono_contacto'=>$request->telefono_contacto??null,
                'lugar_trabajo'=>$request->lugar_trabajo??null,
                'telefono_trabajo'=>$request->telefono_trabajo??null,
            ]);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatosEmergencia $datosEmergencia)
    {
        //
    }
}
