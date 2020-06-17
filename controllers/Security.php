<?php

class Security extends Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->dirname = "security";
      $this->layout = "layout_connexion";
   }

   public function index()
   {
      $this->views = "connexion";
      $this->render();
   }
   public function loadViewInscription()
   {
      $this->views = "inscription";
      $this->render();
   }

   public function register()
   {
      session_start();
      if (empty($_SESSION) === true) {
         $this->layout = "layout_connexion";
      } else {
         if (isset($_SESSION['utilisateur'])) {
            if ($_SESSION['utilisateur']->getProfil() == 'admin') {
               $this->layout = "layout_admin";
            }
         }
      }
      $this->loadViewInscription();
   }

   public function creerQuestion()
   {
      //Verification de soumission du formulaire de creation
      if (isset($_POST['btn_create'])) {
         //extraction suivant les cles du $_POST
         extract($_POST);
         $this->validator->is_empty($libelleQuestion, 'libelleQuestion', "Champ Obligatoire");
         $this->validator->is_positif($nbrePoints, 'nbrePoints');
         $this->validator->is_empty($typeQuestion, 'typeQuestion');
         // Tableau reponses fausses et vraies
         $reponses = [];
         if ($typeQuestion === "cs" || $typeQuestion === "cm") {
            // Reponse 1e radio ou checkbox
            if (isset($reponse1)) {
               $this->validator->is_empty($reponse1, 'reponse1');
               $reponses[] = $reponse1;
            } else {
               $this->data['createFailed'] = "Veuillez creer 2 champs !!!";
               $this->layout = "layout_admin";
               $this->views = "creerQuestions";
               $this->render();
            }
            // Reponse 2e radio ou checkbox
            if (isset($reponse2)) {
               $this->validator->is_empty($reponse2, 'reponse2');
               $reponses[] = $reponse2;
            } else {
               $this->data['createFailed'] = "Veuillez creer  au moins 2 champs !!!";
               $this->layout = "layout_admin";
               $this->views = "creerQuestions";
               $this->render();
            }
            // Reponse 3e radio ou checkbox
            if (isset($reponse3)) {
               $this->validator->is_empty($reponse3, 'reponse3');
               $reponses[] = $reponse3;
            }
         } else {
            // Reponse texte
            if (isset($reponse)) {
               $this->validator->is_empty($reponse, 'reponse');
               $reponses[] = $reponse;
            }
         }

         if ($this->validator->is_valid()) {
            // Declaration des managers de bdd respectifs
            $questionsManager = new QuestionsManager();
            $reponseManager = new ReponseManager();
            // Reponse type texte
            if (count($reponses) === 1) {
               $question = new Questions();
               $question->setLibelleQuestion($libelleQuestion);
               $question->setLibelleTypeQuestion("texte");
               $question->setPoints($nbrePoints);

               $questionsManager->create($question);

               $reponseTexte = new Reponse();
               $reponseTexte->setLibelleReponse($reponses[0]);
               $reponseTexte->setLibelleQuestion($libelleQuestion);
               $reponseTexte->setStatut("true");
               $idRef = $questionsManager->getId($libelleQuestion);

               $reponseTexte->setIdQuestions($idRef);
               $reponseManager->create($reponseTexte);

               $this->data['createSuccess'] = "La question a été créée";
               $this->layout = "layout_admin";
               $this->views = "creerQuestions";
               $this->render();
            }
            // Reponse type radio ou checkbox
            if (count($reponses) > 1) {
               $reponses[] = $reponseCheck;
               //var_dump($reponses)
               $question = new Questions();
               $question->setLibelleQuestion($libelleQuestion);
               $question->setLibelleTypeQuestion($typeQuestion);
               $question->setPoints($nbrePoints);
               if($questionsManager->create($question)){
                  $reponseType = new Reponse();
               $idRef = $questionsManager->getId($libelleQuestion);
               $reponseType->setIdQuestions($idRef);
               for ($i = 0; $i < count($reponses) - 1; $i++) {
                  //echo $i . '<br />'
                  if ($reponses[$i] === end($reponses)) {
                     $reponseType->setLibelleReponse($reponses[$i]);
                     $reponseType->setLibelleQuestion($libelleQuestion);
                     $reponseType->setBooleen("true");

                     $reponseManager->create($reponseType);

                     $this->data['createSuccess'] = "La question a été créée";
                     $this->layout = "layout_admin";
                     $this->views = "creerQuestions";
                     $this->render();
                  } else {
                     $reponseType->setLibelleReponse($reponses[$i]);
                     $reponseType->setLibelleQuestion($libelleQuestion);
                     $reponseType->setStatut("false");

                     $reponseManager->create($reponseType);

                     $this->data['createSuccess'] = "La question a été créée";
                     $this->layout = "layout_admin";
                     $this->views = "creerQuestions";
                     $this->render();
                  }
               }
            }
               
            }
         } else {
            $erreurs = $this->validator->getErrors();
            $this->data['errorCreate'] = $erreurs;
            $this->layout = "layout_admin";
            $this->views = "creerQuestions";
            $this->render();
         }
      } else {
         // passer par url
         $this->layout = "layout_admin";
         $this->views = "creerQuestions";
         $this->render();
      }
   }

   public function listerJoueurs()
   {
      $this->layout = "layout_admin";
      $this->views = "listerJoueurs";
      $this->render();
   }

   public function listerQuestions()
   {

      $this->layout = "layout_admin";
      $this->views = "listerQuestions";
      $this->render();
   }

   public function seConnecter()
   {
      session_start();
      // extract permet d'extraire les valeurs d'un tableau associatif sur ces clés
      if (isset($_POST['btn_connexion'])) {
         // Passer par le bouton de soumission
         extract($_POST);
         $this->validator->is_empty($login, 'login', 'Login Obligatoire');
         $this->validator->is_empty($password, 'password', 'Password Obligatoire');
         if ($this->validator->is_valid()) {
            // Connexion à la base de données
            $this->manager = new UserManager();
            $user = null;
            $user = $this->manager->getUserByLoginAndPwd($login, $password);
            if (!empty($user)) {
               //Login et mdp corrects
               $_SESSION['utilisateur'] = $user;
               $this->data['utilisateur_connecté'] = $user;
               if ($user->getProfil() === "admin") {
                  $this->layout = "layout_admin";
                  $this->views = "listerQuestions";
                  $this->render();
               } else {
                  $this->dirname = "partie";
                  $this->layout = "layout_joueur";
                  $this->views = "interfaceJoueur";
                  $this->render();
               }
            } else {
               //Login et mdp incorrects
               $this->data['incorrect_login'] = "Login ou Mot de Passe Incorrect";
               $this->views = "connexion";
               $this->render();
            }
         } else {
            // Champs non remplis->Erreur
            $erreurs = $this->validator->getErrors();
            $this->data['erreurs'] = $erreurs;
            $this->views = "connexion";
            $this->render();
         }
      } else {
         // Passer par URL
         $this->index();
      }
   }

   
   private function upload($user)
   {
      $file = $_FILES['imgUser'];

      $target_dir = WEBROOT . "assets/images/uploads/";
      $target_file = $target_dir . basename($file["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Check if image file is a actual image or fake image
      if (isset($_POST["submit"])) {
         $check = getimagesize($file["tmp_name"]);
         if ($check !== false) {
            $this->data['message'] = "Fichier est une image - " . $check["mime"] . ".";
            $uploadOk = 1;
         } else {
            $this->data['message'] = "Fichier n'est pas une image.";
            $uploadOk = 0;
         }
      }

      // Check if file already exists
      if (file_exists($target_file)) {
         $this->data['message'] = "Désolé, fichier existe déjà.";
         $uploadOk = 0;
      }

      // Check file size
      if ($file["size"] > 500000) {
         $this->data['message'] = "Désolé, votre fichier est très grand.";
         $uploadOk = 0;
      }

      // Allow certain file formats
      if (
         $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
         && $imageFileType != "gif"
      ) {
         $this->data['message'] = "Désolé, seulement les fichiers JPG, JPEG, PNG & GIF sont permis.";
         $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
         $this->data['message'] = "Désolé, votre fichier ne s'est pas téléchargé.";
         // if everything is ok, try to upload file
      } else {
         if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $user->setAvatar($file["tmp_name"]);
            $this->data['message'] = "Le fichier " . basename($file["name"]) . " a été téléchargé.";
            return true;
         } else {
            $this->data['message'] = "Désolé, il y a une erreur de téléchargement de votre fichier.";
         }
      }
   }

   public function createUser()
   {
      session_start();
      if (isset($_POST['btn_register'])) {
         extract($_POST);
         // verification des champ vides
         $this->validator->is_empty($prenom, 'prenom', 'Prenom obligatoire');
         $this->validator->is_empty($nom, 'nom', 'Nom obligatoire');
         $this->validator->is_empty($login, 'login', 'login obligatoire');
         $this->validator->is_empty($password, 'password');
         $this->validator->is_empty($pwdConfirme, 'confirmPassword');
         if ($this->validator->is_valid()) {
            // Tous les champs sont remplis
            if ($password === $pwdConfirme) {
               $this->manager = new UserManager();
               if (count($this->manager->getUserByLogin($login)) <= 0) {
                  if (isset($_SESSION['utilisateur'])) {
                     if ($_SESSION['utilisateur']->getProfil() == "admin") {
                        $user = new User();
                        $user->setFullName($prenom . " " . $nom);
                        $user->setLogin($login);
                        $user->setPwd($password);

                        $this->upload($user);
                           $this->manager->create($user);
                           $this->data['Success'] = "L'utilisateur créé";
                        
                        $this->register();
                     }
                  }

                  if ($_SESSION == null) {
                     $user = new User();
                     $user->setProfil('joueur');
                     $user->setFullName($prenom . " " . $nom);
                     $user->setLogin($login);
                     $user->setPwd($password);
                     if ($this->upload($user)) {
                        $this->manager->create($user);
                        $this->data['Success'] = "L'utilisateur créé";
                     }
                     $_SESSION['utilisateur'] = $user;
                     $this->dirname = "partie";
                     $this->layout = "layout_joueur";
                     $this->views = "interfaceJoueur";
                     $this->render();
               }
            } else {
                  //Login existe déjà
                  $this->data['login_exists'] = "Le login existe déjà";
                  $this->register();
               }
            } else {
               //Password et confirmPassword incorrects
               $this->data['err_password'] = "Les mots de passe ne correspondent pas";
               $this->register();
            }
         } else {
            // Tous les champs ne sont pas remplis
            $erreurs = $this->validator->getErrors();
            $this->data['erreurs'] = $erreurs;
            $this->register();
         }
      } else {
         $this->register();
      }
   }


   public function seDeconnecter()
   {
      if (isset($_POST['btn_logout'])) {
         $this->data = [];
         session_start();
         $_SESSION['utilisateur'] = '';
         session_destroy();
         header("Status: 301 Moved Permanently", false, 301);
         header("Location: http://localhost/Projet-Quizz/");
         exit;
      }
   }
}
