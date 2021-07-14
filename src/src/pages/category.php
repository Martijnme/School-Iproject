<?php
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['route'])) {
        $category = array("Root");
        $_SESSION['route'] = $category;
    }
}

require_once('../data/Database.php');
require_once('../data/Category.php');
require_once('../data/Auction.php');

$db = new Database('sql2.ip.aimsites.nl', "iproject9", "TFdFYdta0OFQYAlnd3UlGRnHWUzq36sq", 'iproject9');
$conn = $db->connect();

$category = new Category($conn);
$auction = new Auction($conn);
$categoryItem = $category->getItemsInElement(htmlspecialchars($_GET['rubriek']));
$categoryVeilingen = $auction->getAllAuctionByRubrieknaam(htmlspecialchars($_GET['rubriek']));

?>
<!DOCTYPE html>
<html lang="NL">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../images/FaviconMenu.jpg" type="image/x-icon" />
    <meta charset="utf-8" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/navigation.css">
    <link rel="stylesheet" href="../styles/button.css">
    <link rel="stylesheet" href="../styles/card.css">
    <title>EenmaalAndermaal</title>
</head>

<body class="container-fluid">
    <main class="row">
        <?php include '../components/navigation.php' ?>
        <section class="col-10 offset-2">
            <div class="container p-0">
                <div class="row justify-content-center">
                    <section class="row pt-5">
                        <div class="pb-3">
                            <?php
                            if (in_array($_GET['rubriek'], $_SESSION['route'])) {
                                $pos = array_search($_GET['rubriek'], $_SESSION['route']);
                                array_splice($_SESSION['route'], ++$pos);
                            } else {
                                array_push($_SESSION['route'], htmlspecialchars($_GET['rubriek']));
                            }
                            foreach ($_SESSION['route'] as $routeCategory) {
                                if (end($_SESSION['route']) === $routeCategory) { ?>
                                    <a href="category.php?rubriek=<?= $routeCategory ?>" style="text-decoration: none; color: black;"><?= $routeCategory ?></a>
                                <?php } else { ?>
                                    <a href="category.php?rubriek=<?= $routeCategory ?>" style="text-decoration: none; color: black;"><?= $routeCategory ?> > </a>
                            <?php }
                            } ?>
                        </div>
                        <?php if ($_GET['rubriek'] == 'Root') {
                            foreach ($categoryItem as $rootnames) { ?>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                    <div class="col-12 card">
                                        <div class="category">
                                            <img class="card-img-top categoryImage" src="/images/Categorie/<?= $rootnames['rubrieknaam'] ?>.jpg" alt="<?= $rootnames['rubrieknaam'] ?>">
                                        </div>
                                        <div class="card-body">
                                            <a class="card-title m-0" style="text-decoration: none; color: black;" href="category.php?rubriek=<?= $rootnames['rubrieknaam'] ?>"><?= $rootnames['rubrieknaam'] ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else if (empty($categoryItem)) { ?>
                            <p style="color: red;">Sorry! Deze categorie heeft geen subcategorieen</p>
                        <?php } else { ?>
                            <?php foreach ($categoryItem as $item) { ?>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                                    <div class="col-12 card">
                                        <div class="card-body" style="text-align: center">
                                            <a class="card-title m-0" style="text-decoration: none; color: black;" href="category.php?rubriek=<?= $item['rubrieknaam'] ?>">
                                                <?= $item['rubrieknaam']  ?></a>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <!--VEILINGEN PER CATEGORIE-->
                        <section>
                            <?php
                            if (empty($categoryVeilingen) && $_GET['rubriek'] != 'Root') { ?>
                                <p style="color: red;">Sorry! Deze categorie heeft geen veilingen</p>
                                <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) { ?>
                                    <a href="../pages/veiling.php" class="btn btn-primary d-grid">Nieuwe veiling aanbieden</a>
                                    <ul>
                                    <?php }
                            } else {
                                foreach ($categoryVeilingen as $auctionItem) { ?>
                                        <li><?= $auctionItem['titel'] ?></li>
                                <?php }
                            } ?>
                                    </ul>
                        </section>
                    </section>
                </div>
            </div>
        </section>
    </main>
</body>

</html>