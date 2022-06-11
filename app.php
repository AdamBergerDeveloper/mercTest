<?php
declare(strict_types=1);

include_once '.\vendor\autoload.php';

use VendingMachine\ClassApp\Product;
use VendingMachine\ClassApp\Items;
use VendingMachine\ClassApp\Cash;
use VendingMachine\Item\ItemInterface;
use VendingMachine\Item\ItemCodeInterface;
use VendingMachine\Money\MoneyInterface;
use VendingMachine\Response\ResponseInterface;
use VendingMachine\Exception\ItemNotFoundException;

 
try{
    echo "Podaj Produkt? GET-A, GET-B, GET-C: ";
    $tabLineProduct = ["A"=>true, "B"=>true, "C"=>true];
    do{
        $line = trim(handleLine());
        // Wyjscie
        exitMachine($line);  
        // Wszystkie symbole oprócz tablicy
        if(@is_null($tabLineProduct[$line])){
            $tabLineProduct[$line] = false;
        }

        if($tabLineProduct[$line] === true){
    
            $product = new Product($line);
        
            stringoTo("Koszt produktu to: ", $product);
            textCash(); 
    
        }else{
            echo "Brak takiego symbolu Produktu ABORTING!\n";
            echo "Podaj prawidłowy symnbol A, B, C !\n";
            echo "Podaj Produkt? GET-A, GET-B, GET-C: ";
        }
    
    }while( $tabLineProduct[$line] !== true );
    
    $cash  = Cash::getInstance();
    $items = Items::getInstance();
    $tabLineMoney = ["N"=>true, "D"=>true,"Q"=>true,"DOLLAR"=>true,"RM"=>false];

    do{
         echo "Input: ";
        $line = trim(handleLine());
        // Wyjscie
        exitMachine($line);
        // Wszystkie symbole oprócz tablicy
        if(@is_null($tabLineMoney[$line])){
            $tabLineMoney[$line] = -1;
        }
    // RETURN-MONEY RM usun monety
        if($tabLineMoney[$line] === false){
            $cash->empty();
            $items->empty();
            echo "Monety wyczyszczono \n";
            echo "Podaj prawidłowo gotówkę albo usuń monety\n";
        }else{

            if($tabLineMoney[$line] === true){
    
                $cash->addTypeMoney($line);
                $items->addTypeItems($line);
         
                    addToCash($cash, $cash);
                        echo $cash->sum()." $ ";
                    addToItems($items, $items, $items);
                        echo $items->itemAll()." \n";
                    if($product->typeProduct > $cash->sum()){
                        echo "za mało \n\n";
                    }              
            }else{
                echo "Brak takiego symbolu gotówki ABORTING!\n";
                textCash();
            }
        }
    }while($product->typeProduct > $cash->sum());
    
     $c = (int)($cash->sum()*1000);
     $p = (int)($product->typeProduct*1000);
    
    echo 'Produkt Kupiony '.$product->typeProduct." $ i zwrot na konto to: ".(($c - $p)/1000)." $";
    echo "\n";
    echo "Thank you...\n\n\n\n\n";

}catch(ItemNotFoundException $e){
    echo $e->getMessage();
}

function addToItems(Items $items, ItemInterface $item, ItemCodeInterface $value):void{
    $items->stringoTo( $value );
    $items->add($item);
}

function addToCash(Cash $cash, MoneyInterface $money):void{
            $cash->add($money);
}

function stringoTo($text, ResponseInterface $value ){
         print $text.$value." $";
}

function handleLine(){
    $handle = fopen ("php://stdin","r");
    $line   = fgets($handle);
    return $line;
}

function exitMachine($line):void {
    if($line == 'E' || $line == 'e'){
        echo "Koniec -- ABORTING!\n\n\n\n\n";
        exit;
    }
}

function textCash(){
echo "
Podaj prawidłowo gotówkę albo usuń monety: 
      0,05 $ --> N,
      0,1  $ --> D,
      0,25 $ --> Q,
      1,00 $ --> DOLLAR
      RETURN-MONEY --> RM usuwamy zebrane monety
Gotówka Czekam ;) : \n\n";
}
