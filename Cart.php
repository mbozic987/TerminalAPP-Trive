<?php

//Cart class with get and set methods

class Cart
{
    private $sku;
    private $quantity;
    private $name;
    private $price;

    public function getSku(){
		return $this->sku;
	}

	public function setSku($sku){
		$this->sku = $sku;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}
}