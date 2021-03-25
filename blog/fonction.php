<?php

require_once 'db/database.php';

//Ajoute toute les information du media dans la BDD et son chemain
function addMediaBDD($typeMedia, $nomMedia, $idPost)
{

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
function addPostBDD($com)
{

  $bdd = myDatabase();
  $req = $bdd->prepare('INSERT INTO post(commentaire) VALUES(:com)');
  $req->execute(array(
    'com' => $com,
  ));

  $resultat = $bdd->lastInsertId();

  return $resultat;
}

// Recupere tout les post dans la bdd
function selectAllPost()
{

  $bdd = myDatabase();
  $req = $bdd->prepare('SELECT * FROM post ORDER BY creationDate DESC ');
  $req->execute(array());

  $resultat = $req->fetchAll();

  return $resultat;
}

// Recupere les information du media avec l'idPost des post
function selectMedia($idPost)
{

  $bdd = myDatabase();
  $req = $bdd->prepare('SELECT * FROM media WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
  ));

  $resultat = $req->fetchAll();

  return $resultat;
}

// Supression du post dans la bdd
function deletePost($idPost)
{

  $bdd = myDatabase();
  $req = $bdd->prepare('DELETE FROM post WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
  ));

  $resultat = $bdd->lastInsertId();

  return $resultat;
}

// Supression des media relié a un post dans la bdd
function deleteAllMediaPost($idPost)
{

  $bdd = myDatabase();
  $req = $bdd->prepare('DELETE FROM media WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
  ));

  $resultat = $bdd->lastInsertId();

  return $resultat;
}

// Recupere les information du post avec l'idPost du post
function selectPost($idPost)
{

  $bdd = myDatabase();
  $req = $bdd->prepare('SELECT * FROM post WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
  ));

  $resultat = $req->fetchAll();

  return $resultat;
}

// Supression d'un media d'un post dans la bdd
function deleteMedia($idMedia)
{

  $bdd = myDatabase();
  $req = $bdd->prepare('DELETE FROM media WHERE idmedia = :idMedia');
  $req->execute(array(
    'idMedia' => $idMedia,
  ));

  $resultat = $bdd->lastInsertId();

  return $resultat;
}

// Recupere les information du media avec l'idmedia
function selectOneMedia($idMedia)
{

  $bdd = myDatabase();
  $req = $bdd->prepare('SELECT * FROM media WHERE idmedia = :idMedia');
  $req->execute(array(
    'idMedia' => $idMedia,
  ));

  $resultat = $req->fetchAll();

  return $resultat;
}

// Met a jour le commentaire du post
function updatePost($idPost, $commentaire)
{

  $bdd = myDatabase();
  $req = $bdd->prepare('UPDATE post SET commentaire = :commentaire WHERE idPost = :idPost');
  $req->execute(array(
    'idPost' => $idPost,
    'commentaire' => $commentaire,
  ));

  $resultat = $bdd->lastInsertId();

  return $resultat;
}

//Affichage des posts 
function showPost($allPost)
{
  //Affichage des media selectioner en bdd
  for ($i = 0; $i < count($allPost); $i++) {
    $idPost = $allPost[$i]['idPost'];
    $media = selectMedia($idPost);



    echo '<div>
    <div class="uk-card uk-card-default">
    <a href="edit.php?idPost=' . $idPost . '" uk-icon="pencil"></a>
    <a onclick="supressionPost(' . $idPost . ')" uk-icon="trash"></a>
      <div class="uk-card-media-top">';
    if ($media != '') {
      for ($j = 0; $j < count($media); $j++) {

        $type = $media[$j]['typeMedia'];

        if (preg_match('/video\/*/', $type)) {
          //Affichage pour les videos
          echo '<video src="upload/' . $media[$j]['nomMedia'] . '" loop muted controls playsinline uk-video="autoplay: inview"></video>';
        } else if (preg_match('/audio\/*/', $type)) {
          //Affichage pour les audios
          echo '<audio controls>
        <source src="upload/' . $media[$j]['nomMedia'] . '" type="' . $type . '">
        </audio>';
        } else {
          //Affichage pour les images
          echo '<img src="upload/' . $media[$j]['nomMedia'] . '" alt="">';
        }
      }
    }
    echo '</div>
      <div class="uk-card-body">
        <p>' . $allPost[$i]['commentaire'] . '</p>
      </div>
    </div>
  </div>';
  }
}
