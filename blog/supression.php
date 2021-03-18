<?php
require_once('fonction.php');
$bdd = myDatabase();
//Contrlle que les 2 fonction on reussi
$bdd->beginTransaction();
try {
if (isset($_GET['idPost'])) {
$idPost = filter_input(INPUT_GET, 'idPost', FILTER_SANITIZE_STRING);

$supMedia = selectMedia($idPost);

deletePost($idPost);
deleteAllMediaPost($idPost);

//Supression des img stocké sur le serveur
for ($i = 0; $i < count($supMedia); $i++) {
    unlink('./upload/'.$supMedia[$i]['nomMedia']);
}


}else{
    header('location:index.php');
    exit();
}
$bdd->commit();
} catch (\Throwable $th) {
     $bdd->rollBack();
}
header('location:index.php');
