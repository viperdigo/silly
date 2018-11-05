<?php

namespace ProjectSilly\UserBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FOS\UserBundle\Command\CreateUserCommand as BaseCommand;

/**
 * Class CreateUserCommand
 * @package ProjectSilly\BackendBundle\Command
 */
class CreateUserCommand extends BaseCommand
{

    protected function configure()
    {
        parent::configure();
        $this
            ->setName('user:create')
            ->getDefinition()->addArguments(array(
                new InputArgument('name', InputArgument::REQUIRED, 'The name'),
            ))
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $name = $input->getArgument('name');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $inactive = $input->getOption('inactive');
        $superadmin = $input->getOption('super-admin');
        
        /** @var \FOS\UserBundle\Model\UserManager $user_manager */
        $user_manager = $this->getContainer()->get('fos_user.user_manager');

        /** @var \ProjectSilly\UserBundle\Entity\User $user */
        $user = $user_manager->createUser();
        $user->setUsername($username);
        $user->setName($name);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled((Boolean) !$inactive);
        $user->setSuperAdmin((Boolean) $superadmin);

        $user_manager->updateUser($user);

        $output->writeln(sprintf('Created user <comment>%s</comment>', $username));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        parent::interact($input, $output);
        if (!$input->getArgument('name')) {
            $name = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a name:',
                function($name) {
                    if (empty($name)) {
                        throw new \Exception('name can not be empty');
                    }

                    return $name;
                }
            );
            $input->setArgument('name', $name);
        }
    }
}
