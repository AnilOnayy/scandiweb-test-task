<?php

namespace App\Controllers;

use App\Model\ModelProduct;
use App\Controllers;

class Book extends AbstractProduct
{
    private $weight;

    function __construct($data)
    {   
        parent::__construct($data);
        $this->setWeight($data["weight"]);
    }

    protected function getWeight(){
        return $this->weight;
    }
    protected function setWeight($param){
        $this->weight = $param;
    }

    // Check Weight
    public function isValidate($data){
        $weight = $data["weight"];
        return is_numeric($weight) && $weight>=0 && $weight!="";
    }

    public function save(){
        $data = $this->setDefaults();
        $data["weight"]= $this->getWeight();

        $modelProduct = new ModelProduct();
        return $modelProduct->insert($data);
    }
}