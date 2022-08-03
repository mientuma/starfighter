<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:rewrite-database',
    description: 'Rewrites database',
)]
class RewriteDatabaseCommand extends Command
{
    /**
     * @throws \Exception
     * @throws \Symfony\Component\Console\Exception\ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $app = $this->getApplication();

        // Drops old DB
        $dropDatabase = $app->find('doctrine:database:drop');
        $argumentsDropDatabase = [
            '--force'  => true,
        ];
        $dropDatabaseInput = new ArrayInput($argumentsDropDatabase);


        // Creates new DB
        $createDatabase = $app->find('doctrine:database:create');
        $createDatabaseInput = new ArrayInput([]);


        // Makes migration
        $makeMigration = $app->find('doctrine:migrations:generate');
        $makeMigrationInput = new ArrayInput([]);


        // Migrates migration
        $migrationMigrate = $app->find('doctrine:migrations:migrate');
        $argumentsMigrationMigrate = [
            '--dry-run'  => true,
        ];
        $migrationMigrateInput = new ArrayInput($argumentsMigrationMigrate);

        // Updates tables schema
        $schemaUpdate = $app->find('doctrine:schema:update');
        $argumentsSchemaUpdate = [
            '--force'  => true,
        ];
        $schemaUpdateInput = new ArrayInput($argumentsSchemaUpdate);

        // Loads DataFixtures
        $dataFixtures = $app->find('doctrine:fixtures:load');
        $argumentsDataFixtures = [
            '--append'  => true,
        ];
        $dataFixturesInput = new ArrayInput($argumentsDataFixtures);

        // Runs all scripts
        $dropDatabase->run($dropDatabaseInput, $output);
        $createDatabase->run($createDatabaseInput, $output);
        $makeMigration->run($makeMigrationInput, $output);
        $migrationMigrate->run($migrationMigrateInput, $output);
        $schemaUpdate->run($schemaUpdateInput, $output);
        $dataFixtures->run($dataFixturesInput, $output);
    }
}
