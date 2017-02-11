<div class="form-group">
    <label>Model Class</label>
    <textarea class="form-control" rows="10" cols="80"
              ><?= $classTemplate ?></textarea>
</div>
<div class="form-group">
    <label>Test.php Template</label>
    <textarea class="form-control" rows="10" cols="80"
              onclick="this.select()"><?= $testTemplate ?></textarea>
</div>
<div class="form-group">
    <label>Config Template</label>
    <textarea class="form-control" rows="10" cols="80"
              onclick="this.select()"><?= $configTemplate ?></textarea>
</div>
<div class="form-group">
    <a class="btn btn-danger" href="table2model1.php?<?= $configure_url ?>">Re Configure</a>
    <a class="btn btn-link" href="table2model1.php">Others</a>
</div>