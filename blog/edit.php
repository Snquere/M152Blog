<?php
require('uikit.php');
require('fonction.php');

//Verification que le GET idPost n'est pas vide
if (isset($_GET['idPost'])) {
	$idPost = filter_input(INPUT_GET, 'idPost', FILTER_SANITIZE_STRING);
//Selection du post pour affichage
	$media = selectMedia($idPost);
	$post = selectPost($idPost);
} else {
	header('location:index.php');
	exit();
}

//Verification que le GET idMedia n'est pas vide
if (isset($_GET['idMedia'])) {
	$idMedia = filter_input(INPUT_GET, 'idMedia', FILTER_SANITIZE_STRING);
//Supression du media dans la base et sur le serveur
	$selectMedia = selectOneMedia($idMedia);
	deleteMedia($idMedia);
	unlink('./upload/'.$selectMedia[0]['nomMedia']);
	header('location:edit.php?idPost=' . $idPost . '');
	exit();
}

?>

<!-- _____________________________HTML____________________________ -->
<!DOCTYPE html>
<html class="" lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog</title>
	<link rel="icon" href="img/favicon.ico">

</head>

<body class="">
	<!-- BODY CONTENU -->

	<!-- Nav -->
	<?php require('navbar.php'); ?>
	<!-- /Nav -->


	<div class="uk-container uk-container-xsmall uk-text-center">
		<!-- Form -->
		<form action="update.php" method="post" enctype="multipart/form-data">
			<div class="uk-margin uk-margin-auto">

				<div class="uk-margin">
					<textarea class="uk-textarea" name="commentaire" rows="5" placeholder="...."><?php echo $post[0]['commentaire']; ?></textarea>
				</div>

				<?php
				echo '<div>
				<div class="uk-card uk-card-default">
					<div class="uk-card-media-top">';
				for ($j = 0; $j < count($media); $j++) {

					echo '<a href="edit.php?idPost=' . $idPost . '&idMedia=' . $media[$j]['idmedia'] . '" uk-icon="trash">Suprimer l\'image si dessous du post</a><br>';

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
				echo '</div>
				</div>
			</div>';

				?>

				<div class="uk-margin">

					<div class="uk-form-custom uk-float-left">
						<input name="media[]" type="file" accept="image/*, audio/*, video/*" multiple>
						<button class="uk-button uk-button-default" type="button" tabindex="-1"><span uk-icon="camera"></span></button>
					</div>

					<input class="uk-button uk-button-primary uk-float-right" type="submit" name="envoyer" value="Editer">
					<input type="hidden" name="idPost" value="<?php echo $idPost; ?>">

				</div>
			</div>
		</form>
		<!-- /Form -->
	</div>


	<!-- /BODY CONTENU -->

	<!-- JS FILES -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
</body>

</html>