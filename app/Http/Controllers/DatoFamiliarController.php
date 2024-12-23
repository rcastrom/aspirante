<?php

namespace App\Http\Controllers;

use App\Models\DatoFamiliar;
use App\Models\Ficha;
use Illuminate\Http\Request;

class DatoFamiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aspirante=session('aspirante');
        if(!DatoFamiliar::where('aspirante_id',$aspirante)->exists()){
            return view('fichas.datos_familiares');
        }
        $dato=DatoFamiliar::where('aspirante_id',$aspirante)->first();
        return redirect()->route('datos_familiares.show',['datos_familiare'=>$dato->id]);
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
        $registro_dato_familiar = new DatoFamiliar();
        $registro_dato_familiar->aspirante_id=session('aspirante');
        $registro_dato_familiar->apellido_paterno_padre=$request->apellido_paterno_padre;
        $registro_dato_familiar->apellido_materno_padre=$request->apellido_materno_padre;
        $registro_dato_familiar->nombre_padre=$request->nombre_padre;
        $registro_dato_familiar->apellido_paterno_madre=$request->apellido_paterno_madre;
        $registro_dato_familiar->apellido_materno_madre=$request->apellido_materno_madre;
        $registro_dato_familiar->nombre_madre=$request->nombre_madre;
        $registro_dato_familiar->vive_padre=$request->vive_padre;
        $registro_dato_familiar->vive_madre=$request->vive_madre;
        $registro_dato_familiar->estado_civil=$request->estado_civil;
        $registro_dato_familiar->beca=$request->beca;
        $registro_dato_familiar->zona_procedencia=$request->zona_procedencia;
        $registro_dato_familiar->capacidad_diferente=$request->capacidad_diferente;
        $registro_dato_familiar->save();
        Ficha::where('aspirante',session('aspirante'))->update([
            'bandera2'=>1
        ]);
        session(['bandera2'=>1]);
        return redirect()->route('datos_preparatoria.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DatoFamiliar $datos_familiare)
    {
        switch ($datos_familiare->estado_civil){
            case 'S': $estado_civil='Soltero'; break;
            case 'C': $estado_civil='Casado'; break;
            case 'D': $estado_civil='Divorciado'; break;
            case 'U': $estado_civil='Union Libre'; break;
            case 'V': $estado_civil='Viudo'; break;
            default: $estado_civil='No definido'; break;
        }
        switch ($datos_familiare->zona_procedencia){
            case 'U': $zona="Urbana"; break;
            case 'I': $zona="Indígena"; break;
            case 'R': $zona="Rural"; break;
            case 'M': $zona="Urbana Marginada"; break;
            default: $zona="Otros"; break;
        }
        return view('fichas.datos_familiares_show',
            compact('datos_familiare','estado_civil','zona'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatoFamiliar $datos_familiare)
    {
        $bandera1=$datos_familiare->vive_padre?1:0;
        $bandera2=$datos_familiare->vive_madre?1:0;
        $bandera3=$datos_familiare->beca?1:0;
        return view('fichas.datos_familiares_edit',
            compact('datos_familiare','bandera1','bandera2','bandera3'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DatoFamiliar $datos_familiare)
    {
        DatoFamiliar::where('id',$datos_familiare->id)
            ->update([
                'apellido_paterno_padre'=>$request->apellido_paterno_padre,
                'apellido_materno_padre'=>$request->apellido_materno_padre,
                'nombre_padre'=>$request->nombre_padre,
                'apellido_paterno_madre'=>$request->apellido_paterno_madre,
                'apellido_materno_madre'=>$request->apellido_materno_madre,
                'nombre_madre'=>$request->nombre_madre,
                'vive_padre'=>$request->vive_padre,
                'vive_madre'=>$request->vive_madre,
                'estado_civil'=>$request->estado_civil,
                'beca'=>$request->beca,
                'zona_procedencia'=>$request->zona_procedencia,
                'capacidad_diferente'=>$request->capacidad_diferente,
            ]);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatoFamiliar $datoFamiliar)
    {
        //
    }
}
