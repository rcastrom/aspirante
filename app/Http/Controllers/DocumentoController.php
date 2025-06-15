<?php

namespace App\Http\Controllers;

use App\Services\MaxUploadSizeService;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use App\Models\Documento;
use App\Models\User;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws \Exception
     */
    public function index()
    {
        $maxMB=MaxUploadSizeService::getMaxUploadSize('3M');
        return view('fichas.documentos')->with(compact('maxMB'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fichas.documentos_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=auth()->user();
        $aspirante=session('aspirante');
        $errores=array();
        $bandera=0;
        if($request->hasFile('photo')){
            try{
                $manager=new ImageManager(new Driver());
                $imagen=$manager->read($request->file('photo')->get());
                $imagen->resize(300,300);
                Storage::disk('fotos')->put($user->id,$imagen->encode());
                User::where('id',$user->id)
                    ->update(
                        [
                            'profile_photo_path'=>Storage::disk('fotos')->url($user->id),
                        ]
                    );
                $foto=Storage::disk('fotos')->url($user->id);
            }catch(\Exception $e){
                dd($e);
            }
        }
        if($request->file('curp')!=null){
            if ($request->file('curp')->getError()) {
                $errores['curp']='El archivo de la CURP sobrepasa al límite establecido';
                $bandera++;
            }else{
                Storage::disk('curp')->put($user->id,$request->file('curp')->get());
                $curp=Storage::disk('curp')->url($user->id);
            }
        }
        if($request->file('prepa')!=null){
            if($request->file('prepa')->getError()){
                $errores['prepa']='El archivo del certificado de la preparatoria sobrepasa al límite establecido';
                $bandera++;
            }else{
                Storage::disk('certificados')->put($user->id,$request->file('prepa')->get());
                $prepa=Storage::disk('certificados')->url($user->id);
            }
        }
        if($request->file('constancia')!=null){
            if($request->file('constancia')->getError()){
               $errores['constancia']='El archivo de la constancia de preparatoria sobrepasa al límite establecido';
               $bandera++;
            }else{
                Storage::disk('constancias')->put($user->id,$request->file('constancia')->get());
                $certificado_prepa=Storage::disk('constancias')->url($user->id);
            }
        }
        if($request->file('acta_nacimiento')!=null){
            if($request->file('acta_nacimiento')->getError()){
                $errores['acta_nacimiento']='El archivo del acta de nacimiento sobrepasa al límite establecido';
                $bandera++;
            }else{
                Storage::disk('actas')->put($user->id,$request->file('acta_nacimiento')->get());
                $acta_nacimiento=Storage::disk('actas')->url($user->id);
            }
        }
        if($request->file('imss')!=null){
            if($request->file('imss')->getError()){
                $errores['imss']='El archivo del número de seguridad social, sobrepasa al límite establecido';
                $bandera++;
            }else{
                Storage::disk('seguros')->put($user->id,$request->file('imss')->get());
                $imss=Storage::disk('seguros')->url($user->id);
            }
        }
        if($bandera==0){
            if(Documento::where('aspirante_id',$aspirante)->count()>0){
                Documento::where('aspirante_id',$aspirante)->first()->update([
                    'foto'=>$foto ?? null,
                    'curp'=>$curp ?? null,
                    'certificado_prepa'=>$prepa ?? null,
                    'constancia_terminacion'=>$certificado_prepa ?? null,
                    'acta_nacimiento'=>$acta_nacimiento ?? null,
                    'constancia_imss'=>$imss  ?? null,
                ]);
            }else{
                $registro_documentos=new Documento();
                $registro_documentos->aspirante_id=$aspirante;
                $registro_documentos->periodo=session('periodo');
                $registro_documentos->foto=$foto ?? null;
                $registro_documentos->curp=$curp ?? null;
                $registro_documentos->certificado_prepa= $prepa ?? null;
                $registro_documentos->constancia_terminacion=$certificado_prepa ?? null;
                $registro_documentos->acta_nacimiento=$acta_nacimiento ?? null;
                $registro_documentos->constancia_imss=$imss ?? null;
                $registro_documentos->save();
            }
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors($errores);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
