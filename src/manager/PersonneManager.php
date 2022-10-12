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