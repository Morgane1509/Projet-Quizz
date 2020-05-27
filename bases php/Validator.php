<?php
class Validator {
    
    private $errors=[];

    public function getErrors(){
           return $this->errors;
    }

    public function is_valid(){
       return count($this->errors)===0;
    }

 // Longueur et Largueur doivent etre numeric(entier,reel)
 public function is_number($nombre,$key,$errorMessage="Veuiller saisir un nombre"){
    if(!is_numeric($nombre)){
        $this->errors[$key]= $errorMessage;
    }
}

public function sup10000($value,$key,$errorMessage="Le nombre doit etre superieur à 10000"){
    $this->is_positif($value,$key);
    if($this->is_valid()){
        if($value<=10000){
          $this->errors[$key]= $errorMessage;
        }
      }
}

public static function estPremier($value){
        $cpt = 0;
        for($i=1; $i<=$value; $i++){
            if(($value % $i) === 0){
                $cpt++;
                if($cpt>2){
                break;
                }
            }
        }
        if($cpt === 2){
            return $value;
        }
    
}

public static function moyenne($table){
    $sum = 0;
    foreach($table as $value){
        $sum += $value; 
    }
    return $sum/count($table);
}



/*
  Longueur positif
  Largeur positif
*/
public function is_positif($nombre,$key,$errorMessage="Veuiller saisir un nombre positif"){
                   $this->is_number($nombre,$key);
                   if($this->is_valid()){
                      if($nombre<=0){
                        $this->errors[$key]= $errorMessage;
                      }
                    }
                   
}

/**
*   Longueur> Largeur
*/
//compare()
//Nbre1 =>plus grand
//Nbre2 =>plus petit
public function compare($nbre1,$nbre2,$key1,$key2,$errorMessage="Longueur doit superieur à la Largeur"){
    $this->is_positif($nbre1,$key1);
    $this->is_positif($nbre2,$key2);
   if($this->is_valid()){
           if($nbre1<=$nbre2){
              $this->errors['all']=$errorMessage;
           }
   }

}

public function  is_empty($nbre,$key,$sms=null){
    if(empty($nbre)){
        if($sms==null){
            $sms="Le Nombre  est Obligatoire";
        }
        $this->errors[$key]= $sms;

        }
    }
//Expressions Régulières
public function  is_email($valeur,$key,$sms=null){
    $regex = "#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#";
    if(!preg_match($regex, $valeur)){
        $sms = "L'email est invalide";
        $this->errors[$key] = $sms;
    }
}

//9chiffres , commence par 77,78,75,76,70
public function  is_telephone($valeur,$key,$sms=null){
    $regex = "#^7[05-8][-. ]?[0-9]{3}([-. ]?[0-9]{2}){2}$#";
    if(!preg_match($regex, $valeur)){
        $sms = "Le numéro est invalide";
        $this->errors[$key] = $sms;
    }
}





}
