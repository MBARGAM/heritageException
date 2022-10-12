<?php
  
  namespace Isl\Heritage\classes;
 

  class Enseignant extends Personne {
       
    private $coursDispenses;
    private $dateEntree;
    private $anciennete;

    public function __construct($data){
        
        $this->coursDispenses= isset($data["coursDispenses"])?$data["coursDispenses"]:null;
        $this->dateEntree =isset($data["dateEntree"])?$data["dateEntree"]:null;
        $this->anciennete =isset($data["anciennete"])?$data["anciennete"]:null;
        parent::__construct($data["infoPerso"]); // appel du constructeur de la classe data

    }

    public function setCoursDispenses($cours){

        $this->coursDispenses = $cours;

    }
    public function setDateEntree($date){

        $this->dateEntree = $date;

    }

    public function setAnciennete($anciennete){

        $this->anciennete = $anciennete;
        

    }

    public function getCoursDispenses(){

        return $this->coursDispenses;

    }
    public function getDateEntree(){

        return  $this->dateEntree ;

    }

    public function getAnciennete(){

        return  $this->anciennete ;

    }


  }



?>


