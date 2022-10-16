<?php 

     namespace Isl\Heritage\manager;
     use Isl\Heritage\classes\Etudiant;
     use PDO;
     use Faker\Factory ;
   

     class EtudiantManager extends PersonneManager{
           private $nbreEleves ;
          

           public function __construct($nbreEleves,$connexion){
               $this->nbreEleves = $nbreEleves ;
               parent::__construct($connexion);
           }

            public function getEleves(){
                return $this->nbreEleves;
            }
            public function setEleves($nbreEleves){
                if(is_numeric($nbreEleves)){
                  $this->nbreEleves = $nbreEleves;
                }
            }

            public function createEtudiant($nbreCoursSuivis){

                $faker = Factory::create();
                $tableauParent = parent::createPersonne($this->nbreEleves);  // appel de la methode parent create personne     
                
                // boucle afin de creer un tableau d objet etudiants 
                 $tableauEtudiants=[];

                 /*boucle qui permet de creer un tableau de cours ,parcours un tableau du nbre d eleves 
                 a creer et de creation de l objet eleve */

                for($i = 0 ; $i< $this->nbreEleves ;$i++){
                    $data= [];
                    $data["coursSuivis"]= parent::createCours($nbreCoursSuivis); // creation des cours a travers la methode parent
                    $data["niveau"] = $faker->buildingNumber();
                    $data["dateInscription"] =$faker->date();
                    $data["infoPerso"] = $tableauParent[$i];
                    

                    $newEtudiant = new Etudiant($data);
            
                    $tableauEtudiants[]=$newEtudiant;
                  
                }
                  return   $tableauEtudiants ;  // tableau d objets  

            }

            public  function  create(Etudiant $etudiant){
                /*insertion des  valeurs generales  dans la table elevesEnseignant
                et on termine  avec l insertion via la table cours*/
             
                $req = $this->connexion 
                ->prepare("INSERT INTO elevesEnseignant (nom,prenom,adresse,cp,pays,societe,statut,niveau,date_entree ) 
                VALUES (:nom,:prenom,:adresse,:cp,:pays,:societe,:statut,:niveau,:date_entree)");
      
               $req->bindValue(':nom',$etudiant->getNom());
               $req->bindValue(':prenom',$etudiant->getPrenom());
               $req->bindValue(':adresse',$etudiant->getAdresse());
               $req->bindValue(':cp',$etudiant->getCp());
               $req->bindValue(':pays',$etudiant->getPays());
               $req->bindValue(':societe',$etudiant->getSociete());
               $req->bindValue(':statut',$etudiant->getStatut());
               $req->bindValue(':niveau',$etudiant->getNiveau());
               $req->bindValue(':date_entree',$etudiant->getDateInscription());
               $req->execute();
      
               // recuperation du personne et set de son id
              
               $etudiant->setId($this->connexion ->lastInsertId());

               $currentId = $etudiant->getId();
               $tabCours = $etudiant->getCours();
                
               // boucle sur la variable et insertion vers la cours cours ayant pour cle etrangere la table eleveEnseignant
               foreach($tabCours as $value){
                  $req = $this->connexion 
                  ->prepare("INSERT INTO cours (nomCours,idPersonne) VALUES (:nomCours,:idPersonne)");
                   $req->bindValue(':nomCours',$value);
                  $req->bindValue(':idPersonne',$currentId);
                  $req->execute();
                
               }
              
            
      
            }
        }
     



?>