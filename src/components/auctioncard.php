<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
    <div class="col-12 card">
        <img class="card-img-top" src="../../images/<?= $auction['titel'] ?>.jpg" alt="<?= $auction['titel'] ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $auction['titel'] ?></h5>
            <p class="veilingStatusOpen"><?= $auction['veilingGesloten'] ?></p>
            <div class="card-text d-flex justify-content-between beschrijving">
                <p class="huidigeBod">Huidig bod:</p>
                <p class="prijs"><?= $auction['startprijs'] ?></p>
            </div>
            <a href="../../src/pages/veiling.php?ID=<?= $auction['voorwerpnummer'] ?>" class="btn btn-primary d-grid">BIEDEN</a>
        </div>
    </div>
</div>