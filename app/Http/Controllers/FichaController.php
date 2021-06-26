<?php

namespace App;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Fechas;
use App\PreFicha2;
use App\Ficha;
use App\PreFicha;
use App\Carreras;
use App\Estados;
use App\Prepas;
use App\Estudios;
use App\VivesActual;
use App\Ocupacion;
use App\DeQuien;
use App\SocioEcono;
use DateTime;
use PDF;
use App\PreFicha3;

//use Illuminate\Database\Query\Builder;

class FichaController extends Controller
{
    public function index(Request $request){
        $user=auth()->user();
        $info=Ficha::select('fichas')->get();
        $periodo=$info[0]->fichas;
        //Nueva condición, si no existe el correo en pre-registro no puede seguir

        $registro=PreFicha2::selectRaw('count(*) as existe')
        ->where('correo',$user->email)
        ->where('periodo',$periodo)
        ->get();
        if($registro[0]->existe>0){
            $registro2=PreFicha2::select('preficha','bandera1','bandera2','bandera3','bandera4')
            ->where('correo',$user->email)
            ->where('periodo',$periodo)
            ->get();
            $id=$registro2[0]->preficha;
            $bandera1=$registro2[0]->bandera1;
            $bandera2=$registro2[0]->bandera2;
            $bandera3=$registro2[0]->bandera3;
            $bandera4=$registro2[0]->bandera4;
        }else{
            $registro3=PreFicha2::selectRaw('MAX(preficha) as ultimo')
            ->where('periodo',$periodo)
	    ->get();
	    if(is_null($registro3[0]->ultimo)){
		    $id=1;
	    }else{
		    $id=$registro3[0]->ultimo+1;
	    }
	    $ahora=date('Y-m-d H:i:s');
            PreFicha2::insert([
                'preficha'=>$id,
                'periodo'=>$periodo,
                'correo'=>$user->email,
                'bandera1'=>(int)0,
                'bandera2'=>(int)0,
                'bandera3'=>(int)0,
		'bandera4'=>(int)0,
		'created_at'=>$ahora
	]);
            $bandera1=0;
            $bandera2=0;
            $bandera3=0;
            $bandera4=0;
        }
        $hoy=new DateTime("now");
        $consulta=Fechas::select('fecha_inicio_solicitudes','fecha_termino_solicitudes')
        ->where('periodo',$periodo)
        ->get();
        $fecha1=substr($consulta[0]->fecha_inicio_solicitudes,0,10);
        $fecha2=substr($consulta[0]->fecha_termino_solicitudes,0,10);
        $fecha_inicio=new DateTime($fecha1);
        $fecha_termino=new DateTime($fecha2);
        if(($hoy<=$fecha_termino)&&($hoy>=$fecha_inicio)){
            $bandera=1;
        }else{
            $bandera=0;
        }
        $request->session()->put('id', $id);
        $request->session()->put('periodo', $periodo);
        $request->session()->put('bandera', $bandera);
        $request->session()->put('pri_campo',$bandera1);
        $request->session()->put('seg_campo',$bandera2);
        $request->session()->put('ter_campo',$bandera3);
        $request->session()->put('cua_campo',$bandera4);
        return (view('ficha.welcome',['id'=>$id,'periodo'=>$periodo,'bandera'=>$bandera]));

    }
    public function create1(Request $request)
    {
        $paises=DB::table('paises')->get();
        $etnias=DB::table('etnias')->orderBy('etnia')->get();
        $carreras=Carreras::select('carrera','nombre_ofertar')
        ->where('nivel_escolar','L')
        ->where('ofertar',1)
        ->orderBy('nombre_ofertar','asc')
        ->get();
        $estados=Estados::select('entidad_federativa','nombre_entidad')->get();
        $id=$request->session()->get('id');
        $periodo=$request->session()->get('periodo');
        $bandera=$request->session()->get('bandera');
        $pcampo=$request->session()->get('pri_campo');
        return view('ficha.datos1')->with(compact('id','periodo','bandera','pcampo','paises','etnias','carreras','estados'));
    }
    public function create2(Request $request)
    {
        $id=$request->session()->get('id');
        $periodo=$request->session()->get('periodo');
        $bandera=$request->session()->get('bandera');
        $scampo=$request->session()->get('seg_campo');
        $estados=Estados::select('entidad_federativa','nombre_entidad')->get();
        return view('ficha.datos2')->with(compact('id','periodo','bandera','scampo','estados'));
    }
    public function muni_prepas(Request $request){
        if(!$request->estado_id){
            $html = '<option value="" selected>--Seleccione--</option>';
        }else{
            $html='';
            $municipios=Prepas::select('clave_preparatoria','nombre_preparatoria')
            ->where('entidad_federativa',(int)$request->estado_id)
            ->orderBy('nombre_preparatoria','asc')
            ->get();
            foreach ($municipios as $municipio) {
                $html .= '<option value="'.$municipio->clave_preparatoria.'">'.utf8_encode($municipio->nombre_preparatoria).'</option>';
            }
        }
        return response()->json(['html' => $html]);
    }
    public function create3(Request $request)
    {
        $id=$request->session()->get('id');
        $periodo=$request->session()->get('periodo');
        $bandera=$request->session()->get('bandera');
        $tcampo=$request->session()->get('ter_campo');
        $estudios=Estudios::select('*')->get();
        $vives=VivesActual::select('*')->get();
        $ocupacion=Ocupacion::select('*')->get();
        $quien=DeQuien::select('*')->get();
        return view('ficha.datos3')->with(compact('id','periodo','bandera','tcampo','estudios','vives','ocupacion','quien'));
    }
    public function create4(Request $request)
    {
        $id=$request->session()->get('id');
        $periodo=$request->session()->get('periodo');
        $bandera=$request->session()->get('bandera');
        $ccampo=$request->session()->get('cua_campo');
        $tsangre=DB::table('tsangre')->select()->get();
        $estados=Estados::select('entidad_federativa','nombre_entidad')->get();
        return view('ficha.datos4')->with(compact('id','periodo','bandera','ccampo','tsangre','estados'));
    }
    public function verificar(Request $request)
    {
        $id=$request->session()->get('id');
        $periodo=$request->session()->get('periodo');
        $bandera=$request->session()->get('bandera');
        $pcampo=$request->session()->get('pri_campo');
        $carreras=Carreras::select('carrera','nombre_ofertar')
        ->where('nivel_escolar','L')
        ->where('ofertar',1)
        ->orderBy('nombre_ofertar','asc')
        ->get();
        $usuario=PreFicha::where('no_solicitud',(int)$id)
        ->where('periodo',$periodo)
        ->get();
        return view('ficha.verifica')->with(compact('id','periodo','bandera','pcampo','carreras','usuario'));
    }
    public function convocatoria(){
        return view('ficha.convocatoria');
    }
    public function requisitos(){
        return view('ficha.ningreso');
    }
    public function error(){
        return view('ficha.noprocede');
    }
    public function error2(){
        return view('ficha.noprocede2');
    }
    public function mes($mes_1){
        switch($mes_1){
            case "01": $mes="Ene"; break;
            case "02": $mes="Feb"; break;
            case "03": $mes="Mzo"; break;
            case "04": $mes="Abr"; break;
            case "05": $mes="Myo"; break;
            case "06": $mes="Jun"; break;
            case "07": $mes="Jul"; break;
            case "08": $mes="Ago"; break;
            case "09": $mes="Sept"; break;
            case "10": $mes="Oct"; break;
            case "11": $mes="Nov"; break;
            case "12": $mes="Dic"; break;
        }
        return $mes;
    }
    public function control($control){
        if(($control>=1)&&($control<=9)){
            $ncontrol="0000000".$control;
        }elseif(($control>=10)&&($control<=99)){
            $ncontrol="000000".$control;
        }elseif(($control>=100)&&($control<=999)){
            $ncontrol="00000".$control;
        }elseif(($control>=1000)&&($control<=9999)){
            $ncontrol="0000".$control;
        }elseif(($control>=10000)&&($control<=99999)){
            $ncontrol="000".$control;
        }
        return $ncontrol;
    }
    public function cpago2($valor,$fecha,$monto){
        //date_default_timezone_set("America/Tijuana");
        $avalor=(date("Y",strtotime($fecha))-2013)*372;
        $mvalor=(date("m",strtotime($fecha))-1)*31;
        $dvalor=date("d",strtotime($fecha))-1;
        $fcond=$avalor+$mvalor+$dvalor;
        $monto2=explode(".",$monto);
        $entero=$monto2[0];
        if(isset($monto2[1])){$decimal=$monto2[1]; if($decimal<=9){$decimal.=0;}}else{$decimal="00";}
        $longitud=strlen($entero);
        $m=array();
        for($i=1;$i<=$longitud;$i++){
            $m[$i]=substr($entero,$i-1,1);
        }
        $k=1;
        for($j=$longitud+1;$j<=$longitud+2;$j++){
            $m[$j]=substr($decimal,$k-1,1);
            $k++;
        }
        $valores[1]=7; $valores[2]=3; $valores[3]=1;
        $suma=0;
        $j=1;
        for($i=1;$i<=$longitud+2;$i++){
            $dif=$longitud+3-$i;
            $producto=$m[$dif]*$valores[$j];
            $suma+=$producto;
            if($j<3){$j++;}else{$j=1;}
        }
        $icond=$suma%10;
        $icond=($icond<=9?"0".$icond:$icond);
        $ncadena=$valor.$fcond.$icond."2";
        return($ncadena);
    }
    public function banamex($sucursal,$pre_cuenta,$cadena){
        $suma_sucursal=substr($sucursal,0,1)*23+substr($sucursal,1,1)*29+substr($sucursal,2,1)*31+substr($sucursal,3,1)*37;
        $lon_cuenta=strlen($pre_cuenta);
        if($lon_cuenta<7){
            $txt="";
            for($i=1;$i<=7-$lon_cuenta;$i++){
                $txt.="0";
            }
            $cuenta=trim($txt).$pre_cuenta;
        }else{
            $cuenta=$pre_cuenta;
        }
        $suma_cuenta=substr($cuenta,0,1)*13+substr($cuenta,1,1)*17+substr($cuenta,2,1)*19+substr($cuenta,3,1)*23+substr($cuenta,4,1)*29+substr($cuenta,5,1)*31+substr($cuenta,6,1)*37;
        $primer_numero=substr($cadena,4,1);
        if(is_numeric($primer_numero)){
            $a=$primer_numero;
        }else{
            $conversion=array("A"=>2,"B"=>2,"C"=>2,"D"=>3,"E"=>3,"F"=>3,"G"=>4,"H"=>4,"I"=>4,"J"=>5,"K"=>5,"L"=>5,"M"=>6,"N"=>6,"O"=>6,"P"=>7,"Q"=>7,"R"=>7,"S"=>8,"T"=>8,"U"=>8,"V"=>9,"W"=>9,"X"=>9,"Y"=>0,"Z"=>0);
            foreach($conversion as $key=>$value){
                if($key==$primer_numero){
                    $a=$value;
                }
            }
        }
        $suma_cadena=substr($cadena,0,1)*19+substr($cadena,1,1)*23+substr($cadena,2,1)*29+substr($cadena,3,1)*31+$a*37+substr($cadena,5,1)*1+substr($cadena,6,1)*2+substr($cadena,7,1)*3+substr($cadena,8,1)*5+substr($cadena,9,1)*7+substr($cadena,10,1)*11+substr($cadena,11,1)*13+substr($cadena,12,1)*17+substr($cadena,13,1)*19+substr($cadena,14,1)*23+substr($cadena,15,1)*29+substr($cadena,16,1)*31+substr($cadena,17,1)*37;
        $total=$suma_sucursal+$suma_cuenta+$suma_cadena;
        $dv1=99-($total%97);
        $dv=($dv1<=9?"0".$dv1:$dv1);
        $referencia=$cadena.$dv;
        return($referencia);
    }
    public function pagos(Request $request){
        $id=$request->session()->get('id');
	$periodo=$request->session()->get('periodo');
	$datos=DB::table('conceptos')->select('clave','descripcion')
		->whereRaw('curdate()<=flimite')
		->whereRaw('finicio<=curdate()')
		->where('sistema',6)
		->where('activo',1)
		->get();
        return view('ficha.pagos')->with(compact('id','periodo','datos'));
    }
    public function alta1(Request $request){
        $data=request()->validate([
            'nombre_aspirante'=>'required',
            'curp'=>'size:18',
            'telefono'=>'required',
            'calle_no'=>'required',
            'municipio'=>'required',
            'codigo_postal'=>'required'
        ],[
            'nombre_aspirante.required'=>'Por favor, escriba su nombre',
            'curp.size'=>'La longitud del CURP debe ser de 18 caracteres',
            'telefono.required'=>'Por favor, indique su teléfono',
            'calle_no.required'=>'Debe indicar el domicilio (calle y numero)',
            'municipio.required'=>'Indique por favor su municipio de residencia',
            'codigo_postal.required'=>'Indique por favor su codigo postal'
        ]);
        $user=auth()->user();
        $usuario = new PreFicha;
        $usuario->no_recibo=0;
        $usuario->fecha_registro=date("Y-m-d H:i:s");
        $usuario->instituto="INSTITUTO TECNOLOGICO DE ENSENADA";
        $usuario->apellido_paterno=utf8_decode($request->apellido_paterno);
        $usuario->apellido_materno=utf8_decode($request->apellido_materno);
        $usuario->nombre_aspirante=utf8_decode($request->nombre_aspirante);
        $usuario->nip=rand(1000,9999);
        $usuario->fecha_nacimiento=$request->fecha_nacimiento;
        $usuario->sexo=$request->sexo;
        $usuario->nacionalidad=$request->nacionalidad;
        $usuario->especifique_extranjero=null;
        $usuario->curp=$request->curp;
        $usuario->carrera_opcion_1=$request->carrera_opcion_1;
        $usuario->entidad_federativa_prepa=null;
        $usuario->clave_preparatoria=null;
        $usuario->agnio_egreso=null;
        $usuario->promedio_general=null;
        $usuario->calle_no=utf8_decode($request->calle_no);
        $usuario->entidad_federativa=(int)$request->entidad_federativa;
        $usuario->municipio=$request->municipio;
        $usuario->codigo_postal=$request->codigo_postal;
        $usuario->colonia_aspirante=utf8_decode($request->colonia_aspirante);
        $usuario->correo_electronico=$user->email;
        $usuario->telefono=$request->telefono;
        $usuario->estado_civil=$request->estado_civil;
        $usuario->capacidad_diferente=$request->capacidad_diferente;
        $usuario->tienes_beca=$request->tienes_beca;
        $usuario->quien_otorgo=null;
        $usuario->zona_procedencia=$request->zona_procedencia;
        $usuario->programa_oportunidades=$request->programa_oportunidades;
        $usuario->apellido_paterno_padre=utf8_decode($request->apellido_paterno_padre);
        $usuario->apellido_materno_padre=utf8_decode($request->apellido_materno_padre);
        $usuario->nombre_padre_aspirante=utf8_decode($request->nombre_padre_aspirante);
        $usuario->vive_padre=$request->vive_padre;
        $usuario->apellido_paterno_madre=utf8_decode($request->apellido_paterno_madre);
        $usuario->apellido_materno_madre=utf8_decode($request->apellido_materno_madre);
        $usuario->nombre_madre_aspirante=utf8_decode($request->nombre_madre_aspirante);
        $usuario->vive_madre=$request->vive_madre;
        $usuario->fecha_atencion=null;
        $usuario->hora_atencion=null;
        $usuario->no_solicitud=(int)$request->pre;
        $usuario->periodo=$request->periodo;
        $usuario->itmin=null;
        $usuario->folio_ceneval=null;
        $usuario->save();
        $id=$request->pre;
        $periodo=$request->periodo;
        $preficha=PreFicha2::where('preficha',(int)$id)->
        where('periodo',$periodo);
        $preficha->update(['bandera1'=>(int)1]);
        $request->session()->put('pri_campo',1);
        return redirect()->route('ficha.prepa');
    }

    public function alta2(Request $request){
        $data=request()->validate([
            'promedio_general'=>'required|integer|between:60,100',
        ],[
            'promedio_general.required'=>'Por favor, indicar el promedio obtenido en la prepa',
            'promedio_general.between'=>'El promedio debe ser entre 60 y 100'
        ]);
        $user=auth()->user();
        $id=$request->pre;
        $periodo=$request->periodo;
        $usuario=PreFicha::where('no_solicitud',(int)$id)->
        where('periodo',$periodo);
        $usuario->update([
            'entidad_federativa_prepa'=>(int)$request->entidad_federativa_prepa,
            'clave_preparatoria'=>$request->clave_preparatoria,
            'agnio_egreso'=>(int)$request->agnio_egreso,
            'promedio_general'=>(int)$request->promedio_general
        ]);
        $preficha=PreFicha2::where('preficha',(int)$id)->
        where('periodo',$periodo);
        $preficha->update(['bandera2'=>(int)1]);
        $request->session()->put('seg_campo',1);
        return redirect()->route('ficha.socio');
    }

    public function alta3(Request $request){
        $user=auth()->user();
        $usuario = new SocioEcono;
        $usuario->no_solicitud=(int)$request->pre;
        $usuario->periodo=$request->periodo;
        $usuario->nivel_estudios_padre=(int)$request->nivel_estudios_padre;
        $usuario->nivel_estudios_madre=(int)$request->nivel_estudios_madre;
        $usuario->con_quien_vives=(int)$request->con_quien_vives;
        $usuario->ingresos_padre=(int)$request->ingresos_padre;
        $usuario->ingresos_madre=(int)$request->ingresos_madre;
        $usuario->ingresos_hermanos=(int)$request->ingresos_hermanos;
        $usuario->ingresos_propios=(int)$request->ingresos_propios;
        $ing_total=$request->ingresos_padre+$request->ingresos_madre+$request->ingresos_hermanos+$request->ingresos_propios;
        $usuario->total_ingresos=(int)$ing_total;
        $usuario->ocupacion_padre=(int)$request->ocupacion_padre;
        $usuario->ocupacion_madre=(int)$request->ocupacion_madre;
        $usuario->casa_vives=$request->casa_vives;
        $usuario->de_quien_dependes=(int)$request->de_quien_dependes;
        $usuario->cuartos_casa=(int)$request->cuartos_casa;
        $usuario->personas_casa=(int)$request->personas_casa;
        $usuario->personas_dependen=(int)$request->personas_dependen;
        $usuario->tipo_sangre="O";
        $usuario->calle_no=null;
        $usuario->casa_vives=null;
        $usuario->codigo_postal=null;
        $usuario->colonia=null;
        $usuario->comunicar_con=null;
        $usuario->entidad_federativa=null;
        $usuario->lugar_trabajo=null;
        $usuario->municipio=null;
        $usuario->telefono=null;
        $usuario->telefono_trabajo=null;
        $usuario->save();
        $id=$request->pre;
        $periodo=$request->periodo;
        $preficha=PreFicha2::where('preficha',(int)$id)->
        where('periodo',$periodo);
        $preficha->update(['bandera3'=>(int)1]);
        $request->session()->put('ter_campo',1);
        return redirect()->route('ficha.emer');
    }

    public function alta4(Request $request){
        $data=request()->validate([
            'comunicar_con'=>'required',
            'telefono'=>'required'
        ],[
            'comunicar_con.required'=>'Indique por favor, el nombre de una persona de contacto en caso de emergencia',
            'telefono.required'=>'Indique por favor, el teléfono de la persona de contacto en caso de emergencia',
        ]);
        $user=auth()->user();
        $id=$request->pre;
        $periodo=$request->periodo;
        $usuario=SocioEcono::where('no_solicitud',(int)$id)->
        where('periodo',$periodo);
        $usuario->update([
            'tipo_sangre'=>$request->tipo_sangre,
            'tipo_alergia'=>$request->tipo_alergia,
            'enfermedad'=>$request->enfermedad,
            'calle_no'=>$request->calle_no,
            'colonia'=>$request->colonia,
            'codigo_postal'=>$request->codigo_postal,
            'entidad_federativa'=>(int)$request->entidad_federativa,
            'municipio'=>$request->municipio,
            'telefono'=>$request->telefono,
            'lugar_trabajo'=>$request->lugar_trabajo,
            'telefono_trabajo'=>$request->telefono_trabajo
        ]);
        $preficha=PreFicha2::where('preficha',(int)$id)->
        where('periodo',$periodo);
        $preficha->update(['bandera4'=>(int)1]);
        $request->session()->put('cua_campo',1);
        return redirect()->route('ficha.inicio');
    }

    public function update(Request $request){
        $user=auth()->user();
        $id=$request->pre;
        $periodo=$request->periodo;
        $usuario=PreFicha::where('no_solicitud',(int)$id)->
        where('periodo',$periodo);
        $usuario->update([
            'apellido_paterno'=>utf8_decode($request->apellido_paterno),
            'apellido_materno'=>utf8_decode($request->apellido_materno),
            'nombre_aspirante'=>utf8_decode($request->nombre_aspirante),
            'curp'=>$request->curp,
            'carrera_opcion_1'=>$request->carrera_opcion_1,
        ]);
        return redirect()->route('ficha.inicio');
    }
    public function imprimir(Request $request){
        $id=$request->pre;
        $periodo=$request->periodo;
        $concepto=$request->tpago;
        /* Primero, verificar si ya llenó la información de la ficha */
        $pcampo=$request->session()->get('pri_campo');
        $scampo=$request->session()->get('seg_campo');
        $tcampo=$request->session()->get('ter_campo');
        $ccampo=$request->session()->get('cua_campo');
        $p_registro=$pcampo+$scampo+$tcampo+$ccampo;
        if($p_registro==4){
            /*Ahora, verificar lo que se va a pagar */
            $por_pagar=DB::table('conceptos')->select('descripcion','costo','finicio','flimite')
            ->where('clave',$concepto)
            ->get();
            $hoy=date('Y-m-d');
            $finicio=$por_pagar[0]->finicio;
            $flimite=$por_pagar[0]->flimite;
            $fecha_inicial=new DateTime($finicio);
            $fecha_final=new DateTime($flimite);
            $tiempo=$hoy<=$fecha_final?1:0;
            if(!$tiempo){
                return redirect()->route('ficha.error');
            }else{
                if(($concepto=='1000')||($concepto=='1006')){
                    $aceptado=PreFicha3::select('aceptado')
                    ->where('no_ficha',(int)$id)
                    ->where('no_solicitud',(int)$id)
                    ->where('periodo',$periodo)
                    ->get();
                    $bandera=$aceptado[0]->aceptado=="S"?1:0;
                }else{
                    $bandera=1;
                }
                if($bandera){
                    $info=PreFicha::select('apellido_paterno','apellido_materno','nombre_aspirante','carrera_opcion_1')
                    ->where('no_solicitud',(int)$id)
                    ->where('periodo',$periodo)
                    ->get();
                    $ncarrera=Carreras::select('nombre_ofertar')
                    ->where('ofertar',1)
                    ->where('carrera',$info[0]->carrera_opcion_1)
                    ->get();
                    $carrera_solicitada=$ncarrera[0]->nombre_ofertar;
                    $flimite=$por_pagar[0]->flimite;
                    $datos=explode("-",$flimite);
                    $dia=$datos["2"];
                    $mes=$this->mes($datos["1"]);
                    $anio=$datos["0"];
                    $flimite2=$dia."/".$mes."/".$anio;
                    $costo2="$".number_format($por_pagar[0]->costo,'2','.',',');
                    $control=$this->control($id);
                    $valor=$concepto.$control;
                    $banco=DB::table('parametros')->select('sucursal','cuenta','clabe')->get();
                    $cadena=$this->cpago2($valor,$flimite,$por_pagar[0]->costo);
                    $cadena=(strlen($cadena)==18?$cadena:substr($cadena,0,18));
                    $linea_captura=$this->banamex($banco[0]->sucursal,$banco[0]->cuenta,$cadena);
                    $mensaje=$concepto==3002?"(*) Incluye descuento de $200 por situación COVID":"";
                    $data=[
                        'ficha'=>$id,
                        'sucursal'=>$banco[0]->sucursal,
                        'cuenta'=>$banco[0]->cuenta,
                        'clabe'=>$banco[0]->clabe,
                        'carrera'=>utf8_encode($carrera_solicitada),
                        'appat'=>utf8_encode($info[0]->apellido_paterno),
                        'apmat'=>utf8_encode($info[0]->apellido_materno),
                        'nombre'=>utf8_encode($info[0]->nombre_aspirante),
                        'concepto'=>$por_pagar[0]->descripcion,
                        'costo'=>$costo2,
                        'flimite'=>$flimite2,
                        'linea'=>$linea_captura,
                        'mensaje'=>$mensaje
                    ];
                    $pdf = PDF::loadView('ficha.pdf',$data)->setPaper('Letter','Portrait');
                    return $pdf->download('formato pago.pdf');
                }else{
                    return redirect()->route('ficha.error2');
                }
            }
        }else{
            $error="No se ha terminado de contestar la encuesta correspondiente";
            return view('ficha.error')->with(compact('id','periodo','error'));
        }
    }
}
