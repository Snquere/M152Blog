<?php

//Premiere verification de si le bouton du formulaire a été cliqué
if (filter_input(INPUT_POST, 'envoyer', FILTER_SANITIZE_STRING) == 'Publier')
{
//Filtrage de l'envoie du commentaire
$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);

//Verification que les 2 champ ne sois pas vide
if(isset($_FILES['avatar']) || isset($commentaire))
{ 
     $dossier = 'upload/';
     $fichier = basename($_FILES['avatar']['name']);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}

}
else
{
header("location : post.php");
}