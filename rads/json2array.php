<?php
$result = '';
$shorten = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = json_decode($_REQUEST['json'], true);
    if(!empty($_REQUEST['shorten']) and $_REQUEST['shorten']){
        $shorten = true;
        if(isset($result['data']) && is_array($result['data'])){
            $result = $result['data'];
        }

        if(isset($result[0]) and is_array($result[0])){
            $result = $result[0];
        }
    }
    $result = var_export($result, true);
} ?>

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
    <title>Convert Json String To PHP Array</title>
</head>
<body>
<div class="container">
    <h1>Convert Json String To PHP Array</h1>
</div>
<div class="container">
    <form method="post">
        <div class="form-group">
            <label>Input</label>
            <textarea class="form-control" rows="5"
                      onclick="this.select()"
                      name="json"><?= @$_REQUEST['json'] ?></textarea>
        </div>
        <div class="form-group">
            <label>Output</label>
            <textarea name="result" onclick="this.select()" rows="5"
                      class="form-control"><?= $result ?></textarea>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="shorten"
                              value="1" <?php if($shorten) echo 'checked' ?>>Shorten data</label>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Convert</button>
            <a href="?" class="btn btn-info">Reset</a>
        </div>
    </form>
</div>
</body>