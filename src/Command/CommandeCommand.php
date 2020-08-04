<?php

namespace App\Command;

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
        if (($handle = fopen($arg1, "r")) !== FALSE) {
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                $num = count($data);
               // echo "<p> $num champs à la ligne $row: <br /></p>\n";
                $row++;
                
                for ($c=0; $c < $num; $c++) {
                    
                    echo $data[$c] ;

                    /*foreach($data as $ligne) {
                        foreach($ligne as $cle => $valeur){
                            
                        echo $cle.': '.$valeur;
                        echo $ligne . '<br />';
                         }
                     }*/
                 

                }
            }
                /*recupere les donnée
                $csv_str = file_get_contents($data);
                $lines = explode("n", $csv_str);*/     
            
        fclose($handle);   
        }

       
        $io->success('You have a new command! With '. $row.' rows');

        return 0;
    }

     
    
}