<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ShoppingCart;
use App\AdicionalesArticulo;
use App\InShoppingCart;
use App\Articulo;
use App\Pago;

use App\Services\CredibancoService;

use Session;
use Cookie;

use DB;

use App\Order;

//Para las Notificaiones
use App\Message;
use App\User;
use App\Empresa;
use App\Notifications\MessageSent;

//Mail
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

//Para la pasarela
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;



class PaymentController extends Controller
{
    

    public function __construct(){
        $this->middleware("auth");      //Solo van a poder abrir ordenes quienes esten con sesion iniciada
        $this->middleware("shoppingcart"); 
        //$this->middleware('preventBackHistory'); 
       
    }


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //dd($request);
        $messages = [
            'buyerName.required' => 'Ingrese el nombre de la persona que recibe el pedido.',
            'shippinAddress.required' =>'Ingrese la dirección de entrega del pedido.',
            'shippinBarrio.required' => 'Ingrese el nombre del barrio.',
            'shippinPhone.required' => 'Ingrese el número telefónico para confirmar el pedido.',
            'shippinPhone.numeric' => 'El teléfono solo aceptan números.',
            'shippinPhone.min' => 'No es un número telefónico válido.',
            'shippinCity.required' => 'Ingrese la Ciudad.',
            'buyerEmail.required' => 'Debe agregar un Correo Electrónico.',
            'buyerEmail.email' => 'Debe ser un Correo Electrónico válido.'
        ];


        $this->validate($request, [

            'mesa' => 'required',
            'buyerName' => 'required',
            'shippinAddress' => 'required',
            'shippinBarrio' => 'required',
            'shippinPhone' => 'required|numeric|min:7',
            'shippinCity' => 'required',
            'buyerEmail' =>  'required|email',
            'plataforma' => 'required',
            

        ],$messages); 


        //return $request;





        
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        //dd($shopping_cart);

        $empresa = Empresa::find($shopping_cart->empresa_id);



        //Validacion
        //Si el status del carrito es 'Aprobado', no volver a enviar el mensaje
        if($shopping_cart->status == 'Aprobado'){
            \Session::remove("shopping_cart_id");
            Auth::logout();
            return view("main.home", ['empresa' => $empresa]);
        }
        
        //Pasarela de pago
        // $client = new Client();

        // $client->get( 'https://checkout.wompi.co/p/', [ 
        //     'form_params' => [ 
        //         'public-key' => 'pub_test_X0zDA9xoKdePzhd8a0x9HAez7HgGO2fH', 
        //         'currency' => 'COP', 
        //         'amount-in-cents' => $request->amount, 
        //         'reference' => '4XMPGKWWPKWQ'
        //     ] 
        // ]);

        // dd($response2);
        
        //FIN PASARELA DE PAGO

        //Enviar Mensaje de Notificacion
            //buscar el usuario de la empresa


            //////////// inicio funcion creaMEssage//////////////////
            // $usuario_admin_id = Empresa::find($request->empresa_id);
            // //dd($usuario_admin_id);

            // $existe = Message::where('tipo', '=', '1')->get()
            //           ->where('shopping_cart', '=' , $shopping_cart->id); 

            // //dd($existe->count());
            // if ($existe->count()==0)
            // {
            //     //crea el mensaje
            //     $message = Message::create([
            //         'sender_id' => auth()->id(),
            //         'recipient_id' => $usuario_admin_id->user_admin_id,
            //         'body' => 'Nuevo Pedido para :'.$shopping_cart->tipo,
            //         'tipo' => 1,
            //         'shopping_cart' => $shopping_cart->id,
            //         'empresa_id' => $request->empresa_id
            //     ]);
            //     //dd($message);
            //     //Guarda en la tabla notificaiones
            //     $recipient = User::find($usuario_admin_id->user_admin_id);
            //     //dd($message);
            //     $recipient->notify(new MessageSent($message));
            // }

            ////////////// fin function crearMessage/////////////////
 

        //Termina las notificaciones
        
        if($request)
        {

            //dd($request);
            $details = Order::createFromPayResponse($request, $shopping_cart->id);
            //dd($details);
            //$shopping_cart->approve();
             

            //Cookie::queue(Cookie::forget('namecompany'));
        }

        //dd($details);
        
        
        //Auth::logout();
        //return redirect('/');

        if($request->plataforma == 2)
        {
            $pagoCredibanco = resolve(CredibancoService::class);
            //dd(config('services.sess.key'));
            //dd($pagoCredibanco);
    
            return $pagoCredibanco->handlePayment($request,$shopping_cart->generateCustomID(),2);        
        }
        else
        {

            $this->creaMenssage();

            $shopping_cart->approve($shopping_cart->generateCustomID(), 1);
        }




        try {
            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
              ->setUsername('cierrescinnamon@gmail.com')
              ->setPassword('Cierres2014')
            ;
         
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
         
            // Create a message
            $body = 'Hello, <p>Email sent through <span style="color:red;">Swift Mailer</span>.</p>';
         
            $message = (new Swift_Message('Email Through Swift Mailer'))
              ->setFrom(['app@pedidos.com' => 'Aplicacion Nombre'])
              ->setTo([auth()->user()->email])
              //->setCc(['RECEPIENT_2_EMAIL_ADDRESS'])
              //->setBcc(['RECEPIENT_3_EMAIL_ADDRESS'])
              ->setBody($body)
              ->setContentType('text/html')
              //->attach(Swift_Attachment::fromPath(__DIR__. '/sample.png'))
              //->attach(Swift_Attachment::fromPath(__DIR__. '/sample-ebook.pdf'))
            ;
         
            // Send the message 
            
            //
            //$mailer->send($message); //descomentar


            // $header = 'From: contacto@restaurantegallus.com' . " \r\n";
            // $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
            // $header .= "Mime-Version: 1.0 \r\n";
            // $header .= "Content-Type: text/plain";
            
            // $mensaje = "Mensaje: Peiddo Enviado" . " \r\n";
            // $mensaje .= "Enviado el " . date('d/m/Y', time());
            
            // $para = auth()->user()->email;
            // $copia = 'sergioess24@gmail.com';
            
            // $asunto = 'Restaurante Mr Gallus';
            
            // mail("$para, $copia", $asunto, utf8_decode($mensaje), $header);   


         
            //echo 'Email has been sent.';
        } catch(Exception $e) {
            echo $e->getMessage();
        }           

        return view('shoppingcarts.complete', ['shopping_cart' => $request->shopping_cart, 'order' => $details]);
        
    }

    public function creaMenssage()
    {

        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        //dd($_COOKIE["idcompany"]);
        $empresa_id = $_COOKIE["idcompany"]; 
        $usuario_admin_id = Empresa::find($empresa_id);
        //dd($usuario_admin_id);

        $existe = Message::where('tipo', '=', '1')->get()
                  ->where('shopping_cart', '=' , $shopping_cart->id); 

        //dd($existe->count());
        if ($existe->count()==0)
        {
            //crea el mensaje
            $message = Message::create([
                'sender_id' => auth()->id(),
                'recipient_id' => $usuario_admin_id->user_admin_id,
                'body' => 'Nuevo Pedido para :'.$shopping_cart->tipo,
                'tipo' => 1,
                'shopping_cart' => $shopping_cart->id,
                'empresa_id' => $empresa_id
            ]);
            //dd($message);
            //Guarda en la tabla notificaiones
            $recipient = User::find($usuario_admin_id->user_admin_id);
            //dd($message);
            $recipient->notify(new MessageSent($message));
        }

    }


    public function approval(Request $request)
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);


        $pagoCredibanco = resolve(CredibancoService::class);

        $respuestaPago = $pagoCredibanco->handleApproval();
        
        
        //dd($respuestaPago->paymentAmountInfo->paymentState);
        //dd($pagoCredibanco->orderNumber);
        //dd($respuestaPago);

        if($respuestaPago->paymentAmountInfo->paymentState == "DEPOSITED")
        {
            if($respuestaPago->orderStatus == 2)
            $shopping_cart->approve($respuestaPago->orderNumber, 2);

            $order = Order::where('shopping_cart_id' , '=', $shopping_cart->id)->first();
            //dd($order);

            Pago::createFromPayResponse($respuestaPago, $shopping_cart, $order);
             
            //Cookie::queue(Cookie::forget('idcompany'));
            Cookie::queue(Cookie::forget('namecompany'));

            
            

            $this->creaMenssage();

            return view('shoppingcarts.complete', ['shopping_cart' => $shopping_cart, 'order' => $order, 'success' => 'Hemos recibido su pago']);
                // ->withSuccess('success', 'Hemos recibido su pago');


            
        }

        
        //dd($request->orderId);

        // $empresa = Empresa::find($shopping_cart->empresa_id);
        // $datos = session()->get('dataR');
        // dd($datos);



       
        
    }


    public function cancelled()
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);


        $pagoCredibanco = resolve(CredibancoService::class);        
        $respuestaPago = $pagoCredibanco->handleApproval();
        //dd($respuestaPago);
        // Eliminar de la tabla orden la orden de ese id de shoppingcart

        $ids_to_delete = Order::where('shopping_cart_id', '=' , $shopping_cart->id)
        ->get(['id']); 
        
        Order::destroy($ids_to_delete->toArray());

        $mensajedeError = $respuestaPago->actionCodeDescription;

        return redirect('datosentrega')->with('error',$mensajedeError);
        
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
 //
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

    public function respuesta(Request $request)
    {



        $client = new Client();
        $url = 'https://sandbox.wompi.co/v1/transactions/'.$request->id;
    	$response = $client->request('GET', $url);
    	$statusCode = $response->getStatusCode();
        //$body = $response->getBody()->getContents();
        
        $array = json_decode($response->getBody()->getContents(), true);
     


        //lo mismo de shoppingvart.index
        $shopping_cart = $request->shopping_cart;





        //$total = $shopping_cart->total();

        //Total del Carrito
        // $total = InShoppingCart::leftJoin('articulos', 'articulos.id', '=', 'in_shopping_carts.articulo_id')
        // ->where('in_shopping_carts.shopping_cart_id',"=" ,$shopping_cart->id)
        // ->sum(DB::raw('articulos.precio * in_shopping_carts.cantidad'));


         $total = InShoppingCart::where('in_shopping_carts.shopping_cart_id',"=" ,$shopping_cart->id)
         ->sum(DB::raw('in_shopping_carts.precio * in_shopping_carts.cantidad'));        
        //dd($total);

        //Articulos agregados al carrito
        $articulos = ShoppingCart::select('in_shopping_carts.id as cod', 'articulos.descripcion', 'articulos.precio', 'articulos.id as artid', 'in_shopping_carts.id as innshop_id'
        , 'in_shopping_carts.cantidad')
        ->leftjoin('in_shopping_carts', 'in_shopping_carts.shopping_cart_id', '=', 'shopping_carts.id')
        ->leftJoin('articulos', 'articulos.id', '=', 'in_shopping_carts.articulo_id')
        ->where('shopping_carts.id',$shopping_cart->id)
        ->get();

        //Trae los adicionales para mostrarlos
        //1. Articulos del Carrito
        $ptosCarrito = InShoppingCart::select('in_shopping_carts.articulo_id')
        ->where('shopping_cart_id', '=', $shopping_cart->id)->get();

        //dd($ptosCarrito->toArray());

        //2. Articulos adicionales asignados al carrito
        $articuloIn = AdicionalesArticulo::select('adicionales_articulos.adiciona_articulo_id as id')
        ->distinct('adicionales_articulos.adiciona_articulo_id')
        ->whereIn('adicionales_articulos.articulo_id', $ptosCarrito)->get();
        //dd($articuloIn->toArray());

        //3. Datos del articulo
        $articulosAdicionales = Articulo::select('articulos.id', 'articulos.descripcion', 'articulos.precio', 'articulos.imagen', 'articulos.impto')
        ->whereIn('id',  $articuloIn->toArray())
        ->get();
        //dd($articulosAdicionales);
        

        $empresa = Empresa::find($shopping_cart->empresa_id);
        // FIN DE LOS MISMO DE SHOPPINGCART.INDEX




        if($array["data"]["status"] == "APPROVED")
        {
            return view('shoppingcarts.index', ['articulos' => $articulos, 'total' => $total, 'shopping_cart' => $shopping_cart, 'articulosAdicionaes' => $articulosAdicionales
            , 'empresa' => $empresa,'StatusPasarela' => "APPROVED"]);
            //return redirect()->route('productos.index');
        }
        else{
            return redirect('/carrito', ['StatusPasarela' => "REJECT"]);
        }
        
        //FIN PASARELA DE PAGO


    }
}
