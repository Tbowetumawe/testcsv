<?php

namespace App\Command;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputAwareInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DependencyInjection\Loader\ProtectedPhpFileLoader;

class CsvCommande extends Command{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }
    

   
    //protected static $defaultName='testDnd:affiche';

    protected function configure()
    {
        $this
            ->setName('csv:affiche')
            ->setDescription('afficher la grille')
            ->addArgument('lien', InputArgument::REQUIRED, 'link');
    }
    

    protected function execute(InputInterface $input, OutputInterface $output){
        
        $lienCsv = $input->getArgument('lien');
        $file = fopen("$lienCsv", "r");
        while (!feof($file)){  
            print_r(fgetcsv($file)); 
        }
        
        fclose($file);
        //return Command::SUCCESS;
    }

}