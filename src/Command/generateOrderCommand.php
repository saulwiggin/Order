<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\EntityManagerInterface;
/**
 * Class generateOrderCommand
 *
 * @package App\Command
 */
class generateOrderCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:generate-order';

    public function __construct(bool $requireOrderAmount = true)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->requireOrderAmount = $requireOrderAmount;

        parent::__construct();
    }

    protected function configure()
    {
        $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Generates an order.')
        
        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command interfaces with erlang to generate an order...')
        ->addArgument('order_total', InputArgument::REQUIRED, 'What is the Order total?');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ... put here the code to run in your command
        $amount = $input->getArgument('order_total');

        if($amount > 100){
            $output->writeln('send voucher');
        } else {
            $output->writeln('no voucher');
        }
        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}
