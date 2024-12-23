<?php

namespace App\Http\Controllers;

use App\Models\DatosSocioeconomico;
use App\Models\Ficha;
use App\Models\NivelEstudio;
use App\Models\Ocupacion;
use Illuminate\Http\Request;

class DatosSocioeconomicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aspirante=session('aspirante');
        if(!DatosSocioeconomico::where('aspirante_id',$aspirante)->exists()){
            $niveles=NivelEstudio::select(['id','descripcion'])->get();
            $ocupaciones=Ocupacion::select(['id','descripcion'])->get();
            return view('fichas.datos_socioeconomicos',compact('niveles','ocupaciones'));
        }
        $dato=DatosSocioeconomico::where('aspirante_id',$aspirante)->first();
        return redirect()->route('datos_socioeconomicos.show',['datos_socioeconomico'=>$dato->id]);
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
        $registro_socioeconomico=new DatosSocioeconomico();
        $registro_socioeconomico->aspirante_id=session('aspirante');
        $registro_socioeconomico->fill($request->all());
        $registro_socioeconomico->save();
        Ficha::where('aspirante',session('aspirante'))->update([
            'bandera4'=>1
        ]);
        session(['bandera4'=>1]);
        return redirect()->route('datos_emergencia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DatosSocioeconomico $datos_socioeconomico)
    {
        $nivel_padre=$datos_socioeconomico->nivelEstudioPadre()->first();
        $nivel_madre=$datos_socioeconomico->nivelEstudioMadre()->first();
        $ocupacion_padre=$datos_socioeconomico->ocupacionPadre()->first();
        $ocupacion_madre=$datos_socioeconomico->ocupacionMadre()->first();
        switch ($datos_socioeconomico->habita) {
            case "S"  : $habita= "Solo"; break;
            case "A"  : $habita= "Padre y madre(y hermanos de tenerlos)"; break;
            case "P"  : $habita= "Solamente con el padre(y hermanos de tenerlos)"; break;
            case "M"  : $habita= "Solamente con la madre(y hermanos de tenerlos)"; break;
            case "H"  : $habita= "Con algún hermano(a)"; break;
            case "T"  : $habita= "Tutores(y hermanos de tenerlos)"; break;
            case "O"  : $habita= "Parientes"; break;
            default: $habita= "Otros"; break;
        }
        switch ($datos_socioeconomico->casa_vives){
            case "P"  : $casa_vives= "Propia"; break;
            case "R"  : $casa_vives= "Rentada"; break;
            case "O"  : $casa_vives= "Otros"; break;
            default: $casa_vives= "Sin definir"; break;
        }
        switch ($datos_socioeconomico->dependencia){
            case "P":
                $dependencia = "Padre";
                break;
            case "M":
                $dependencia = "Madre";
                break;
            case "Y":
                $dependencia = "De mí mismo";
                break;
            case "T":
                $dependencia = "Tutores";
                break;
            case "O":
                $dependencia = "Otros";
                break;
            default:
                $dependencia= "Sin definir";
                break;
        }
        return view('fichas.datos_socioeconomicos_show',
            compact('datos_socioeconomico','nivel_padre','nivel_madre',
            'ocupacion_padre','ocupacion_madre','habita','casa_vives','dependencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatosSocioeconomico $datos_socioeconomico)
    {
        $niveles=NivelEstudio::select(['id','descripcion'])->get();
        $ocupaciones=Ocupacion::select(['id','descripcion'])->get();
        $nivel_padre=$datos_socioeconomico->nivelEstudioPadre()->first();
        $nivel_madre=$datos_socioeconomico->nivelEstudioMadre()->first();
        $ocupacion_padre=$datos_socioeconomico->ocupacionPadre()->first();
        $ocupacion_madre=$datos_socioeconomico->ocupacionMadre()->first();
        return view('fichas.datos_socioeconomicos_edit',compact('datos_socioeconomico','nivel_padre','nivel_madre',
        'niveles','ocupaciones','ocupacion_padre','ocupacion_madre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DatosSocioeconomico $datos_socioeconomico)
    {

       DatosSocioeconomico::where('id',$datos_socioeconomico->id)
           ->update([
               'nivel_estudios_padre_id'=>$request->nivel_estudios_padre_id,
               'nivel_estudios_madre_id'=>$request->nivel_estudios_madre_id,
               'habita'=>$request->habita,
               'ingresos_padre'=>$request->ingresos_padre,
               'ingresos_madre'=>$request->ingresos_madre,
               'ingresos_hermanos'=>$request->ingresos_hermanos,
               'ingresos_propios'=>$request->ingresos_propios,
               'ocupacion_padre_id'=>$request->ocupacion_padre_id??null,
               'ocupacion_madre_id'=>$request->ocupacion_madre_id??null,
               'casa_vives'=>$request->casa_vives,
               'dependencia'=>$request->dependencia,
               'cuartos_casa'=>$request->cuartos_casa,
               'personas_casa'=>$request->personas_casa,
               'personas_dependen'=>$request->personas_dependen,
           ]);
       return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatosSocioeconomico $datosSocioeconomico)
    {
        //
    }
}
