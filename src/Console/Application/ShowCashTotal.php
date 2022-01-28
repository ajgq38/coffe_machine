<?php

namespace Adsmurai\CoffeeMachine\Console\Application;

use Adsmurai\CoffeeMachine\Console\Application\Services\GetTotalsCash\GetTotalsCash;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Drink;
use Exception;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ShowCashTotal extends Command
{
    protected static $defaultName = 'app:show-totals';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try{

            $totals_cash = GetTotalsCash::totals();
            $msg = "Drink Type    Cash" . PHP_EOL;
            foreach($totals_cash as $total) {
                $collection = 0;
                $msg .=$total->drink_type;
                switch($total->drink_type){
                    case "tea":
                       $collection =  $total->amount * Drink::PRICE_TEA;
                       $msg .= "           ". $collection . PHP_EOL;
                    break;
                    case "coffee":
                        $collection =  $total->amount * Drink::PRICE_COFFE;
                        $msg .= "        ". $collection . PHP_EOL;
                        break;
                    case "chocolate":
                        $collection =  $total->amount * Drink::PRICE_CHOCOLATE;
                        $msg .= "     ". $collection  . PHP_EOL;
                        break;
                }
            }
            $output->write($msg);

        }catch (Exception $e){
            $output->writeln($e->getMessage());
        }

    }


}