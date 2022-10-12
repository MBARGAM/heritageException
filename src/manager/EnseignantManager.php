<?php 

     namespace Isl\Heritage\manager;
     use Isl\Heritage\classes\Enseignant;
     use PDO;
     use Faker\Factory ;
   

     class EnseignantManager extends PersonneManager{
           static $nbreEnseignants ;

           public function __construct($nbreEleves,$connexion){
               self::$nbreEnseignants = $nbreEleves ;
               parent::__construct($connexion);
           }

            public function getEnseignant(){
                return self::$nbreEnseignants;
            }
            public function setEleves($nbreEleves){
                if(is_numeric($nbreEleves)){
                  self::$nbreEnseignants = $nbreEleves;
                }
            }

            public function createEnseignant($nbreCoursDispenses){

                $faker = Factory::create();
                $tableauParent = parent::createPersonne(self::$nbreEnseignants);  // appel de la methode parent create personne     
                
                // boucle afin de creer un tableau d objet etudiants 
                 $tableauEnseignants=[];

                 /*boucle qui permet de creer un tableau de cours ,parcours un tableau du nbre d eleves 
                 a creer et de creation de l objet eleve */

                for($i = 0 ; $i< self::$nbreEnseignants ;$i++){
                    $data= [];
                    $data["coursDispenses"]= parent::createCours($nbreCoursDispenses); // creation des cours a travers la methode parent
                    $data["dateEntree"] = $faker->dateTime();
                    $data["anciennete"] =$faker->randomDigitNotNull();
                    $data["infoPerso"] = $tableauParent[$i];

                    $newEnseignant = new Enseignant($data);
                    $tableauEnseignants[]=$newEnseignant;
                  
                }
                  return   $tableauEnseignants;  // tableau d objets  

            }
        }
     



?>