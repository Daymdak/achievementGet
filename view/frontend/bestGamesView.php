<?php $title = "Nos recommendations !"; ?>

<?php ob_start(); ?>

<div id="listGames" class="col-12 col-lg-10 centerElement">

</div>

<script src="vendor/jQuery/jquery.js"></script>
<script src="public/js/ajax.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>