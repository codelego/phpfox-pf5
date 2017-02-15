<form method="post">
    <input type="hidden" name="module_name" value="<?= $module_name?>" />
    <input type="hidden" name="table_name" value="<?= $table_name?>" />
    <input type="hidden" name="form_type" value="<?= $form_type?>" />
    <div class="form-group">
        <label for="form_template">Form Initialize</label>
        <textarea id="form_template" class="form-control" onclick="this.select()" name="form_template" rows="10"><?= $form_template ?></textarea>
    </div><div class="form-group">
        <label for="form_test_template">Form Initialize</label>
        <textarea id="form_test_template" class="form-control" onclick="this.select()" name="form_test_template" rows="10"><?= $form_test_template ?></textarea>
    </div>
    <div class="form-group">
        <label>Form Name (optional) </label>
        <input type="text" placeholder="=form name" name="form_name"
               value="<?= $form_name ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Namespace (optional) </label>
        <input type="text" placeholder="" name="namespace"
               value="<?= $namespace ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <button name="overwrite" value="overwrite" type="submit" class="btn btn-primary">Overwrite</button>
        <button name="rebuild" value="rebuild" type="submit" class="btn btn-danger">Re-Build</button>
        <a href="" type="submit" class="btn btn-link">Cancel</a>
    </div>
</form>