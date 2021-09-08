<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\ShoppingCart;
use App\User;
use App\Message;
use App\Reserva;
use App\Order;
use App\InShoppingCart;
use App\Empresa;
use App\Pago;

use DB;

use Illuminate\Notifications\DatabaseNotification;


class NotificationsController extends Controller
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

        $notifications = Auth::user()->unreadNotifications
        ->sortBy('created_at')->first();
        //return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
        //$enArreglo = $notifications->toArray();
        //$primero = $enArreglo[0];

        //dd($notifications);



        if ($notifications)
        {
            $carrito = $notifications->data['shopping_cart'];
            $comprador_id = $notifications->data['sender_id'];
            $receptor_id = $notifications->data['recipient_id'];
            $id_notificacion = $notifications->id;
        }
        //dd($id_notificacion);

        //$noti=$notifications;


        // $fila=0;
        // $comprador_id = 0;
        // $id_notificacion = 0;
        // $receptor_id = 0;
        // $carrito = 0;
        // foreach($notifications as $i)
        // {

        //     if($fila==0)
        //     {
        //         $carrito = $i->data['shopping_cart'];
        //         $comprador_id = $i->data['sender_id'];
        //         $receptor_id = $i->data['recipient_id'];
        //         $id_notificacion = $i->id;
        //         $fila=1;
        //         $noti=$i;
        //     }
        // }
        //dd($noti);

        

        if($notifications)
        {
            //dd($id_notificacion);
            $shoping_cart = ShoppingCart::find($carrito);
            //dd($shoping_cart);
            //$total = ShoppingCart::find($carrito)->total();

            //datos de la empresa para saber si muestra la preggunta de la vajilla
            $empresa = Empresa::find($shoping_cart->empresa_id);

            $total = InShoppingCart::where('in_shopping_carts.shopping_cart_id',"=" ,$shoping_cart->id)
            ->sum(DB::raw('in_shopping_carts.precio * in_shopping_carts.cantidad'));   

            $comprador = User::find($comprador_id);
    
            //dd($comprador);
            //dd($notifications);

            $pedido = Order::where('shopping_cart_id', '=', $shoping_cart->id)->first();      //arreglar buscar solo el primero
            //dd($pedido);
    
            $articulos = ShoppingCart::select('in_shopping_carts.id as cod', 'articulos.descripcion',  'articulos.id as codart', 'in_shopping_carts.cantidad as cantidad'
            , 'in_shopping_carts.precio as precio')
            ->leftjoin('in_shopping_carts', 'in_shopping_carts.shopping_cart_id', '=', 'shopping_carts.id')
            ->leftJoin('articulos', 'articulos.id', '=', 'in_shopping_carts.articulo_id')
            ->where('shopping_carts.id',$carrito)
            ->get();

            //dd($shoping_cart->id);
            $pago = Pago::where('shoppingcart', '=', $shoping_cart->id)->first();
            //dd($pago);

            if($shoping_cart->tipo=='Reserva')
            {
                // dd($shoping_cart);
                $reserva = Reserva::where( 'shopping_cart_id' ,$shoping_cart->id)->first();



                return view('notifications.index', ['primero' => $notifications, 'articulos' => $articulos, 'total' => $total, 
                'comprador' => $comprador, 'shopping_cart' => $shoping_cart, 'id_notificacion' => $id_notificacion, 'receptor_id' => $receptor_id,
                'vista' => '1', 'reservas' => $reserva, 'order' => $pedido]);
            }
            else
            {
                //sdd($notifications);
                return view('notifications.index', ['primero' => $notifications, 'articulos' => $articulos, 'total' => $total, 
                'comprador' => $comprador, 'shopping_cart' => $shoping_cart, 'id_notificacion' => $id_notificacion, 'receptor_id' => $receptor_id,
                'vista' => '1', 'order' => $pedido, 'empresa' => $empresa, 'pagos' => $pago ]);
            }

              
            
        }
        else
        {
 

            return view('notifications.index', ['vista' => '0']);


        } 
        //dd($comprador_id);



    }



    public function store(Request $request)
    {

        DatabaseNotification::find($request->notificacion_id)->markAsRead();

        $shoping_cart = ShoppingCart::find($request->shopping_cart_id)->updateStatusEnPreparacion();
        //$shoping_cart2 = ShoppingCart::find($request->shopping_cart_id);
        //dd($shoping_cart2);
        //Notificar al cliente puede ser por correo

        //dd($request);
        //Se crea un registro en tabla mensaje aceptando el pedido

        //Cambia el esatado de la orden a recibido
        //$order = Order::where('shopping_cart_id','=',$request->shopping_cart_id)->get();
        //dd($order);
        //$order->status ='recibido';
        //$order->save();
        $response = Order::where('shopping_cart_id','=',$request->shopping_cart_id)
          ->update(['status' => 'recibido']);        
        
          
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'recipient_id' => $request->recipient_id,
            'body' => 'Nuevo Pedido para :'.$request->shopping_cart_tipo,
            'tipo' => 2,
            'shopping_cart' => $request->shopping_cart_id,
            'empresa_id' => $request->empresa_id
        ]);


        return back()->with('flash', 'Pedido Aceptado');
    }


    public function show($id)
    {

    
        $shoping_cart = ShoppingCart::find($id);
        //$total = ShoppingCart::find($id)->total();
        $total = InShoppingCart::where('in_shopping_carts.shopping_cart_id',"=" ,$shoping_cart->id)
        ->sum(DB::raw('in_shopping_carts.precio * in_shopping_carts.cantidad'));   

        $comprador = User::find($shoping_cart->user_id);

        //dd($comprador);
        //dd($notifications);
        //dd($shoping_cart);
        //datos de la empresa para saber si muestra la preggunta de la vajilla
        $empresa = Empresa::find($shoping_cart->empresa_id);


        $pedido = Order::where('shopping_cart_id', '=', $shoping_cart->id)->first();      //arreglar buscar solo el primero
        //dd($pedido);

        $articulos = ShoppingCart::select('in_shopping_carts.id as cod', 'articulos.descripcion', 'articulos.id as codart', 'in_shopping_carts.cantidad as cantidad'
        , 'in_shopping_carts.precio as precio')
        ->leftjoin('in_shopping_carts', 'in_shopping_carts.shopping_cart_id', '=', 'shopping_carts.id')
        ->leftJoin('articulos', 'articulos.id', '=', 'in_shopping_carts.articulo_id')
        ->where('shopping_carts.id',$id)
        ->get();



        return view('invoice', ['articulos' => $articulos, 'total' => $total, 
        'comprador' => $comprador, 'shopping_cart' => $shoping_cart, 'order' => $pedido, 'empresa' => $empresa ]);
        
        //dd($comprador_id);



    }    


}
