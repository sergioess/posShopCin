<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\InShoppingCart;
use App\ShoppingCart;
use App\Empresa;
use App\User;
use Illuminate\Support\Facades\Auth;

use App\Notifications\MessageSent;
use App\Message;


use Carbon\Carbon;
use App\Reserva;

use Cookie;

//Mail
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class ReservaController extends Controller
{

    public function __construct(){
        $this->middleware("auth");      //Solo van a poder abrir ordenes quienes esten con sesion iniciada
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reserva.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'date' => 'required',
            'personas' => 'required',
            'hora' => 'required',
            'minutos' => 'required',

        ]); 





        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        //dd($request);


        // if($shopping_cart->status == 'Aprobado'){
        //     $empresa = Empresa::find($shopping_cart->empresa_id);
        //     \Session::remove("shopping_cart_id");
        //     return view("main.home", ['empresa' => $empresa]);
        // }
        //Si se da el botón atras y siguen agregando articulos
        if($shopping_cart->status == 'Aprobado'){
            \Session::remove("shopping_cart_id");
            return redirect('/logout');
        }
        
        //////////////////////////////
        //Guarda la Reserva
        //////////////////////////////

        $hora = "01-01-1900 ".$request->hora.":".$request->minutos.":00";
        $date1 = str_replace('/', '-', $request->input('date'));
        //dd($date1);
        // create the mysql date format
        $dateformat1 = Carbon::createFromFormat('d-m-Y', $date1);
        $dateformat2 = Carbon::createFromFormat('d-m-Y H:i:s', $hora);
        //dd($dateformat1);


        // $date1 = str_replace('.', '-', $request->input('expiredUntil'));
        // // create the mysql date format
        // $dateformat1= Carbon::createFromFormat('d-m-Y H:i:s', $date1);
    
        $reserva = new Reserva;
        $reserva->fecha = $dateformat1;
        $reserva->comensales = $request->personas;
        $reserva->hora = $dateformat2;
        $reserva->shopping_cart_id = $shopping_cart->id;
        $reserva->empresa_id = $shopping_cart->empresa_id;
        $reserva->observacion = $request->observacion;
        $reserva->user_id = auth()->id();
        $reserva->save();


        //////////////////////////////
        //Enviar Mensaje de Notificacion
        //////////////////////////////
        //buscar el usuario de la empresa
        $usuario_admin_id = Empresa::find($shopping_cart->empresa_id);
        //dd($usuario_admin_id);

        $existe = Message::where('tipo', '=', '5')->get()
                    ->where('shopping_cart', '=' , $shopping_cart->id); 

        //dd($existe->count());
        if ($existe->count()==0)
        {
            //crea el mensaje
            $message = Message::create([
                'sender_id' => auth()->id(),
                'recipient_id' => $usuario_admin_id->user_admin_id,
                'body' => 'Nueva reserva',
                'tipo' => 5,
                'shopping_cart' => $shopping_cart->id,
                'empresa_id' => $shopping_cart->empresa_id
            ]);

            //Guarda en la tabla notificaiones
            $recipient = User::find($usuario_admin_id->user_admin_id);
            //dd($message);
            $recipient->notify(new MessageSent($message));
        }

        //////////////////////////////
        //Cambiar status del carrito
        ///////////////////////////////

        if($request)
        {


            $shopping_cart->approve();

            Cookie::queue(Cookie::forget('namecompany'));
        }


        //////////////////////////////
        //Envía correo de notificacion
        ///////////////////////////////

        try {
            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
              ->setUsername('cierrescinnamon@gmail.com')
              ->setPassword('Cierres2014')
            ;
         
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
         
            // Create a message
            $body = 'Su Reserva se ha creado con exito para el día '.$request->date.', Hora: '.$request->hora.":".$request->minutos.'
            , <p>Email sent through <span style="color:red;">POSSHOP</span>.</p>';
         
            $message = (new Swift_Message('Confirmacion de Reserva'))
              ->setFrom(['app@pedidos.com' => $usuario_admin_id->nombre])
            //   ->setTo([auth()->user()->email])
              ->setTo(['sergioess@hotmail.com'])
              //->setCc(['RECEPIENT_2_EMAIL_ADDRESS'])
              //->setBcc(['RECEPIENT_3_EMAIL_ADDRESS'])
              ->setBody($body)
              ->setContentType('text/html')
              //->attach(Swift_Attachment::fromPath(__DIR__. '/sample.png'))
              //->attach(Swift_Attachment::fromPath(__DIR__. '/sample-ebook.pdf'))
            ;
         
            // Send the message 
            
            //$mailer->send($message); //descomentar

            $header = 'From: contacto@restaurantegallus.com' . " \r\n";
            $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
            $header .= "Mime-Version: 1.0 \r\n";
            $header .= "Content-Type: text/plain";
            
            $mensaje = "Mensaje: Reserva Enviada" . " \r\n";
            $mensaje .= "Dia: " . $request->date . " \r\n";
            $mensaje .= "Hora: " . $request->hora . ":".$request->minutos . " \r\n";
            $mensaje .= "Personas: " . $request->personas . " \r\n";
            $mensaje .= "Enviado el " . date('d/m/Y', time());
            
            $para = auth()->user()->email;
            $copia = 'sergioess24@gmail.com';
            
            $asunto = 'Restaurante Mr Gallus';
            
            mail("$para, $copia", $asunto, utf8_decode($mensaje), $header);     

         
            //echo 'Email has been sent.';
        } catch(Exception $e) {
            echo $e->getMessage();
        }                 



        //REDIRECCINAR

        return view('reserva.complete', ['shopping_cart' => $shopping_cart, 'fecha' => $request->date, 'hora' => $request->hora.":".$request->minutos, 'observa' => $request->observacion]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');

        $response = ShoppingCart::where('id', $shopping_cart_id)
          ->update(['tipo' => 'Reserva', 'empresa_id' => $request->empresa_id, 'user_id' => auth()->user()->id]);

        if($response==1){
            return redirect('/reserva');
        }else{
            return back();
        }     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
