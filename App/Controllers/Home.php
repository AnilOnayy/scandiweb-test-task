<?php 

namespace App\Controllers;


use Core\BaseController;

class Home extends BaseController
{

    public function index(){
        $data["products"] = $this->db->getRows("SELECT * FROM products");
        echo $this->view->load("home/index",$data);
    }
}

?>