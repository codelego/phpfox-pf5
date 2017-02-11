<?php
include 'init.php';

$result = '';
$shorten = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = json_decode($_REQUEST['json'], true);
    if (!empty($_REQUEST['shorten']) and $_REQUEST['shorten']) {
        $shorten = true;
        if (isset($result['data']) && is_array($result['data'])) {
            $result = $result['data'];
        }

        if (isset($result[0]) and is_array($result[0])) {
            $result = $result[0];
        }
    }
    $result = var_export($result, true);
}

_rad_view_page('partial/_json2array.php', [
    'heading' => 'Convert Json String To PHP Array',
    'result'=> $result,
    'shorten'=> $shorten,
]);