<?php

namespace App\Application\Cli;


use App\Domain\Common\Transaction;
use App\Domain\User\Entity\Admin;
use App\Domain\User\Entity\Auth;
use App\Domain\User\Entity\Contact;
use App\Domain\User\Repository\UserRepository;
use App\Infrastructure\Helper\HashHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateInitialAdminCommand extends Command
{
    protected static $defaultName = 'cli:create-admin';

    private $transaction;
    private $userRepository;

    public function __construct(Transaction $transaction, UserRepository $userRepository, $name = null)
    {
        parent::__construct($name);
        $this->transaction = $transaction;
        $this->userRepository = $userRepository;
    }

    protected function configure()
    {
        $this->addArgument('login', InputArgument::REQUIRED)
            ->addArgument('passwordHash', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $adminToBeCreated = new Admin(
            new Auth($input->getArgument('login'), $input->getArgument('passwordHash')),
            new Contact('admin', 'admin@admin.ru', '89999999999')
        );

        $this->transaction->makeTransaction(function () use ($adminToBeCreated) {
            $this->userRepository->save($adminToBeCreated);
        });

        $output->writeln("Admin is successfully created!");
    }
}