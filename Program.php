<?php

/*
Program Class
Simple in-memory, single user command line store / shopping cart.
The application has two stages:
Inventory store, to store items and their associated sku, quantity, name, and price.
Shopping Cart (Removes items from inventory to build personal cart of items)
*/

class Program
{
    private $inventory;
    private $cart;

    /*
    Constructing inventory and cart array.
    Starting inventory menu
    */

    public function __construct()
    {
        $this->inventory = [];
        $this->cart = [];
        $this->title();
    }

    /*
    First part of application.
    Adding products to inventory.
    */

    private function inventoryMenu()
    {
        echo '1. ADD - Add new product to inventory' . PHP_EOL;
        echo '2. END - Close inventory and move to shoping cart' . PHP_EOL;
        $choice = 0;
        while(true){
            $choice = Controller::readInt('Choose menu number: ','Your choice must be an integer!!!');
            if($choice < 1 || $choice > 2){
                echo 'You must choose one of available options' . PHP_EOL;
                continue;
            }
            break;
        }
        switch($choice){
            case 1:
                $this->addProduct();
                break;
            case 2:
                $this->shopingCartMenu();
                break;
        }
    }

    private function addProduct()
    {
        //Creating product using user information
        $p = new Product();
        $p->setSku(Controller::readInt('Input SKU number: '));
        $p->setName(Controller::readString('Input product name: '));
        $p->setQuantity(Controller::readInt('Input quantity: '));
        $p->setPrice(Controller::readFloat('Input price: '));
        
        $this->inventory[] = $p;
        echo PHP_EOL . 'Product added to inventory!!!' . PHP_EOL;
        echo '-----------------------------' . PHP_EOL . PHP_EOL;

        $this->inventoryMenu();
    }

    /*
    Second part of application.
    Adding and removing existing products from shoping cart.
    */

    private function shopingCartMenu()
    {
        echo PHP_EOL . '----------------------' . PHP_EOL . PHP_EOL;
        echo '1. ADD - Add new product to shoping cart' . PHP_EOL;
        echo '2. REMOVE  - Remove product from shoping cart' . PHP_EOL;
        echo '3. CHECKOUT - Print products and total price in shoping cart' . PHP_EOL;
        echo '4. END - Close program' . PHP_EOL;
        $choice = 0;
        while(true){
            $choice = Controller::readInt('Choose menu number: ','Your choice must be an integer!!!');
            if($choice < 1 || $choice > 4){
                echo 'You must choose one of available options' . PHP_EOL;
                continue;
            }
            break;
        }
        switch($choice){
            case 1:
                $this->addToCart();
                break;
            case 2:
                $this->removeFromCart();
                break;
            case 3:
                $this->checkout();
                break;
            case 4:
                echo PHP_EOL . 'Thank you for using my store, goodbye!!!' . PHP_EOL;
        }
    }

    //Adding products to shoping cart if product exists in inventory

    private function addToCart()
    {
        $cartItem = new Item();

        for($i=0;$i<count($this->inventory);$i++){
            echo $this->inventory[$i]->getSku() . '. ' . $this->inventory[$i]->getName() 
            . ' ' . $this->inventory[$i]->getQuantity() 
            . ' pcs ' . $this->inventory[$i]->getPrice() 
            . '$' . PHP_EOL;
        }

        while (true) {
            $input = (Controller::readInt('Enter SKU number of product you want to add to cart: '));
            foreach ($this->inventory as $p) {
                if ($input == $p->getSku()) {
                    $cartItem->setSku($input);
                }
            }
            if (null !== ($cartItem->getSku())) {
                break;
            }
            echo 'SKU number does not exist!' . PHP_EOL;
            continue;
        }

        while (true) {
            $input = (Controller::readInt('Enter quantity: ', 'Quantity must be greater than 0.'));
            foreach ($this->inventory as $p) {
                if ($cartItem->getSku() == $p->getSku()) {
                    if ($input <= $p->getQuantity()) {
                        $cartItem->setQuantity($input);
                        $cartItem->setName($p->getName());
                        $cartItem->setPrice($p->getPrice());
                        $this->cart[] = $cartItem;
                        $p->setQuantity($p->getQuantity()-$input);
                        echo PHP_EOL . 'Product added to cart!' . PHP_EOL;
                    } else {
                        echo 'There is ' . $p->getQuantity() . ' ' . $p->getName() . ' in inventory.' . PHP_EOL;
                    }
                }
            }
            if (null !== ($cartItem->getQuantity())) {
                break;
            }
            continue;
        }

        $this->shopingCartMenu();
    }
    
    //Remove from cart

    private function removeFromCart()
    {
        for($i=0;$i<count($this->cart);$i++){
            echo $this->cart[$i]->getSku() . '. ' . $this->cart[$i]->getName() 
            . ' ' . $this->cart[$i]->getQuantity() 
            . ' pcs X ' . $this->cart[$i]->getQuantity()
            . '$' . PHP_EOL;
        }
        $delete = Controller::readInt('Enter SKU number of product you want to remove from cart: ');
        
        array_splice($this->cart,$delete-1,1);

        echo '--------------------------------------' . PHP_EOL;
        echo 'Product successfully removed from cart' . PHP_EOL;
        $this->shopingCartMenu();
    }
    //Displaying items and prices from cart
    private function checkout()
    {
        $total = 0;

        echo 'Checkout' . PHP_EOL;  
        foreach($this->cart as $c){
            $price = $c->getPrice() * $c->getQuantity();
            $total += $price;
            echo $c->getName() . ' ' . $c->getQuantity() . ' x ' . $c->getPrice() . ' = ' . $price . PHP_EOL;
            echo 'TOTAL = ' . $total . PHP_EOL;
            $this->cart = [];
            $this->shopingCartMenu();
        }
    }

    private function title()
    {
        echo '----------------------' . PHP_EOL;
        echo 'My first terminal shop' . PHP_EOL;
        echo '----------------------' . PHP_EOL  . PHP_EOL;
        $this->inventoryMenu();
    }
}