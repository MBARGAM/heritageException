<?php
   
   namespace Isl\Heritage\manager;
   use Faker\Factory;
   use PDO;

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

            protected function readOne($id){
                
                $req =  $this->connexion 
                ->query("SELECT id,nom,prenom,adresse,cp,pays,societe,statut,niveau,date_entree,anciennete,nomCours,date_creation
                 FROM elevesEnseignant 
                 LEFT JOIN cours ON cours.idPersonne = elevesEnseignant
                 WHERE id=".$id.";" );
        
                // execution de la requete avec un fetchall qui prend toute les donnees ,fetch ne prends que la 1 ere
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
        
                return $result;
            }
            
           public function readAll(){
          
                $req =  $this->connexion 
                ->query("SELECT id,nom,prenom,adresse,cp,pays,societe,statut,niveau,date_entree,anciennete,nomCours,date_creation
                 FROM elevesEnseignant 
                 LEFT JOIN cours ON cours.idPersonne = elevesEnseignant
                 ;" );
        
        
                // execution de la requete avec un fetchall qui prend toute les donnees ,fetch ne prends que la 1 ere
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
        
                return $result;
                  
            }
    


    }

?>