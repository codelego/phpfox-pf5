<?php

include 'init.php';

$mn = new \Phpfox\Db\DbTableGatewayFactory();

$table = 'announcement';

$rows = \Phpfox::db()
    ->execute('describe ' . PHPFOX_TABLE_PREFIX . $table)
    ->all();

$column = [];
$primary = [];
$identity = null;
$queryId = null;

foreach ($rows as $row) {
    $type = strtolower($row['Type']);
    $name = $row['Field'];
    $factory = 'text';

    if (strtolower($row['Key']) == 'pri') {
        $primary[$row['Field']] = 1;
    }

    if (strtolower($row['Extra']) == 'auto_increment') {
        $identity = $row['Field'];
    }

    if (strpos($type, 'text') !== false) {
        $factory = 'textarea';
    }

    $attributes = ['maxlength' => 40, 'class' => 'form-control'];
    $label = ucwords(implode(' ', explode('_', $name)));

    $info = [
        'factory'  => $factory,
        'name'     => $name,
        'label'    => '$$$_text($$' . $label . '$$)$$$',
        'required' => $row['Null'] == 'NO' ? '$$$true$$$' : '$$$false$$$',
    ];

    if (substr($name, 0, 3) == 'is_') {
        $info['factory'] = 'yesno';
        $info['value'] = 1;
    }

    $info['attributes'] = $attributes;
    $column[$name] = $info;
}

$response = [];
foreach ($column as $name => $info) {

    if (in_array($name, [
        'created_at',
        'updated_at',
        'user_id',
        'parent_id',
        'parent_type',
        'poster_id',
        'poster_type',
    ])) {
        continue;
    }
    $response[$name] = strtr(_sprintf('$this->addElement({info});', [
        'info' => var_export($info, true),
    ]), ['\'$$$' => '', '$$$\'' => '', '$$' => '\'']);
}

header('content-type: text/plain');
echo implode(PHP_EOL, $response);