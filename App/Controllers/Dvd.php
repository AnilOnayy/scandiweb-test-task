<?php

namespace App\Controllers;

use App\Model\ModelProduct;

class Dvd extends AbstractProduct
{
    private $size;

    function __construct($data)
    {   
        parent::__construct($data);
        $this->setSize($data["size"]);
    }

    protected function getSize(){
        return $this->size;
    }
    protected function setSize($param){
        $this->size = $param;
    }


    // Check Size
    public function isValidate($data){
        $size = $data["size"];
        return is_numeric($size) && $size>=0 && $size!="" && !isEmpty($size);
    }
    
    public function save(){
        $data = $this->setDefaults();
        $data["size"]= $this->getSize();
    
        $modelProduct = new ModelProduct();
        return $modelProduct->insert($data);
    }


}