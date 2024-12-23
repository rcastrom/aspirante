<?php

namespace App\Http\Controllers;

use App\Models\DatoPersonal;
use App\Models\Ficha;
use App\Models\Pais;
use App\Models\Estado;
use App\Models\Etnia;
use App\Models\Carrera;
use Illuminate\Http\Request;

class DatoPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aspirante=session('aspirante');
        if(!DatoPersonal::where('aspirante_id',$aspirante)->exists()){
            $paises = Pais::select(['id', 'nombre', 'codigo'])
                ->orderBy('nombre', 'ASC')
                ->get();
            $estados = Estado::select(['estado_id', 'estado'])
                ->orderBy('estado_id', 'ASC')
                ->get();
            $etnias = Etnia::all();
            $carreras = Carrera::where('ofertar', 1)
                ->select(['carrera', 'nombre_carrera'])
                ->get();
            return view('fichas.datos_personales',
                compact('paises', 'estados', 'etnias', 'carreras'));

        }
        $dato=DatoPersonal::where('aspirante_id',$aspirante)->first();
        return redirect()->route('datos_personales.show',["datos_personale" => $dato->id]);
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
            'nombre_aspirante'=>'required',
            'apellido_materno'=>'required',
            'fecha_nacimiento'=>'required',
            'curp'=>'required|size:18',
            'telefono'=>'required',
            'calle_numero'=>'required',
            'colonia'=>'required',
            'municipio'=>'required',
            'codigo_postal'=>'required'
        ],[
            'nombre_aspirante.required'=>'Por favor, escriba su nombre',
            'apellido_materno.required'=>'Por favor, escriba su apellido materno',
            'fecha_nacimiento.required'=>'Por favor, escriba la fecha de nacimiento',
            'curp.required'=>'Por favor, escriba la CURP',
            'curp.size'=>'La longitud del CURP debe ser de 18 caracteres',
            'telefono.required'=>'Por favor, indique su teléfono',
            'calle_numero.required'=>'Debe indicar el domicilio (calle y numero)',
            'colonia.required'=>'Debe indicar la colonia',
            'municipio.required'=>'Indique por favor su municipio de residencia',
            'codigo_postal.required'=>'Indique por favor su código postal'
        ]);
        $registro_dato_personal=new DatoPersonal();
        $registro_dato_personal->aspirante_id=session('aspirante');
        $registro_dato_personal->nombre=$request->nombre_aspirante;
        $registro_dato_personal->apellido_paterno=$request->apellido_paterno ?? null;
        $registro_dato_personal->apellido_materno=$request->apellido_materno;
        $registro_dato_personal->fecha_nacimiento=$request->fecha_nacimiento;
        $registro_dato_personal->sexo=$request->sexo;
        $registro_dato_personal->pais_id=$request->pais;
        $registro_dato_personal->estado_nacimiento_id=$request->estado_nacimiento;
        $registro_dato_personal->municipio_nacimiento_id=$request->municipio_nacimiento;
        $registro_dato_personal->etnia_id=$request->etnia;
        $registro_dato_personal->curp=$request->curp;
        $registro_dato_personal->carrera=$request->carrera;
        $registro_dato_personal->calle_numero=$request->calle_numero;
        $registro_dato_personal->colonia=$request->colonia;
        $registro_dato_personal->codigo_postal=$request->codigo_postal;
        $registro_dato_personal->estado_domicilio_id=$request->entidad_federativa;
        $registro_dato_personal->municipio_domicilio_id=$request->municipio;
        $registro_dato_personal->telefono=$request->telefono;
        $registro_dato_personal->save();
        Ficha::where('aspirante',session('aspirante'))->update([
            'bandera1'=>1
        ]);
        session(['bandera1'=>1]);
        return redirect()->route('datos_familiares.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DatoPersonal $datos_personale)
    {
        $pais=$datos_personale->pais()->first();
        $estado=$datos_personale->estado_nacimiento()->first();
        $municipio=$datos_personale->municipio_nacimiento()->first();
        $etnia=$datos_personale->etnia()->first();
        $carrera=Carrera::where([
            'carrera'=>$datos_personale->carrera,
            'ofertar'=>1
        ])->select('nombre_carrera')->first();
        $estado_domicilio=$datos_personale->estado_domicilio()->first();
        $municipio_domicilio=$datos_personale->municipio_domicilio()->first();
        return view('fichas.datos_personales_show',compact('datos_personale',
            'pais','estado','municipio','etnia','carrera','estado_domicilio',
            'municipio_domicilio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatoPersonal $datos_personale)
    {
        $paises = Pais::select(['id', 'nombre', 'codigo'])
            ->orderBy('nombre', 'ASC')
            ->get();
        $estados = Estado::select(['estado_id', 'estado'])
            ->orderBy('estado_id', 'ASC')
            ->get();
        $etnias = Etnia::all();
        $carreras = Carrera::where('ofertar', 1)
            ->select(['carrera', 'nombre_carrera'])
            ->get();
        return view('fichas.datos_personales_edit',
            compact('datos_personale','paises','estados','etnias','carreras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DatoPersonal $datos_personale)
    {
        request()->validate([
            'nombre_aspirante'=>'required',
            'apellido_materno'=>'required',
            'fecha_nacimiento'=>'required',
            'curp'=>'required|size:18',
            'telefono'=>'required',
            'calle_numero'=>'required',
            'colonia'=>'required',
            'municipio'=>'required',
            'codigo_postal'=>'required'
        ],[
            'nombre_aspirante.required'=>'Por favor, escriba su nombre',
            'apellido_materno.required'=>'Por favor, escriba su apellido materno',
            'fecha_nacimiento.required'=>'Por favor, escriba la fecha de nacimiento',
            'curp.required'=>'Por favor, escriba la CURP',
            'curp.size'=>'La longitud del CURP debe ser de 18 caracteres',
            'telefono.required'=>'Por favor, indique su teléfono',
            'calle_numero.required'=>'Debe indicar el domicilio (calle y numero)',
            'colonia.required'=>'Debe indicar la colonia',
            'municipio.required'=>'Indique por favor su municipio de residencia',
            'codigo_postal.required'=>'Indique por favor su código postal'
        ]);
        DatoPersonal::where('aspirante_id',$datos_personale->aspirante_id)->update([
            'nombre'=>$request->nombre_aspirante,
            'apellido_paterno'=>$request->apellido_paterno,
            'apellido_materno'=>$request->apellido_materno,
            'fecha_nacimiento'=>$request->fecha_nacimiento,
            'sexo'=>$request->sexo,
            'pais_id'=>$request->pais,
            'estado_nacimiento_id'=>$request->estado_nacimiento,
            'municipio_nacimiento_id'=>$request->municipio_nacimiento,
            'etnia_id'=>$request->etnia,
            'curp'=>$request->curp,
            'carrera'=>$request->carrera,
            'telefono'=>$request->telefono,
            'calle_numero'=>$request->calle_numero,
            'colonia'=>$request->colonia,
            'codigo_postal'=>$request->codigo_postal,
            'estado_domicilio_id'=>$request->entidad_federativa,
            'municipio_domicilio_id'=>$request->municipio,
        ]);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatoPersonal $datoPersonal)
    {
        //
    }
}
