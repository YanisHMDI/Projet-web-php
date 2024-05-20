<!doctype html>
<html lang="en" class="has-navbar-fixed-top">
	<head>
		<meta charset="UTF-8" />
		<title>MUSIC APP</title>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
/>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <?=link_tag('assets/style.css')?>
	</head>
	<body>
		<main class='container'>
			<nav>
  <ul>
    <li><strong>Music APP</strong></li>
  </ul>
  <ul>
  <li><?=anchor('albums','Albums');?></li>
  <li><?=anchor('artistes','Artistes');?></li>
  <li><?=anchor('playlist','Playlist');?></li>
  </ul>
</nav>
