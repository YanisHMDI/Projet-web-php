<h5>Albums list</h5>
<section class="list">
<?php
foreach($albums as $album){
	echo "<div><article>";
	echo "<header class='short-text'>";
	echo anchor("albums/view/{$album->id}","{$album->name}");
	echo "</header>";
	echo '<img src="data:image/jpeg;base64,'.base64_encode($album->jpeg).'" />';
	echo "<footer class='short-text'>{$album->year} - {$album->artistName}</footer>
	  </article></div>";
}
?>
</section>
