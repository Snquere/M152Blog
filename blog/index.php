<?php
require('uikit.php');
require('fonction.php');
$allPost = selectAllPost();

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

	<div class="uk-section uk-section-default">
		<div class="uk-container">

			<div class="uk-grid-match uk-child-width-1-2@m" uk-grid>
				<!-- Section 1 -->
				<div>
					<div class="uk-child-width-1-1@m" uk-grid>
						<div>
							<div class="uk-card uk-card-default">
								<div class="uk-card-media-top">
									<img src="img/pdp.png" alt="">
								</div>
								<div class="uk-card-body">
									<h3 class="uk-card-title">Media Top</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Section 1 -->

				<!-- Section 2 -->
				<div>
					<!-- Welcome -->
					<div class="uk-card uk-card-hover uk-card-body">
						<h3 class="uk-card-title">WELCOME</h3>
						<p>Passez une bonne journée</p>
					</div>
					<!-- /Welcome -->

					<!-- Post -->
					<div class="uk-child-width-1-1@m" uk-grid>
						<?php
						//Affichage des media selectioner en bdd
						for ($i = 0; $i < count($allPost); $i++) {
							$idPost = $allPost[$i]['idPost'];
							$media = selectMedia($idPost);



							echo '<div>
							<div class="uk-card uk-card-default">
							<a href="" uk-icon="cog"></a>
								<div class="uk-card-media-top">';
							for ($j = 0; $j < count($media); $j++) {

								$type = $media[$j]['typeMedia'];

								if (preg_match('/video\/*/', $type)) {
									//Affichage pour les videos
									echo '<video src="upload/' . $media[$j]['nomMedia'] . '" loop muted controls playsinline uk-video="autoplay: inview"></video>';
								} else if (preg_match('/audio\/*/', $type)) {
									//Affichage pour les audios
									echo '<audio controls>
									<source src="upload/' . $media[$j]['nomMedia'] . '" type="'.$type.'">
									</audio>';
								} else {
									//Affichage pour les images
									echo '<img src="upload/' . $media[$j]['nomMedia'] . '" alt="">';
								}
							}
							echo '</div>
								<div class="uk-card-body">
									<p>' . $allPost[$i]['commentaire'] . '</p>
								</div>
							</div>
						</div>';
						}
						?>

					</div>
					<!-- /Post -->

				</div>
				<!-- /Section 2 -->

			</div>

		</div>
	</div>

	<!-- /BODY CONTENU -->

	<!-- JS FILES -->
	<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
</body>

</html>