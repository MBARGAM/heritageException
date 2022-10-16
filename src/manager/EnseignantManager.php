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
                    $data["dateEntree"] = $faker->date();
                    $data["anciennete"] =$faker->randomDigitNotNull();
                    $data["infoPerso"] = $tableauParent[$i];

                    $newEnseignant = new Enseignant($data);
                    $tableauEnseignants[]=$newEnseignant;
                  
                }
                  return   $tableauEnseignants;  // tableau d objets  

            }

           

            public  function  create(Enseignant $enseignant){
                 /*insertion des  valeurs generales  dans la table elevesEnseignant
                et on termine  avec l insertion via la table cours*/
             
             
                $req = $this->connexion 
                ->prepare("INSERT INTO elevesEnseignant (nom,prenom,adresse,cp,pays,societe,statut,date_entree,anciennete ) 
                VALUES (:nom,:prenom,:adresse,:cp,:pays,:societe,:statut,:date_entree,:anciennete)");
      
               $req->bindValue(':nom',$enseignant->getNom());
               $req->bindValue(':prenom',$enseignant->getPrenom());
               $req->bindValue(':adresse',$enseignant->getAdresse());
               $req->bindValue(':cp',$enseignant->getCp());
               $req->bindValue(':pays',$enseignant->getPays());
               $req->bindValue(':societe',$enseignant->getSociete());
               $req->bindValue(':statut',$enseignant->getStatut());
               $req->bindValue(':date_entree',$enseignant-> getDateEntree());
               $req->bindValue(':anciennete',$enseignant->getAnciennete());
               $req->execute();
      
               // recuperation du personne et set de son id
              
               $enseignant->setId($this->connexion ->lastInsertId());

               $currentId = $enseignant->getId();
               $tabCours = $enseignant->getCoursDispenses();
                
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