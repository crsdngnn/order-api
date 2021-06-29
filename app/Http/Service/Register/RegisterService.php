<?php

namespace App\Http\Service\Register;

use App\User;
use App\Repositories\Rest\RestRepository;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**
     * @var RestRepository
     */
    private $rest;

    public function __construct(User $model) {
        $this->rest = new RestRepository($model);
    }

    public function register($data) {
        User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

}
