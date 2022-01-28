<?php

namespace Adsmurai\CoffeeMachine\Tests\Integration\Console;

use Adsmurai\CoffeeMachine\Tests\Integration\IntegrationTestCase;
use Adsmurai\CoffeeMachine\Console\Application\ShowCashTotal;
use Symfony\Component\Console\Tester\CommandTester;


class ShowCashTotalTest extends IntegrationTestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->application->add(new ShowCashTotal());
    }

    /**
     * @dataProvider totalsProvider
     */
    public function testCoffeeMachineShowTotalsCash( string $expectedOutput): void {

        $command = $this->application->find('app:show-totals');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName()
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertSame($expectedOutput, $output);

    }
    public function totalsProvider(): array
    {
        return [
            ['Drink Type    Cash
chocolate     0.6
coffee        1
tea           0.4
']
        ];

    }


}