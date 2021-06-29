<?php

namespace App\Http\Service\Order;

use App\Order;
use App\Product;
use App\Repositories\Rest\RestRepository;

class OrderService
{
    /**
     * @var RestRepository
     */
    private $rest;
    private $product;

    public function __construct(Order $model, Product $product) {
        $this->rest = new RestRepository($model);
        $this->product = $product;
    }

    public function saveOrder($data) {
        $data['user_id'] = auth()->user()->id;
        $this->updateProductQuantity($data);
        return $this->rest->create($data);
    }

    private function updateProductQuantity($data) : void {
        $product = $this->product->find($data['product_id']);
        $deductStock = $product->available_stocks - $data['quantity'];
        $product->update(['available_stocks' => $deductStock]);
    }

}
