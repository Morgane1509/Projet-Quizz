<?php
class QuestionsManager extends Manager{
    function __construct(){
        $this->className="Questions";
    }
    public function create($objet){
        $sql="insert into `questions`(`idQuestions`, `libelleQuestion`, `libelleTypeQuestion`, `points`) values (null, '".$objet->getLibelleQuestion()."', '".$objet->getLibelleTypeQuestion()."', ".$objet->getPoints().");";
        return $this->ExecuteUpdate($sql)!=0;
     }
     public function update($objet){
 
     }
     public  function delete($id){
        
     }
     public function findAll(){
         $sql = "select * from questions;";
         $rows = $this->ExecuteSelect($sql);
         return $rows;
       
     }
     public function findById($id){
        $sql = "select * from questions where idQuestions=".$id.";";
        return $this->ExecuteSelect($sql);
     }  
     public function getId($libelle){
        $sql = "select idQuestions from questions where libelleQuestion='".$libelle."';";
        $rows = $this->ExecuteSelect($sql);
        return (int)$rows[0];
     }

     public function getId2($libelle){
        $sql = "select questions.idQuestions from questions where questions.libelleQuestion='".$libelle."';";
        $rows = $this->ExecuteSelect($sql);
        var_dump($rows);
        return (int)$rows[0];
     }
     
}