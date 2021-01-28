<?php
require('uikit.php');
require('fonction.php');
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
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div class="uk-margin uk-margin-auto">

				<div class="uk-margin">
					<textarea class="uk-textarea" name="commentaire" rows="5" placeholder="...."></textarea>
				</div>

				<div class="uk-margin">

					<div class="uk-form-custom uk-float-left">
					<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
						<input name="media" type="file">
						<button class="uk-button uk-button-default" type="button" tabindex="-1"><span uk-icon="camera"></span></button>
					</div>
				
					<input class="uk-button uk-button-primary uk-float-right" type="submit" name="envoyer" value="Publier">

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