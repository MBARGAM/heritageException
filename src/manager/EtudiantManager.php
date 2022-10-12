<?php 

     namespace Isl\Heritage\manager;
     use Isl\Heritage\classes\Etudiant;
     use PDO;
     use Faker\Factory ;

     class EtudiantManager extends PersonneManager{
           private $nbreEleves ;

           public function __construct($nbreEleves){
               $this->nbreEleves = $nbreEleves ;
           }

            public function getEleves(){
                return $this->nbreEleves;
            }
            public function setEleves($nbreEleves){
                if(is_numeric($nbreEleves)){
                  $this->nbreEleves = $nbreEleves;
                }
            }

            public function createEtudiant($nbreEleves,$nbreCoursSuivis){

                $faker = Factory::create();
                $tableauParent = parent::createPersonne($nbreEleves);  // appel de la methode parent create personne     
                
                // boucle afin de creer un tableau d objet etudiants 
                 $tableauEtudiants=[];

                 /*boucle qui permet de creer un tableau de cours ,parcours un tableau du nbre d eleves 
                 a creer et de creation de l objet eleve */

                for($i = 0 ; $i< $nbreEleves ;$i++){
                    $data= [];
                    $data["coursSuivis"]= parent::createCours($nbreCoursSuivis); // creation des cours a travers la methode parent
                    $data["niveau"] = $faker->citySuffix();
                    $data["dateInscription"] =$faker->date();
                    $data["infoPerso"] = $tableauParent[$i];

                    $newEtudiant = new Etudiant($data);
                    $tableauEtudiants[]=$newEtudiant;
                  
                }
                  return   $tableauEtudiants ;  // tableau d objets  

            }
        }
     



?>