<?php

require_once 'db/database.php';

//Ajoute toute les information du media dans la BDD et son chemain
function addMediaBDD($typeMedia, $nomMedia, $idPost){
 
    $bdd = myDatabase();
    $bdd->beginTransaction();
    try {
    $req = $bdd->prepare('INSERT INTO media(typeMedia, nomMedia, idPost) VALUES(:typeMedia, :nomMedia, :idPost)');
    $req->execute(array(
       'typeMedia' => $typeMedia,
        'nomMedia' => $nomMedia,
        'idPost' => $idPost,
          ));
 
          $resultat = $bdd->lastInsertId();

          $bdd->commit();
          return $resultat;
        } catch (\Throwable $th) {
          $bdd->rollBack();
     }

 }

 //Ajoute toute les information du media dans la BDD et son chemain
function addPostBDD($com){
 
  $bdd = myDatabase();
  $bdd->beginTransaction();
  try {
  $req = $bdd->prepare('INSERT INTO post(commentaire) VALUES(:com)');
  $req->execute(array(
    'com' => $com,
        ));

        $resultat = $bdd->lastInsertId();

       
    
        $bdd->commit();
        return $resultat;
      } catch (\Throwable $th) {
           $bdd->rollBack();
      }
}

 // Recupere tout les media dans la bdd
 function selectAllMedia(){

  $bdd = myDatabase();
  $req = $bdd->prepare('SELECT * FROM media');
  $req->execute(array(
        ));

        $resultat = $req->fetchAll();

        return $resultat;

}

// Recupere les information du post avec l'idPost des medias
function selectPost($idPost){

  $bdd = myDatabase();
  $req = $bdd->prepare('SELECT * FROM post WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
        ));

        $resultat = $req->fetchAll();

        return $resultat;

}