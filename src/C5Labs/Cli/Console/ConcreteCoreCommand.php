<?php

/*
 * This file is part of Cli.
 *
 * (c) Oliver Green <oliver@c5labs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace C5Labs\Cli\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface as In;
use Symfony\Component\Console\Output\OutputInterface as Out;

abstract class ConcreteCoreCommand extends Command
{
    protected function execute(In $input, Out $output)
    {
        // Show the application banners.
        $output->write($this->getApplication()->getHelp()."\r\n");

        // List concrete5 installation location & version
        if ($concrete_path = $this->getApplication()->getConcretePath()) {
            $config = $this->getApplication()->getConcreteConfig();

            $output->writeln(
                sprintf(
                    "\r\nUsing concrete5 [<fg=green>%s</>] core files at: <fg=green>%s</>\r\n",
                    isset($config['version']) ? $config['version'] : 'Unknown Version',
                    $concrete_path
                )
            );
        }

        if (! file_exists($concrete_path)) {
            throw new \Exception('An instance of the concrete5 core could not be found.');
        }
    }
}