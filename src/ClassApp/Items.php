<?php
 
 namespace VendingMachine\ClassApp;
 use VendingMachine\Item\ItemInterface;
 use VendingMachine\Item\ItemCodeInterface;

class Items implements ItemInterface, ItemCodeInterface {
    
    public ItemCodeInterface $value;
    public ItemInterface $instand;
    public string $item      ='';
    private static $instance = null;
    public string $typeItems;

    private function __construct(){

    }

    public static function getInstance(): Items {
      if(self::$instance === null){
         self::$instance = new static(); 
      }

      return self::$instance;
    }

    public function addTypeItems($typeItems){
        $this->typeItems = $typeItems;
    }

    public function getPrice(): float{
      return 0.0;
    }

    public function getCount(): int{
        return 1;
    }
    public function getCode(): ItemCodeInterface{

             return $this->value;
    }

    public function stringoTo(ItemCodeInterface $value ){
         $this->value = $value;
    }

    public function add(ItemInterface $item): void{
        $this->item .= " ".$item->getCode()." ";
    }

    public function itemAll(): string{
        return $this->item;
    }

    /**
     * @throws ItemNotFoundException
     */
    public function get(ItemCodeInterface $itemCode): ItemInterface{
                echo $itemCode;
                return $this->instand;
    }

    public function instandTo(ItemInterface $instand ){
                $this->instand = $instand;
    }

    public function count(ItemCodeInterface $itemCode): int{
          return 1;
    }

    public function empty(): void{
        $this->item = "";
    }

    public function __toString(): string
    {
        return $this->typeItems;
    }
}