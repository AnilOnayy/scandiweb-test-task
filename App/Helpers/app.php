<?php 

function _link($param=null){
    return URL.$param;
}

function assets($name){
    return URL."public/".$name;
}


function isEmpty($param){
    $result = stripslashes(trim($param));
    return $result=="" || $result==null;
}

function price($price){
    return number_format($price,2,",",".");
}
?>

