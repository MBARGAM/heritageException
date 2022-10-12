<?php
  
  namespace Isl\Heritage\classes;
 

  class Etudiant extends Personne {
       
    private $coursSuivis;
    private $niveau;
    private $dateInscription;

    public function __construct($data){
        
        $this->coursSuivis = isset($data["coursSuivis"])?$data["coursSuivis"]:null;
        $this->niveau =isset($data["niveau"])?$data["niveau"]:null;
        $this->dateInscription =isset($data["dateInscription"])?$data["dateInscription"]:null;
        parent::__construct($data["infoPerso"]); // appel du constructeur de la classe data

    }

    public function setCours($cours){

        $this->coursSuivis = $cours;

    }
    public function setNiveau($niveau){

        $this->niveau = $niveau;

    }

    public function setDateInscription($dateInscription){

        $this->dateInscription = $dateInscription;
        

    }

    public function getCours(){

        return $this->coursSuivis ;

    }
    public function getNiveau(){

        return  $this->niveau ;

    }

    public function getDateInscription(){

        return  $this->dateInscription ;

    }


  }



?>


