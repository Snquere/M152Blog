<?php

require_once 'db/database.php';

//Ajoute toute les information du media dans la BDD et son chemain
function addMediaBDD($typeMedia, $nomMedia, $idPost){
 
  $bdd = myDatabase();
    $req = $bdd->prepare('INSERT INTO media(typeMedia, nomMedia, idPost) VALUES(:typeMedia, :nomMedia, :idPost)');
    $req->execute(array(
       'typeMedia' => $typeMedia,
        'nomMedia' => $nomMedia,
        'idPost' => $idPost,
          ));
 
          $resultat = $bdd->lastInsertId();
          return $resultat;
 }

 //Ajoute toute les information du media dans la BDD et son chemain
function addPostBDD($com){
 
  $bdd = myDatabase();
  $req = $bdd->prepare('INSERT INTO post(commentaire) VALUES(:com)');
  $req->execute(array(
    'com' => $com,
        ));

        $resultat = $bdd->lastInsertId();

        return $resultat;

}

 // Recupere tout les post dans la bdd
 function selectAllPost(){

  $bdd = myDatabase();
  $req = $bdd->prepare('SELECT * FROM post ORDER BY creationDate DESC ');
  $req->execute(array(
        ));

        $resultat = $req->fetchAll();

        return $resultat;

}

// Recupere les information du media avec l'idPost des post
function selectMedia($idPost){

  $bdd = myDatabase();
  $req = $bdd->prepare('SELECT * FROM media WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
        ));

        $resultat = $req->fetchAll();

        return $resultat;

}

// Supression du post dans la bdd
function deletePost($idPost){

  $bdd = myDatabase();
  $req = $bdd->prepare('DELETE FROM post WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
        ));

        $resultat = $bdd->lastInsertId();

        return $resultat;

}

// Supression des media relié a un post dans la bdd
function deleteAllMediaPost($idPost){

  $bdd = myDatabase();
  $req = $bdd->prepare('DELETE FROM media WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
        ));

        $resultat = $bdd->lastInsertId();

        return $resultat;

}