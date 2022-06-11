<?php

 namespace VendingMachine\ClassApp;
 use VendingMachine\Money\MoneyCollectionInterface;
 use VendingMachine\Money\MoneyInterface;
 use VendingMachine\Response\ResponseInterface;

class Cash implements MoneyInterface, ResponseInterface, MoneyCollectionInterface {

    const N      = 0.05;
    const D      = 0.1;
    const Q      = 0.25;
    const DOLLAR = 1.00;

    public float $money=0.0;
    public float $typeMoney=0.0;
    private static $instance = null;

    private function __construct(){

    }

    public static function getInstance(): Cash {
      if(self::$instance === null){
         self::$instance = new static(); 
      }

      return self::$instance;
    }

    private function __clone() { }

    public function addTypeMoney($typeMoney){
        switch($typeMoney){
            case "N":
                $this->typeMoney = self::N;
            break;
            case "D":
                $this->typeMoney = self::D;
            break;
            case "Q":
                $this->typeMoney = self::Q;
            break;
            case "DOLLAR":
                $this->typeMoney = self::DOLLAR;
            break;
        }
    }

    public function add(MoneyInterface $money): void {
        $this->money += $money->getValue();
       // $this->money += $this->typeMoney;
    }

    public function sum(): float {
        return $this->money;
    }

    public function merge(MoneyCollectionInterface $moneyCollection): void {

    }

    public function empty(): void{
        $this->money = 0.0;
    }

    public function getValue(): float{
      return $this->typeMoney;
    }

    public function getCode(): string{
        return 'gdfdfggdf';
      }

    /**
     * @return MoneyInterface[]
     */
    public function toArray(): array{
          return [];
    }

    public function __toString(): string
    {
        return 'dopisz stringa';
    }
}
