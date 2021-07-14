<!doctype html>
<html lang="NL">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,400;1,600&display=swap"
    rel="stylesheet">

	  <link rel="stylesheet" href="../styles/main.css" />
  <link rel="stylesheet" href="../styles/navigation.css" />

  <title>Eenmaal Andermaal</title>
</head>
<body class="container-fluid">
	<main class="row">
	<?php include '../components/navigation.php'?>
       
      <form method="post" action="../data/Mail.php" > 
			<div style="justify-content: center">
				<input class="btn btn-primary" type="submit" value="Verstuur code" />
			</div>
        </form>
            
	</main>
</body>
</html>