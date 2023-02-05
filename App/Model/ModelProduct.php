<?php 

namespace App\Model;

use Core\BaseModel;


class ModelProduct extends BaseModel
{
    public function isSkuDuplicated($sku){
        $search = $this->db->getRow("SELECT * FROM products WHERE sku=?",[$sku]);
        return (bool)$search;
    }

    public function insert(Array $data){
        return $this->db->insert("INSERT INTO products SET
            sku=?,
            `name`=?,
            price=?,
            `type`=?,
            size=?,
            height=?,
            width=?,
            `length`=?,
            `weight`=?
        ",[
            $data["sku"],
            $data["name"],
            $data["price"],
            $data["type"],
            $data["size"],
            $data["height"],
            $data["width"],
            $data["length"],
            $data["weight"]
        ]);
    }

    public function deleteProducts(Array $ids){
        $isSuccess = true;
        foreach($ids as $id){
            $result = $this->db->delete("DELETE FROM products WHERE id=?",[$id]);

            if(!$result){
                $isSuccess = false;
            }
        }
        return $isSuccess;
    }
}
