<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderProductTest extends TestCase
{
    // use RefreshDatabase;

    public function test_unsuccessful_order_due_to_insufficient_stocks() {

        $order_quantity = 9999; //// quantity order
        $product = Product::find(1);

        //false if the available stocks of product 1 is less than the quantity order
        $expected = $product->available_stocks < $order_quantity;

        $this->assertEquals(true, $expected);

    }

    public function test_successful_order() {
        // you can use auth()->user()->id
        $order = new Order;
        $order->user_id = 1;
        $order->product_id = 1;
        $order->quantity = 1;
        $order->save();

        //check if successfully save in orders table
        $this->assertDatabaseHas('orders', [
            'id' => $order->id
        ]);


    }
}
