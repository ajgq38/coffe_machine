<?php

namespace Adsmurai\CoffeeMachine\Console\Application;

use Adsmurai\CoffeeMachine\Console\Application\Services\GetTotalsCash\GetTotalsCash;
use Exception;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ShowCashTotal extends Command
{
    protected static $defaultName = 'app:order-drink';

    protected function configure()
    {

       $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            $description = 'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try{

            $totals_cash = GetTotalsCash::totals();
            $msg = "Estadisticas de Recaudación de dinero. \nDrink Type    Cash \n";
            foreach($totals_cash as $total) {
                $msg .=$total->drink_type ."        ". $total->amount . "\n" ;
            }
            $output->writeln($msg);

        }catch (Exception $e){
            $output->writeln($e->getMessage());
        }

    }


}