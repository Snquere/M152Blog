<?php
require_once('fonction.php');

//Premiere verification de si le bouton du formulaire a été cliqué
if (filter_input(INPUT_POST, 'envoyer', FILTER_SANITIZE_STRING) == 'Publier') {
     //Filtrage de l'envoie du commentaire
     $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);

     //Les extension de fichier accepter
     $allowedExts = array("image/png", "image/jpg", "image/jpeg", "image/gif");

     if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
          // Raccourci d'écriture pour le tableau reçu
          $fichiers = $_FILES['media'];

          //Valeur taille max de l'ensemble des fichier
          $maxValeurToutFichier = 70000000;
          //valeur taille max de un seul fichier
          $maxValeurUnFichier = 3000000;

          $tailleToutFichier = 0;
          $tailleUnFichier = 0;

          $erreurTaille = false;

          for ($i = 0; $i < count($fichiers['name']); $i++) {
               $tailleToutFichier += $fichiers['size'][$i];
               $tailleUnFichier = $fichiers['size'][$i];

               if($tailleToutFichier > $maxValeurToutFichier || $tailleUnFichier > $maxValeurUnFichier){
                    $erreurTaille = true;
               }
          }

          if($erreurTaille == false) 
          {

          
          //chemain du dossier ou sauvegarder les fichier
          $dossier = 'upload/';

          //Verification que les extensions soient celle accpeter
          for ($i = 0; $i < count($fichiers['name']); $i++) {
               $type = $fichiers['type'][$i];
               if (!in_array($type, $allowedExts)) {
                    echo 'Un de vos fichier n\'est pas pris en compt';
                    echo '<br>';
                    echo 'Fichier ' . $fichiers['name'][$i];
                    exit();
               }
          }


          //Verification que le nom de fichier ne soi pas deja present dans le serveur
          //Dans le cas contraire on le modifie avec un nom unique
          for ($i = 0; $i < count($fichiers['name']); $i++) 
          {

               if (!file_exists("upload/" . $fichiers['name'][$i])) 
               {

                    // Affichage d’informations diverses
                    echo '<p>';
                    echo 'Fichier ' . $fichiers['name'][$i] . ' reçu';
                    echo '<br>';
                    echo 'Type ' . $fichiers['type'][$i];
                    echo '<br>';
                    echo 'Taille ' . $fichiers['size'][$i] . ' octets';

                    // Nettoyage du nom de fichier
                    $nom_fichier = preg_replace('/[^a-z0-9\.\-]/ i', '', $fichiers['name'][$i]);

                    // Déplacement depuis le répertoire temporaire
                    move_uploaded_file($fichiers['tmp_name'][$i], $dossier . $nom_fichier);

                    //Envoie des données du fichier a la base de donnée
                    addMediaBDD($fichiers['type'][$i], $fichiers['name'][$i]);
               
               } 
               else 
               {
                    //Si il existe on lui donne un nom unique

                    // Affichage d’informations diverses
                    echo '<p>';
                    echo 'Fichier ' . $fichiers['name'][$i] . ' reçu';
                    echo '<br>';
                    echo 'Type ' . $fichiers['type'][$i];
                    echo '<br>';
                    echo 'Taille ' . $fichiers['size'][$i] . ' octets';

                    // Nettoyage du nom de fichier
                    $nom_fichier = preg_replace('/[^a-z0-9\.\-]/ i', '', $fichiers['name'][$i]);

                    //Donne un nom unique au fichier
                    $nom_fichier = uniqid().$nom_fichier;
                    echo uniqid();

                    // Déplacement depuis le répertoire temporaire
                    move_uploaded_file($fichiers['tmp_name'][$i], $dossier . $nom_fichier);

                    //Envoie des données du fichier a la base de donnée
                    addMediaBDD($fichiers['type'][$i], $fichiers['name'][$i]);
               }
          }
          }
          else
          {
               echo 'Vos fichier dépasse la limite autoriser de 70Mo pour l\'ensemble de vos fichier ou 3Mo par fichier';
               echo '<br>'.$tailleToutFichier;
               echo '<br>'.$tailleUnFichier;
          }
     }
} 
else 
{
     echo 'Desoler il y a eu un probleme';
     //header("location : post.php");
}
