<?php
namespace App\Command;

/**
 * Command to use:
 * dsf app:dbal:typesinfo
 */
class DbalGetTypesInfos extends \Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this
            ->setName('app:dbal:typesinfo')
            ->setDescription('Prints Doctrine loaded types')
            ->setHelp('This command prints the currently loaded types for Doctrine DBAL');
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output): int
    {
        $output->writeln(var_dump(\Doctrine\DBAL\Types\Type::getTypesMap()));

        return 1;
    }
}
