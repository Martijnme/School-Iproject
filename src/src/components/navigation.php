<?php
if (!isset($_SESSION)) {
  session_start();
	if(!isset($_SESSION['route'])){
		$category = array("Root");
    $_SESSION['route'] = $category;
	}
}
?>
<header class="col-2 position-fixed text-center" id="sticky-sidebar">
      <nav class="position-sticky">
        <a href="../../index.php"><img src="../../images/FaviconMenu.jpg" alt="Logo" /></a>
        <ul class="nav flex-column flex-nowrap vh-100 overflow-auto">
          <li class="nav-item">
          <?php
          if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
              echo '<a href="../../src/pages/profile.php">
			        <img src="../../images/User.svg" alt="Profile" />
              <p>'.$_SESSION["user"].'</p>
              </a>';
          } 
          ?>
          </li>
          <li class="nav-item">
            <a href="../../../index.php"><img src="../../images/Home.svg" alt="Home" />
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../src/pages/category.php?rubriek=Root"><img src="../../images/Categorieen.svg" alt="Categorie" />
              <p>Categorieën</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../src/pages/veilingplaatsen.php"><img src="../../images/AdvertentieToevoegen.svg" alt="Veiling plaatsen" />
              <p>Veiling plaatsen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../src/pages/overons.php"><img src="../../images/OverOns.svg" alt="Over ons" />
              <p>Over ons</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../src/pages/faq.php"><img src="../../images/Information.svg" alt="Informatie" />
              <p>FAQ</p>
            </a>
          </li>
			<li class="nav-item">
					<?php 
					if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
						echo '<a href="../../src/functions/logout.php">
						<img src="../../images/Uitloggen.svg" alt="Uitloggen" />
						<p>Uitloggen</p>
						</a>';
					}else {
						echo '<a href="../../src/functions/login.php">
						<img src="../../images/Inloggen.svg" alt="Inloggen" />
						<p>Login</p>
						</a>';
					}
					?>
			</li>
        </ul>
      </nav>
    </header>
