<?php

namespace Adsmurai\CoffeeMachine\Console\Application;

use Adsmurai\CoffeeMachine\Console\Domain\Services\OrderRepository;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Drink;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\EnumDrink;
use Exception;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowCashTotal extends Command
{
    protected static $defaultName = 'app:show-totals';
    public function __construct(OrderRepository $orderRepository, ?string $name = null, )
    {

        parent::__construct($name);

        $this->orderRepository =  $orderRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try{

            $totals_cash = $this->orderRepository->totals();
            $msg = $this->createMessageTotals($totals_cash);
            $output->write($msg);

        }catch (Exception $e){
            $output->writeln($e->getMessage());
        }

    }

    private function createMessageTotals(array $totals_cash): string
    {
        $msg = "Drink Type    Cash" . PHP_EOL;
        foreach ($totals_cash as $total) {
            $collection = 0;
            $msg .= $total->drink_type;
            switch ($total->drink_type) {
                case "tea":
                    $collection = $total->amount * EnumDrink::PRICE_TEA;
                    $msg .= "           " . $collection . PHP_EOL;
                    break;
                case "coffee":
                    $collection = $total->amount * EnumDrink::PRICE_COFFEE;
                    $msg .= "        " . $collection . PHP_EOL;
                    break;
                case "chocolate":
                    $collection = $total->amount * EnumDrink::PRICE_CHOCOLATE;
                    $msg .= "     " . $collection . PHP_EOL;
                    break;
            }
        }
        return  $msg;
    }


}