<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $fillable = ['errorCode', 'errorMessage', 'orderNumber', 'orderStatus', 'actionCode', 'amount', 'date', 'ip', 'cardholderName', 'approvalCode', 'pan'
    , 'authDateTime', 'terminalId', 'authRefNum', 'authRefNum', 'paymentState', 'approvedAmount', 'depositedAmount', 'refundedAmount', 'shoppingcart', 'orderid'];


    public static function createFromPayResponse($response, $shoppingcart, $order)
    {
        //dd($response);

        return  Pago::create([
            'errorCode' => $response->errorCode,
            'errorMessage' => $response->errorMessage,
            'orderNumber' => $response->orderNumber,
            'orderStatus' => $response->orderStatus,
            'actionCode' => $response->actionCode,
            'amount' => $response->amount / 100,
            'date' => $response->date,
            'ip' => $response->ip,
            'cardholderName' => $response->cardAuthInfo->cardholderName,
            'approvalCode' => $response->cardAuthInfo->approvalCode,
            'pan' => $response->cardAuthInfo->pan,
            'authDateTime' => $response->authDateTime,
            'terminalId' => $response->terminalId,
            'authRefNum' => $response->authRefNum,
            'paymentState' => $response->paymentAmountInfo->paymentState,
            'approvedAmount' => $response->paymentAmountInfo->approvedAmount / 100,
            'depositedAmount' => $response->paymentAmountInfo->depositedAmount / 100,
            'refundedAmount' => $response->paymentAmountInfo->refundedAmount  / 100,
            'shoppingcart' => $shoppingcart->id,
            'orderid' => $order->id
            ]);

      

    }    

}
