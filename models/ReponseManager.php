<?php
class ReponseManager extends Manager{
    function __construct(){
        $this->className="Reponse";
    }
    public function create($objet){
        $sql="insert into `reponse`(`idReponse` ,`libelleReponse` ,`booleen` ,`libelleQuestion` ,`idQuestions`) values (null, '".$objet->getLibelleReponse()."', '".$objet->getBooleen()."', '".$objet->getLibelleQuestion()."', ".$objet->getidQuestions().");";
        return $this->ExecuteUpdate($sql)!=0;
     }
     public function update($objet){
 
     }
     public  function delete($id){
       
     }
     public function findAll(){
         $sql = "select * from reponse;";
         $rows = $this->ExecuteSelect($sql);
         return $rows;
       
     }
     public function findById($id){
        $sql = "select * from reponse where idReponse=".$id.";";
        return $this->ExecuteSelect($sql);
     }  

     public function getId($libelle){
        $sql = "select questions.idQuestions from questions inner join reponse on questions.idQuestions=reponse.idQuestions where questions.libelleQuestion='".$libelle."';";
        return (int)$this->ExecuteSelect($sql)[0];

    
     }
     
}