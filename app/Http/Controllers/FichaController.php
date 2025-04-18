<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\ParametroFicha;
use App\Models\Municipio;
use DateMalformedStringException;
use DateTime;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    /**
     * @throws DateMalformedStringException
     */
    public function index()
    {
        $ficha=ParametroFicha::where('activo',true)
            ->select(['entrega','termina','fichas'])
            ->first();
        $usuario=auth()->user()->id;
        if(Ficha::where(
            [
                'periodo'=>$ficha->fichas,
                'aspirante'=>$usuario
            ]
        )->exists()){
            $datos_solicitante=Ficha::where(
                [
                    'periodo'=>$ficha->fichas,
                    'aspirante'=>$usuario
                ])->select(['id','ficha','bandera1','bandera2','bandera3','bandera4','bandera5'])
                ->first();
            session([
                'aspirante'=>$datos_solicitante->id,
                'ficha'=>$datos_solicitante->ficha,
                'bandera1'=>$datos_solicitante->bandera1,
                'bandera2'=>$datos_solicitante->bandera2,
                'bandera3'=>$datos_solicitante->bandera3,
                'bandera4'=>$datos_solicitante->bandera4,
                'bandera5'=>$datos_solicitante->bandera5,
            ]);
        }else{
            $nueva_ficha=Ficha::where('periodo',$ficha->fichas)->count()+1;
            $registro=new Ficha();
            $registro->periodo=$ficha->fichas;
            $registro->aspirante=$usuario;
            $registro->ficha=$nueva_ficha;
            $registro->save();
            $id=$registro->id;
            session([
                'aspirante'=>$id,
                'ficha'=>$nueva_ficha,
                'bandera1'=>0,
                'bandera2'=>0,
                'bandera3'=>0,
                'bandera4'=>0,
                'bandera5'=>0,
            ]);
        }
        $hoy=new DateTime("today");
        $fecha_inicio=new DateTime($ficha->entrega);
        $fecha_termino=new DateTime($ficha->termino);
        if(($hoy<=$fecha_termino)&&($hoy>=$fecha_inicio)){
            $bandera=1;
        }else{
            $bandera=0;
        }
        return view('fichas.index',compact('bandera'));
    }
    public function municipios(Request $request){
        $municipios=Municipio::where('estado_id',$request->estado)
            ->select(['id','municipio'])
            ->orderBy('municipio','ASC')
            ->get();
        return response()->json([
            'status'=>'success',
            'municipios'=>$municipios
        ]);
    }
}
