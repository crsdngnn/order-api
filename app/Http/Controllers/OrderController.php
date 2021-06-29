<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Repositories\Rest\RestRepository;
use Illuminate\Http\Request;
use App\Http\Service\Order\OrderService;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    /**
     * @var RestRepository
     */
    private $rest;
    private $product;
    private OrderService $service;

    public function __construct(Order $model, Product $product, OrderService $service) {
        $this->middleware('auth:api');
        $this->rest = new RestRepository($model);
        $this->service = $service;
        $this->product = $product;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        //
        $data = $request->all();
        $productDetails = $this->getProduct($data['product_id']);

        if($productDetails == null) {
            return $this->response("Product not found");
        }
        if($productDetails == null) {
            return $this->response("Product not found");
        }
        if($productDetails->available_stocks < intval($data['quantity'])) {
            return $this->response("Failed to order due to unavailability of stocks");
        }
        $this->service->saveOrder($data);
        return $this->response("You have successfully ordered this product");
    }

    private function getProduct($id) {
        return $this->product->whereId($id)->first();
    }
}
