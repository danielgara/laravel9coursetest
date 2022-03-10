<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getPrice()
    {
        return $this->attributes['price'];
    }

    public function setQuantity($q)
    {
        $this->attributes['quantity'] = $q;
    }

    public function getQuantity()
    {
        return $this->attributes['quantity'];
    }

    public function setPrice($p)
    {
        $this->attributes['price'] = $p;
    }


    public function setProductId($pId)
    {
        $this->attributes['product_id'] = $pId;
    }

    public function getOrderId()
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId($pId)
    {
        $this->attributes['order_id'] = $pId;
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

}
