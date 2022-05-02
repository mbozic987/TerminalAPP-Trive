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
    Constructing product and cart array.
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

    private function addToCart()
    {
        
    }

    private function removeFromCart()
    {

    }

    private function checkout()
    {

    }

    private function title()
    {
        echo '----------------------' . PHP_EOL;
        echo 'My first terminal shop' . PHP_EOL;
        echo '----------------------' . PHP_EOL  . PHP_EOL;
        $this->inventoryMenu();
    }
}