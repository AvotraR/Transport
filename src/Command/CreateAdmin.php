<?php
namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

Class CreateAdmin extends Command{

    protected EntityManagerInterface $manager;
    protected UserPasswordHasherInterface $encoder;

    protected static $defaultName = 'transport:create:admin';

    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $encoder){
        $this->manager = $manager;
        $this->encoder = $encoder;
        parent::__construct();
    } 

    public function configure(){
        $this->setDescription("Creation d'une utilisateur Administrateur");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');

        $nom = $helper->ask($input, $output, new Question('Nom:'));
        $prenom = $helper->ask($input, $output, new Question('Prenom:'));
        $numero = $helper->ask($input, $output, new Question('Numero:'));
        $email = $helper->ask($input, $output, new Question('Email:'));
        $password = $helper->ask($input, $output, new Question('Password:'));

        $user = new User();
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setNumero($numero);
        $user->setEmail($email);
        $user->setPassword($this->encoder->hashPassword($user, $password));

        $this->manager->persist($user);
        $this->manager->flush();

        $style->success("Creation de l'admin ". $nom);

        return 1;
    }
}