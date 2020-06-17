<?php
error_reporting(E_ALL ^ E_NOTICE);
define("WEBROOT", "http://localhost/Projet-Quizz/");
require_once "libs/Router.php";
$router = new Router();
$router->getRoute();
