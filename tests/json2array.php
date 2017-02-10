<?php
$result  = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $result =  json_decode($_REQUEST['json'], true);
    if(isset($result['data']) && is_array($result['data'])){
        $result = $result['data'];
    }

    if(isset($result[0]) and is_array($result[0])){
        $result = $result[0];
    }

    $result= var_export($result,true);
} ?>
<form method="post">
    <div>
        <textarea rows="5" cols="60"
                  name="json"><?= @$_REQUEST['json'] ?></textarea>
    </div>
    <div>
        <button type="submit">Convert To Array</button>
    </div>
    <div>
        <?= $result?>
    </div>
</form>
