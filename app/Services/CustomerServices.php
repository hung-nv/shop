<?php

namespace App\Services;


use App\Models\Customer;

class CustomerServices
{
    public function getAllCustomer()
    {
        return Customer::all();
    }
}