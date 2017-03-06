<?php

//$url = 'http://qctest.phpfox.net/fox4.5/PF.Base/file/pic/photo/2017/02/7ba3dc088da833c0426be8ba047463e3.jpg?t=58a6b76475b6d';
//
//file_put_contents(__DIR__.'/assets/example.jpg',file_get_contents($url));


$filename =__DIR__.'/assets/example.jpg';

$exif = @read_exif_data($filename);

var_dump($exif);