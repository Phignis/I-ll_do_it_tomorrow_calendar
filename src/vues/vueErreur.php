<html>
	<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
	<link rel="stylesheet" href="ressources/style/bootstrap.min.css">
    <link rel="stylesheet" href="ressources/style/index.css">
    <link rel="stylesheet" href="ressources/style/vueErreur.css">
	<link rel="stylesheet" href="ressources/style/footer.css">

    <title>Procrastinator Calendar</title>
  </head>
	<body>
		<?php include("ressources/html_parts/header.php") ?>
		<section>
			<h1>Erreur :</h1>
			<div id="tableau">
				<div id="Intitules">
					<p>Erreur :</p>
				</div>
				<?php
					foreach($erreurs as $row){
					?>
						<div id="rowError">
							<p><?= $row ?></p>
						</div>
					<?php 
					} 
					?>
			</div>
		</section>
		<?php include("ressources/html_parts/footer.php") ?>
	</body>
</html>
