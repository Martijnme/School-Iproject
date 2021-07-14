<?php
    if (!isset($_SESSION)) { 
        session_start(); 
    }
    if(isset($_GET['message'])){
        $message = $_GET['message'];  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="shortcut icon" href="../../images/FaviconMenu.jpg" type="image/x-icon" />

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,400;1,600&display=swap"
    rel="stylesheet">

    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/form.css">
    <link rel="stylesheet" href="../styles/button.css">
	<link rel="stylesheet" href="../styles/navigation.css">
    
    <title>EenmaalAndermaal</title>
</head>
<body style="min-height: 80vh">
    <main class="row">
        <?php include '../components/navigation.php'?>

        <form class="offset-1 col-12 " style="transform: scale(1.25); display: inherit; justify-content: center; align-items:center; flex-direction: column" method="post" action="authLogin.php" >
        <?php if ($message == "succesRegister") { echo "<p style='color: #76BA1B; font-size: 75%'>Registratie succesvol</p>"; }
            if($message == 'veilingplaatsen'){ echo "<p style='color: #ff0f0f; font-size: 75%'>Om een veiling te plaatsen moet je ingelogd zijn</p>";} ?>
        <img src="../../images/FaviconMenu-Big.svg" style="max-height: 20vh" alt="EenmaalAndermaal logo">
            <div class="form-group mb-1 row-2">
                <label>
                    Gebruikersnaam:
                    <input type="text" class="form-control" name="gebruikersnaam" required />
                </label>
                
            </div>
            <div class="form-group mb-1">
                <label>
                    Wachtwoord:
                    <input type="password" class="form-control" name="wachtwoord" required />
                </label>
                <?php if ($message == "error") { echo "<p style='color: #ff0f0f; font-size: 75%'>gegevens zijn ongeldig</p>"; } ?>
            </div>    
			<div class="form-group mb-2" style="display: flex; flex-direction: row; justify-content: center">
				<input class="btn btn-secondary col-8" style="margin-right: 3px" type="button" value="Registreer" onclick="location.href='../pages/registratie.php';"  />
				<input class="btn btn-primary col-8"type="submit" value="Log in" />
			</div>
        </form>
    </main>
</body>
</html>