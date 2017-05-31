<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 30/05/2017
 * Time: 15:30
 */

namespace main\AppBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LocatePlaceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('main:locate-place')
            ->addArgument('query', InputArgument::REQUIRED, 'What to search');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Looking for <comment>%s</comment>', $input->getArgument('query')));

        // get the place locator
        $placeLocator = $this->getContainer()->get('main.app.chained_locator');

        // fetch the results
        $results = $placeLocator->searchByKeyword($input->getArgument('query'));

        // show the results
        $output->writeln(sprintf('Found <info>%d</info> result(s)', count($results)));
        foreach ($results as $result) {
            $output->writeln(sprintf('<info>%s</info> by <comment>%s</comment>', $result['name'], $result['source']));
            $output->writeln(sprintf('  %s', $result['address']));
        }

        return 0;
    }
}