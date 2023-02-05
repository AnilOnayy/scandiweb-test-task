<?php

namespace App\Controllers;

use App\Model\ModelProduct;
use Core\BaseController;

abstract class AbstractProduct extends BaseController
{
    protected $sku;
    protected $name;
    protected $price;
    protected $type;

    function __construct($data)
    {
        $this->setSku($data["sku"]);
        $this->setName($data["name"]);
        $this->setPrice($data["price"]);
        $this->setType($data["productType"]);
    }


    public function getSku(){
        return $this->sku;
    }
    public function setSku($param){
        $this->sku = $param;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($param){
        $this->name = $param;
    }

    public function getPrice(){
        return $this->price;
    }
    public function setPrice($param){
        $this->price = $param;
    }

    public function getType(){
        return $this->type;
    }
    public function setType($param){
        $this->type = $param;
    }


    protected function setDefaults(){
        $data["sku"]= $this->getSku();
        $data["name"]= $this->getName();
        $data["price"]= $this->getPrice();
        $data["type"]= $this->getType();
        return $data;
    }

    public function isSkuDuplicated($sku){
        $ModelProduct = new ModelProduct();
        return $ModelProduct->isSkuDuplicated($sku);
    }
}