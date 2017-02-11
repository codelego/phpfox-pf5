<?php

include '../config/bootstrap.php';

$packages = array_map(function ($item) {
    return str_replace('package/', '', $item['path']);
}, Phpfox::get('db')
    ->select('*')
    ->from(':core_package')
    ->order('package_name',1)
    ->all());

$tables = array_map(function ($item) {
    return str_replace(PHPFOX_TABLE_PREFIX, '', $item);
}, Phpfox::get('db')->tables());


$table_name = isset($_REQUEST['table_name'])?$_REQUEST['table_name']: null;
$module_name = isset($_REQUEST['module_name'])?$_REQUEST['module_name']: null;
$model_id = isset($_REQUEST['model_id'])?$_REQUEST['model_id']: null;
$model_name = isset($_REQUEST['model_name'])?$_REQUEST['model_name']: null;

?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Convert Table To Model</h1>
</div>
<div class="container">
    <form class="form" method="post" action="table2model2.php">
        <div class="form-group">
            <label>
                Module Name
            </label>
            <select name="module_name" class="form-control" size="5">
                <?php foreach ($packages as $package): ?>
                    <option value="<?= $package ?>" <?php if($package == $module_name) echo 'selected';?> > <?= $package ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>
                Table Name
            </label>
            <select name="table_name" class="form-control" size="5">
                <?php foreach ($tables as $table): ?>
                    <option value="<?= $table ?>" <?php if($table == $table_name) echo 'selected';?>> <?= $table ?></option>
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
            <button class="btn btn-submit" type="submit">Submit</button>
            <a class="btn btn-link" href="table2model1.php">Others</a>
        </div>
    </form>
</div>
</body>
</html>