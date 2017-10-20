<?php

define('PHPFOX_NO_CACHE', 1);
define('PHPFOX_IS_DEV', false);
define('PHPFOX_ENV', 'development');
define('PHPFOX_NO_RUN',true);

date_default_timezone_set('Australia/Adelaide');

include 'vendor/autoload.php';

include __DIR__ . './../config/bootstrap.php';

Phpfox::$service->set('faker', Faker\Factory::create());

/** @var Faker\Generator $faker */
$faker  = \Phpfox::get('faker');


for($i =0; $i<10; ++$i){
    $userId  = mt_rand(1,100);
    $typeId = 'user';
    $now  = date('Y-m-d H:i:s');

    $item = new \Neutron\Blog\Model\BlogPost([
        'title'=>$faker->sentence(mt_rand(10,20)),
        'description'=>substr($faker->paragraph(3), 0,500),
        'content'=> $faker->paragraph(mt_rand(3,20)),
        'user_id'=>$userId,
        'poster_id'=>$userId,
        'poster_type'=>'user',
        'parent_id'=>$userId,
        'parent_type'=>$typeId,
        'created_at'=> $now,
        'updated_at'=>$now,
        'publish_at'=>$now,
        'is_approved'=> mt_rand(1,4) != 1?1:0,
        'is_featured'=> mt_rand(1,5) == 1?1:0,
    ]);

    $item->save();
}