<?php

namespace App\Command;

use phpDocumentor\Reflection\Types\False_;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CommandeCommand extends Command
{
    protected static $defaultName = 'commande';

    

    protected function configure()
    {
        $this
            ->setDescription('read and open a csv')
            ->addArgument('lien', InputArgument::REQUIRED, 'link')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }



    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        //on récupèr le lien passer en paramètre
        $arg1 = $input->getArgument('lien');
        $row = 1;

        //on ouvre l'url passer en paramètre
        $read = fopen($arg1, "r");
        if ($read !== FALSE) {
            $csvtmp = array();
            $csvFinal = array();

            $csvfile = file_get_contents($arg1);
            //array
            $ligne = str_getcsv($csvfile,"\n"); 

            foreach ($ligne as $key => $item)
                
                {
                array_push($csvtmp, str_getcsv($item, ";")); 
                $csvFinal[$csvtmp[$key][0]] = $csvtmp[$key]; 
                
                array_slice($csvFinal[$csvtmp[$key][0]],2 );

                
                $result = json_decode($csvfile,false);

                
                
                }        

            print_r($csvtmp);
            //echo $result;
            
        }
    
        fclose($read); 

        $io->success('You have a new command! With '. $row.' rows');
    

     return 0;
    }
}