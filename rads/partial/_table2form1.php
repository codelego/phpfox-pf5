<form method="post">
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
        <label>Table Name</label>
        <select name="table_name" class="form-control" size="5">
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table ?>" <?php if ($table == $table_name) {
                    echo 'selected';
                } ?>> <?= $table ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Form Type</label>
        <select name="form_type" class="form-control" size="5">
            <?php foreach ($form_types as $type): ?>
                <option value="<?= $type ?>" <?php if ($type == $form_type) {
                    echo 'selected';
                } ?>> <?= $type ?></option>
            <?php endforeach; ?>
        </select>
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
        <button type="submit" class="btn btn-primary">Continue</button>
        <a href="" class="btn btn-link">Cancel</a>
    </div>
</form>