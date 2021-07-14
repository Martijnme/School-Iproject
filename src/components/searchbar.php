<form method="POST" action='../../src/functions/zoeken.php'>
    <div class="col-12">
        <!-- <div class="form-group mb-3" style="margin-top: 20px;"> -->
        <div class="col-12 input-group pl-0 pr-0 pt-3 pb-3">
            <input class="form-control" list="datalistOptions" name="rubriek" placeholder="Zoek naar veilingen..." required>
            <input type="submit" class="btn btn-primary" value="ZOEKEN">
                 <datalist id="datalistOptions">
                    <?php foreach($rubriek as $r) { ?>
                    <option value="<?=$r['rubrieknaam']?>">
                    <?php } ?>
                </datalist>
                
        </div>
    </div>
</form>
