<form method="post">
    <input type="hidden" name="configure_url" value="<?= $configure_url?>"/>
    <input type="hidden" name="model_path" value="<?= $model_path?>"/>
    <input type="hidden" name="test_path" value="<?= $test_path?>"/>
    <div class="form-group">
        <label>Model Class</label>
        <textarea name="template_model" class="form-control" rows="10" cols="80"><?= $classTemplate ?></textarea>
    </div>
    <div class="form-group">
        <label>Test.php Template</label>
        <textarea name="template_test" class="form-control" rows="10" cols="80"
                  onclick="this.select()"><?= $testTemplate ?></textarea>
    </div>
    <div class="form-group">
        <label>Config Template</label>
        <textarea name="template_config" class="form-control" rows="10" cols="80"
                  onclick="this.select()"><?= $configTemplate ?></textarea>
    </div>
    <div class="form-group">
        <label>Path</label>
        <input type="text" class="form-control" name="module_path"  value="<?= $module_path?>">
    </div>
    <div class="form-group">
        <button name="overwrite" type="submit" value="overwrite" class="btn btn-primary">Overwrite</button>
        <a class="btn btn-danger" href="table2model1.php?<?= $configure_url ?>">Re Configure</a>
        <a class="btn btn-link" href="table2model1.php">Others</a>
    </div>
</form>