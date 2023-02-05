<?php

namespace App\Controllers;

use App\Model\ModelProduct;
use Core\BaseController;


class Product extends BaseController
{

    private $types  = ["Dvd","Book","Furniture"];

    // Product Add Page
    public function index(){
        echo $this->view->load("product/index");
    }


    public function addProduct(){

        $post = $this->request->post();
        $sku = $post["sku"];
        $name = $post["name"];
        $price = $post["price"];
        $type = $post["productType"];

        // If there is not empty input
        if((isEmpty($sku) || isEmpty($name) || isEmpty($price) || isEmpty($type))){
            $ok = false;
            $status = 'error';
            $title  = 'Ops! Warning';
            $msg    = 'Please fill all requirement fields.';
            echo json_encode(['ok'=>$ok,'status' => $status , 'title' => $title , 'msg' => $msg ],JSON_UNESCAPED_UNICODE);
            exit();
        }



        // Select Product Type       
        $class = "App\\Controllers\\".$type;

        // If class exists send POST datas to product class
        if(class_exists($class)){
            $product = new $class($post);
        }else{
            $ok = false;
            $status = 'error';
            $title  = 'Ops! Warning';
            $msg    = 'Please choose a product type.';
            echo json_encode(['ok'=>$ok,'status' => $status , 'title' => $title , 'msg' => $msg ],JSON_UNESCAPED_UNICODE);
            exit();
        }


        
        if(!($this->validateType($product->getType()))){ // If post type is not valid
            $ok = false;
            $status = 'error';
            $title  = 'Ops! Warning';
            $msg    = 'Please choose valid product type.';
            echo json_encode(['ok'=>$ok,'status' => $status , 'title' => $title , 'msg' => $msg ],JSON_UNESCAPED_UNICODE);
            exit();
        }else if(!$product->isValidate($post)){ // Product's  attributes is valid?
            $ok = false;
            $status = 'error';
            $title  = 'Ops! Warning';
            $msg    = 'Please enter valid values the product attributes.';
            echo json_encode(['ok'=>$ok,'status' => $status , 'title' => $title , 'msg' => $msg ],JSON_UNESCAPED_UNICODE);
            exit();
        }
        else if($product->isSkuDuplicated($product->getSku())){ // Product's SKU is Duplicating ?
            $ok = false;
            $status = 'error';
            $title  = 'Ops! Warning';
            $msg    = 'The entered sku value already exists, please enter a different value.';
            echo json_encode(['ok'=>$ok,'status' => $status , 'title' => $title , 'msg' => $msg ],JSON_UNESCAPED_UNICODE);
            exit();
        }
        else if(!$product->save()){ // Is product not saved?
            $ok = false;
            $status = 'error';
            $title  = 'Ops! Warning';
            $msg    = 'An error occured while adding product. Please reload this page and try again.';
            echo json_encode(['ok'=>$ok,'status' => $status , 'title' => $title , 'msg' => $msg ],JSON_UNESCAPED_UNICODE);
            exit();
        }
        else{ // Turn back the success
            echo json_encode(['ok'=>true],JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    public function deleteProduct(){
        
        $post = $this->request->post();

        $ids = explode(",",$post["ids"]);

        $ModelProduct = new ModelProduct();
        $result = $ModelProduct->deleteProducts($ids);

        if($result){
            echo json_encode(['ok'=>true],JSON_UNESCAPED_UNICODE);
            exit();
        }
        else{
            $ok = false;
            $status = 'error';
            $title  = 'Ops! Warning';
            $msg    = 'An error occured.';
            echo json_encode(['ok'=>$ok,'status' => $status , 'title' => $title , 'msg' => $msg ],JSON_UNESCAPED_UNICODE);
            exit();
        }

    }

    private function validateType($type){
        return in_array($type,$this->types);
    }
}