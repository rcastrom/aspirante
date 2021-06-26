<?php

namespace App\Http\Controllers;

use App\Preformato;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PreformatoController extends Controller
{
    public function envia($correo,$id)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'robot.escolares@ite.edu.mx';       // SMTP username
            $mail->Password = 'ywzteqinycssrxww';                 // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            $mail->CharSet = 'UTF-8';                               //Manejo de acentos

            //Recipients
            $mail->setFrom('robot.escolares@ite.edu.mx', 'Departamento de Servicios Escolares ITE');
            $mail->addAddress(addslashes(trim($correo)), 'Aspirante');     // Add a recipient
            $creacion = "asp211_" . $id . "@ite.edu.mx";

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Aspirante a ingresar';
            $txt = "<h3>Buenas tardes</h3>" .
                "<h4>Aspirante a ingresar al Tecnológico Nacional de México / Instituto " .
                "Tecnológico de Ensenada</h4> <p>Primeramente, es agrado de nuestra comunidad " .
                "que se encuentre en el proceso de ingreso en este periodo 2021-1; así mismo, le " .
                "comentamos que nos estaremos poniendo en contacto con Usted para informarle sobre " .
                "el examen diagnóstico y de ubicación a la brevedad posible.</p><p> Por lo pronto," .
                " le informamos lo siguiente:" .
                "<ol>" .
                "<li>Se te creo el correo electrónico " . $creacion . " que está en Google, la contraseña para el mismo es <b>aspIranTE</b> y al momento
        de ingresar, deberá cambiar de contraseña.</li>" .
                "<li><u>Para cualquier trámite que vaya a realizar como aspirante (hasta que no sea alumno), deberá de emplear " .
                " esa cuenta de correo.</u></li>" .
                "<li>Debe ingresar a la dirección de internet <a href='https://aspirante.ensenada.tecnm.mx/register'>https://aspirante.ensenada.tecnm.mx/register</a>" .
                "y el correo que debe emplear es " . $creacion . " y la contraseña la que desee (no olvide apuntarle por favor).</li>" .
                "<li>Llena la información solicitada, genera el recibo de pago y realiza el depósito en Banamex.</li>" .
                "<li>Envía una copia del depósito realizado al correo desarrollo@ite.edu.mx; en ese correo, por favor señala la carrera".
                " a la que deseas ingresar. <b><u>SI ES PARA EL SISTEMA SEMI ESCOLARIZADO, FAVOR DE SEÑARLO EN ESE CORREO.</u></b></li>" .
                "</ol>" .
                "<p>Cuando sea necesario mandar una información adicional, se hará vía el correo creado.</p>" .
                "<p>Por favor, no responda a éste mensaje ya que ha sido generado de manera automática " .
                "y nadie estará pendiente del buzón. En caso de tener alguna duda, mandar un correo a " .
                "desarrollo@ite.edu.mx </p>";
            $mail->Body = $txt;
            if ($mail->send()) {
                return 1;
            }
        } catch (Exception $e) {
            return 0;
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre'                 => 'required',
            'appat'                  => 'required',
            'curp'                   => 'required|unique:preformatos,curp',
            'email'                  => 'required|unique:users,email|email'
        ],[
            'nombre.required'        => 'Favor de indicar el nombre',
            'appat.required'         => 'Favor de indicar el nombre',
            'curp.required'          => 'Favor de indicar el nombre',
            'curp.unique'            => 'El CURP ya ha sido empleado',
            'email.required'         => 'Favor de indicar el correo electrónico',
            'email.unique'           => 'El correo electrónico ya ha sido empleado',
            'email.email'            => 'Por favor, escriba un correo electrónico válido'
        ]);
        date_default_timezone_set('America/Tijuana');
        $nombre=$request->get('nombre');
        $apellidos=$request->get('appat');
        $curp=$request->get('curp');
        $correo=$request->get('email');
        $preficha = new Preformato();
        $preficha->periodo='20211';
        $preficha->nombre=$nombre;
        $preficha->apellidos=$apellidos;
        $preficha->curp=$curp;
        $preficha->correo=$correo;
        $hoy=date('Y-m-d H:i:s');
        $preficha->cuando=$hoy;
        $preficha->creado=0;
        $preficha->save();
        $id=$preficha->id;
        //$enviado=$this->envia($correo,$id);
        /*if($enviado){
            $linea="/home/soporte/bin/gam/gam create user asp211_".$id."@ite.edu.mx firstname '".$nombre."' lastname '".$apellidos."' password aspIranTE changepassword on org aspirantes";
		    exec($linea);
            $linea2="/home/soporte/bin/gam/gam update group aspirantes211@ite.edu.mx add member asp211_".$id."@ite.edu.mx";
            exec($linea2);
		    Preformato::where('id',$id)->update([
		       'creado'=>1,
               'updated_at'=>Carbon::now()
            ]);
        }*/
        return redirect()->to('/gracias');
    }
    public function registrado(){
        return view('sessions.gracias');
    }
}
