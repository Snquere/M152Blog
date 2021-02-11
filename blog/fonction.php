<?php

require_once 'db/database.php';

//Ajoute toute les information du media dans la BDD et son chemain
function addMediaBDD($typeMedia, $nomMedia){

    $bdd = myDatabase();
    $req = $bdd->prepare('INSERT INTO media(typeMedia, nomMedia, idPost) VALUES(:typeMedia, :nomMedia, :idPost)');
    $req->execute(array(
       'typeMedia' => $typeMedia,
        'nomMedia' => $nomMedia,
        'idPost' => 2,
          ));
 
          $resultat = $bdd->lastInsertId();
 
          return $resultat;
 
 }