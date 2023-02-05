<?php 

namespace Core;

class View
{

 

    public function load($viewName,$data=[]){
        ob_start();
        extract($data);
        require BASEDIR."App/View/".$viewName.".php";
        $content =  ob_get_contents();
        ob_clean();
        return $content;
    }
 
}

?>