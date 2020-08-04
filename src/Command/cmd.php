<?php

namespace App\Command;

use Doctrine\Common\Annotations\Reader;
//use League\Csv\Reader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputAwareInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Loader\ProtectedPhpFileLoader;


//TESTE
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
            ->setDescription('read and open a csv')
            ->addArgument('lien', InputArgument::REQUIRED, 'link');
    }
    

    protected function execute(InputInterface $input, OutputInterface $output){
        
        $row = 1;
        $lienCsv = $input->getArgument('lien');
        if (($handle = fopen($lienCsv, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                echo "<p> $num champs à la ligne $row: <br /></p>\n";
                $row++;
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }
            }
            fclose($handle);
        }
      
        
        /*$lienCsv = $input->getArgument('lien');
        $file = fopen("$lienCsv", "r");
        while (!feof($file)){  
        

            print_r(fgetcsv($file)); 
        }
        fclose($file);*/
        
    }

    /*function detect_delimiter($csv_string){

        $delimiters = array(';' => 0,',' => 0,"\t" => 0,"|" => 0);

        foreach ($delimiters as $delimiter => & $count) {
            $count = substr_count($csv_string,$delimiter);
        }
        return array_search(max($delimiters), $delimiters);
    }*/
}