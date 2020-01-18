<?php $title = "Comment ça marche ?"; ?>

<?php ob_start(); ?>

<div class="container-fluid">
	<div id="playButtonBlock" class="centerElement">
		<button id="playButton" class="fas fa-play fa-2x darkPanel centerElement" ></button>
	</div>
	<div class="row mt-2">
		<div id="slider" class="darkPanel">
			<button id="previousButton" class="slider_button prev fa-2x fa fa-chevron-left"></button>
			<div id="box">
				<img src="public/images/howItWorks/image1.png" alt="Illustrations du fonctionnement du site">
			</div>
			<button id="nextButton" class="slider_button next fa-2x fa fa-chevron-right"></button>
		</div>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>