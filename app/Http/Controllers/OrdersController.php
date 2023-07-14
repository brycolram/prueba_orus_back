<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Fruit;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fruits = Order::with("fruits")->get();
        return $this->sendResponse($fruits);
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
    public function store(OrderRequest $request)
    {
        $orderDiscount = 0;
        $ordertotal = 0;
        $order = Order::create(["total" => $ordertotal, "discount" => $orderDiscount]);

        foreach ($request["fruits"] as $index => $fruitRequest) {
            $fruit = Fruit::find($fruitRequest["id"]);
            if (!isset($fruit) || $fruit->quantity <= 0 || $fruit->quantity - $fruitRequest["quantity"] < 0) {
                $order->delete();
                throw new HttpResponseException(response()->json([

                    'success' => false,
                    'message' => 'Fruit out of stock',
                    'data' => ["fruit {$index} is out of stock"]

                ]));
            }
            $fruitPrice = $fruitRequest["quantity"] * $fruit->price;
            $discount = $fruitRequest["quantity"] > 10 ? $fruitPrice * 0.05 : 0;
            $fruitPriceTotal = $fruitPrice - $discount;

            $order->fruits()->attach($fruit->id, ["quantity" => $fruitRequest["quantity"],"price" => $fruitPriceTotal,"discount" => $discount,]);
            $ordertotal = $ordertotal + $fruitPriceTotal;
            $fruit->quantity = $fruit->quantity - $fruitRequest["quantity"];
            $fruit->save();
        }
        $orderDiscount = count($request["fruits"]) > 5 ? $ordertotal * 0.1 : 0;
        $order->total = $ordertotal - $orderDiscount;
        $order->discount = $orderDiscount;
        $order->save();
        return $this->sendResponse($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

}
