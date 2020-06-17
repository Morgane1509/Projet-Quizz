<?php

class Partie extends Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->dirname = "partie";
      $this->layout = "layout_joueur";
   }