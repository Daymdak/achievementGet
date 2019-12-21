<?php
if ($elementByPage < $nbrElements)
{
?>
<div class="col-10 darkPanel centerElement mb-1">
	<div class="row">
		<div class="col-1">
			<?php
			if ($page > 1) {
			?>
				<a href="index.php?action=<?= $_GET['action']?>
				<?php
				if (isset($_GET['id'])) {
					echo "&id=" . $_GET['id'];	
				}
				if (isset($_GET['type'])) {
					echo "&type=" . $_GET['type'];
				}
				?>
					&page=<?= $page-1 ?>" class="yellow"><i class="fas fa-backward"></i></a>
			<?php
			}
			?>
		</div>
		<div class="col-10">
			<p class="text-center">Page <?= $page ?></p>
		</div>
		<div class="col-1">
			<?php
			if ($firstElement+$elementByPage < $nbrElements) {
			?>
				<a href="index.php?action=<?= $_GET['action']?>
				<?php
				if (isset($_GET['id'])) {
					echo "&id=" . $_GET['id'];	
				}
				if (isset($_GET['type'])) {
					echo "&type=" . $_GET['type'];
				}
				?>
				&page=<?= $page+1 ?>" class="yellow" ><i class="fas fa-forward"></i></a>
			<?php
			}
			?>
		</div>
	</div>
</div>
<?php
}
?>