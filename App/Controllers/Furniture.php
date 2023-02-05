<?php

namespace App\Controllers;

use App\Model\ModelProduct;

class Furniture extends AbstractProduct
{
    private $width;
    private $length;
    private $height;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->setWidth($data["width"]);
        $this->setHeight($data["height"]);
        $this->setLength($data["length"]);
    }


    protected function getHeight(){
        return $this->height;
    }
    protected function setHeight($param){
        $this->height = $param;
    }


    protected function getLength(){
        return $this->length;
    }
    protected function setLength($param){
        $this->length = $param;
    }


    protected function getWidth(){
        return $this->width;
    }
    protected function setWidth($param){
        $this->width = $param;
    }



    
    // Check Size
    public function isValidate($data){

        $length = $data["length"];
        $width  = $data["width"];
        $height = $data["height"];

        $isValidLength = is_numeric($length) && $length>=0 &&  !isEmpty($length);
        $isValidWidth = is_numeric($width) && $width>=0 && !isEmpty($width);
        $isValidHeight = is_numeric($height) && $height>=0 && !isEmpty($height);

        return $isValidHeight && $isValidWidth && $isValidLength;

    }
    
    public function save(){

        $data = $this->setDefaults();

        $data["width"]= $this->getWidth();
        $data["height"]= $this->getHeight();
        $data["length"]= $this->getLength();
    
        $modelProduct = new ModelProduct();
        return $modelProduct->insert($data);
    }
}