<?php

 namespace VendingMachine\ClassApp;

 use VendingMachine\Response\ResponseInterface;

class Product implements ResponseInterface {

    const A = 0.65;
    const B = 1;
    const C = 1.5;

    public $typeProduct;

    function __construct($typeProduct){
       
        switch($typeProduct){
            case "A":
                $this->typeProduct = self::A;
            break;
            case "B":
                $this->typeProduct = self::B;
            break;
            case "C":
                $this->typeProduct = self::C;
            break;
        }
    }

    public function __toString(): string
    {
        return $this->typeProduct;
    }
}