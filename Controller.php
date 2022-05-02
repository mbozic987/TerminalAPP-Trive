<?php

//Controller class for input controlls

class Controller
{
    //Integer Controller

    public static function readInt(
        $message,
        $error = 'Input must be an integer greather then 0!!!')
    {
        $terminal = fopen('php://stdin', 'r');
        while (true) {
            echo $message . PHP_EOL;
            $userInput = (int)fgets($terminal);
            if ($userInput > 0){
                return $userInput;
            }
            echo $error . PHP_EOL;
        }
    }

    //String controller

    public static function readString(
        $message, 
        $error = 'Product name can not be empty.')
    {
        $terminal = fopen('php://stdin', 'r');
        while (true) {
            echo $message . PHP_EOL;
            $userInput = fgets($terminal);
            $userInput = preg_replace("/\r|\n/", "", $userInput);
            $userInput= str_replace(' ', '', $userInput);
            if (strlen($userInput) > 0){
                return $userInput;
            }
            echo $error . PHP_EOL;
        }
    }

    //Float controller

    public static function readFloat(
        $message,
        $error='Price must be a decimal number!!!')
    {
        $terminal = fopen('php://stdin','r');
        while(true){
            echo $message;
            $userInput = (float)fgets($terminal);
            $userInput = (float)number_format($userInput, 2, '.', ' ');
            if($userInput!=0){
                return $userInput;
            }
            echo $error . PHP_EOL;
        }
    }
}