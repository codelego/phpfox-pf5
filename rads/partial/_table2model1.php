<form class="form" method="post" action="table2model2.php">
    <div class="form-group">
        <label>
            Module Name
        </label>
        <select name="module_name" class="form-control" size="5">
            <?php foreach ($packages as $package): ?>
                <option value="<?= $package ?>" <?php if ($package
                    == $module_name
                ) {
                    echo 'selected';
                } ?> > <?= $package ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>
            Table Name
        </label>
        <select name="table_name" class="form-control" size="5">
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table ?>" <?php if ($table == $table_name) {
                    echo 'selected';
                } ?>> <?= $table ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>
            Model Id (optional)
        </label>
        <input placeholder="= table name" type="text" name="model_id"
               value="<?= $model_id ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Model Name (optional) </label>
        <input type="text" placeholder="=table name" name="model_name"
               value="<?= $model_name ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Namespace (optional) </label>
        <input type="text" placeholder="" name="namespace"
               value="<?= $namespace ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <button class="btn btn-submit" type="submit">Submit</button>
        <a class="btn btn-link" href="table2model1.php">Others</a>
    </div>
</form>