<?php

namespace App\Maker;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

class MakeLog extends AbstractMaker {
    public static function getCommandName(): string {
        return 'make:log';
    }
    public static function getCommandDescription(): string {
        return 'Create a logger';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig) {
        $command
            ->setName("make:log")
            ->setDescription($this->getCommandDescription())
            ->setHelp("This is a really helpful helper. I'm glad i can read this.")
            ->addArgument('name', InputArgument::OPTIONAL, 'Choose a name for your logger (e.g. <fg=yellow>logger</>)');
    }

    public function configureDependencies(DependencyBuilder $dependencies) { }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator) {
        $classDetails = $generator->createClassNameDetails(
            $input->getArgument('name'),
            'Log\\',
            'Log'
        );

        if(class_exists($classDetails->getFullName())) {
            throw new \RuntimeException('There is already a class with the same name');
        }

        $generator->generateClass(
            $classDetails->getFullName(),
            __DIR__.'/../Ressources/Logger.tpl.php',
            [
            ]
        );
        $generator->writeChanges();

        $this->writeSuccessMessage($io);
        $io->text([
            'Next: open your new logger class and start customizing it.',
            'Find the documentation at <fg=yellow>https://thereisnodocumentation/log.html</>'
        ]);
    }
}