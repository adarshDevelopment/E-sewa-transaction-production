<?php

namespace App\Services;

use RemoteMerge\Esewa\Client;
use RemoteMerge\Esewa\Config;

class EsewaService
{

    protected $esewa;

    public function __construct($config)
    {
        $this->esewa = new Client($config);
    }

    public function initialize($config)
    {
        // return $esewaClient = new Client($config);'
        $this->esewa = new Client($config);
    }


    public function process($productId, $amount, $taxAount, $serviceAmount = 0.0, $deliveryAmount = 0.0)
    {
        $this->esewa->process($productId, $amount, $taxAount, $serviceAmount, $deliveryAmount);
    }

    public function verify($refid, $prodId, $amount)
    {
        return $this->esewa->verify($refid, $prodId, $amount);
    }
}
