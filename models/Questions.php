<?php
class Questions implements IManager{
    private $idQuestions;
    private $libelleQuestion;
    private $libelleTypeQuestion;
    private $points;

    public function __construct($row = null)
    {
        if($row != null){
            $this->hydrate($row);
        }
    }

    public function hydrate($row)
    {
        $this->idQuestions = $row['idQuestions'];
        $this->libelleQuestion = $row['libelleQuestion'];
        $this->libelleTypeQuestion = $row['libelleTypeQuestion'];
        $this->points = $row['points'];
    }

    public function getIdQuestions(){
        return $this->idQuestions;
    }
    public function getLibelleQuestion(){
        return $this->libelleQuestion;
    }
    public function getPoints(){
        return $this->points;
    }
    public function getLibelleTypeQuestion(){
        return $this->libelleTypeQuestion;
    }


    public function setIdQuestions($idQuestions){
        return $this->idQuestions = $idQuestions;
    }
    public function setLibelleQuestion($libelleQuestion){
        return $this->libelleQuestion = $libelleQuestion;
    }
    public function setLibelleTypeQuestion($libelleTypeQuestion){
        return $this->libelleTypeQuestion = $libelleTypeQuestion;
    }
    public function setPoints($points){
        return $this->points = $points;
    }
}