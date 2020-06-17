<?php
class User implements IManager{
    private $id;
    private $fullName;
    private $login;
    private $pwd;
    private $profil;
    private $avatar;
    private $score;

    public function __construct($row=null){
        $this->profil = 'admin';
        $this->score = 0;
        if($row!=null){
            $this->hydrate($row);
        }
    }

    public function hydrate($row){
       $this->id=$row['id'];
       $this->fullName=$row['fullName'];
       $this->login=$row['login'];
       $this->pwd=$row['pwd'];
       $this->profil=$row['profil'];
       $this->avatar=$row['avatar'];
    }

    public function getId(){
        return $this->id;
    }
    public function getProfil(){
        return $this->profil;
    }
    public function getFullName(){
        return $this->fullName;
    }
    public function getLogin(){
        return $this->login;
    }
    public function getPwd(){
        return $this->pwd;
    }
    public function getAvatar(){
        return $this->avatar;
    }
    public function getScore(){
        return $this->score;
    }


    public function setProfil($profil){
        $this->profil = $profil;
    }
    public function setFullName($fullName){
        $this->fullName = $fullName;
    }
    public function setLogin($login){
        $this->login = $login;
    }
    public function setPwd($pwd){
        $this->pwd = $pwd;
    }
    public function setAvatar($avatar){
        $this->avatar = $avatar;
    }
    public function setScore($score){
        $this->score = $score;
    }
}