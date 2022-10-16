<?php
   
   namespace Isl\Heritage\manager;
   use Faker\Factory;

   class PersonneManager{
       protected $connexion = null;

       protected  function __construct($connexion){
           $this->connexion = $connexion ;
       }

       protected  function setConnexion($connexion){
           $this->connexion = $connexion;
       }

       protected  function getConnexion(){
        return $this->connexion ;
       }

/* creation des personne par la librairie faker pour les 2 sois classes etudiant et enseignant  */

       protected  function createPersonne($nbre){

        $faker = Factory::create();
            $tablePersonne=[];
            for($i = 0 ; $i< $nbre ;$i++){
                
                $data= [];
                $data["nom"] = $faker->lastname();
                $data["prenom"] =$faker->firstname();
                $data["adresse"] =$faker->address();
                $data["cp"] =$faker->postcode();
                $data["pays"]=$faker->country();
                $data["societe"] =$faker->Company();
                $tablePersonne[]=$data;
            }

         return $tablePersonne ;

        }

        //creations des cours , dispensés ou suivis par les eleves

        protected  function createCours($nbre){

            $faker = Factory::create();
            $data= [];
                for($i = 0 ; $i< $nbre ;$i++){
                    $data[] = $faker->jobTitle();
                }
    
             return $data ;
    
            }
    


    }

?>