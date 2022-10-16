<?php

  include_once("function.php");
 require_once("vendor/autoload.php");
 use Isl\Heritage\classes\Etudiant;
 use Isl\Heritage\classes\Enseignant;
 use Isl\Heritage\classes\Personne ;
use Isl\Heritage\manager\EtudiantManager;
use Isl\Heritage\manager\EnseignantManager;

 $connexion = new PDO('mysql:host=localhost;dbname=webDev3','root','root');

  
 /*$infos=["nom"=>"mbarga","prenom"=>"justyn","adresse"=>"quai du condroz","cp"=>4020,"pays"=>"belgique","societe"=>"tempo"];
 $coursSuivis = ["physique","chimie","maths"];
 $coursDispenses = ["physique","chimie","maths"];
 $datas = ["coursSuivis"=>$coursSuivis,"niveau"=>"3eme annee","dateInscription"=>"10-12-2022","infoPerso"=>$infos];
 $tab =$datas = ["coursDispenses"=>$coursDispenses,"dateEntree"=>"12_12_2020","anciennete"=>10,"infoPerso"=>$infos];
 
 $etudiant= new Etudiant($datas);
 $enseignant= new Enseignant($tab);
 print_q($etudiant);
 print_q($enseignant);*/

   $newSetEtudiant = new EtudiantManager(2,$connexion);//instanciation du manager des etudiants avec le nbre d etudiants  a creer
   $newSetEnseignant = new EnseignantManager(2,$connexion);//instanciation du manager des enseignants avec le nbre d enseignants  a creer

   $tableEtudiants = $newSetEtudiant->createEtudiant(2);//table contenant des objets etudiants en appelant la methode faker en prenant en parametre le nbre de cours
   $tableEnseignant= $newSetEnseignant->createEnseignant(2);//table contenant des objets enseignants en appelant la methode faker en prenant en parametre le nbre de cours
  
   /* boucle sur les 2 tables afin d inserer les donnees dans la base de donnee
     */
  print_q($tableEtudiants);
  foreach($tableEtudiants as $value){
     $newSetEtudiant->create($value);
  }

  print_q($tableEnseignant);
  foreach($tableEnseignant as $value){
   $newSetEnseignant->create($value);
 }



   
?>