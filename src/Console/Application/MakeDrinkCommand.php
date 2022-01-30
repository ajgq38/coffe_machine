<?php

namespace Adsmurai\CoffeeMachine\Console\Application;

use Adsmurai\CoffeeMachine\Console\Domain\Entity\Order;
use Adsmurai\CoffeeMachine\Console\Domain\Services\OrderRepository;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Drink;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Sugar;
use Adsmurai\CoffeeMachine\Console\Domain\ValueObject\Money;

use Exception;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';

    public function __construct(OrderRepository $orderRepository, ?string $name = null)
    {
        parent::__construct($name);

        $this->orderRepository = $orderRepository;
    }

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
        try {
            $money = new Money($input->getArgument('money'));
            $drink = new Drink(strtolower($input->getArgument('drink-type')));
            $sugar = new Sugar($input->getArgument('sugars'));
            $order = new Order($drink, $sugar, $input->getOption('extra-hot'), $money);

            $output->writeln($this->createMessageOutput($order));
            $this->orderRepository->saveOrderHistoric($order);

        } catch (Exception $e) {
            $output->writeln($e->getMessage());
        }

    }

    private function createMessageOutput(Order $order): string
    {
        $message = 'You have ordered a ' . $order->getDrink()->getType();
        if ($order->getExtraHot()) {
            $message .= ' extra hot';
        }
        if ($order->getStick()) {
            $message .= ' with ' . $order->getSugar()->getValue() . ' sugars (stick included)';
        }
        return $message;
    }


}
