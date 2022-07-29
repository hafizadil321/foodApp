<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderController extends BaseController
{
    public function index()
    {
        $orders = Order::all();
        return $this->sendResponse($orders, 'All Orders.');

    }
    public function create_order(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); exit('poikk');
        // $order = Order::with('products.category')->get();

        // return $this->sendResponse($order, 'User created successfully.');
        // echo "<pre>"; print_r($order); exit('poikk');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'billing_name' => 'required',
            'billing_email' => 'required',
            'billing_address' => 'required',
            'billing_phone' => 'required',
            'billing_total' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }

        $order = Order::create([
            'user_id' => $request->user_id,
            'billing_name' => $request->billing_name,
            'billing_email' => $request->billing_email,
            'billing_address' => $request->billing_address,
            'billing_phone' => $request->billing_phone,
            'billing_name_on_card' => 'nothing',
            'billing_discount' => 'nothing',
            'billing_discount_code' => 'nothing',
            'billing_subtotal' => $request->billing_total,
            'billing_tax' => 'nothing',
            'billing_total' => $request->billing_total,
            'payment_gateway' => 'nothing',
            'payment_status' => '0',
        ]);

        foreach ($request->cart as $key => $cart) {

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cart['product_id'],
                'quantity' => $cart['quantity'],
            ]);
        }
   
        return $this->sendResponse($order, 'User created successfully.');
    }
}
