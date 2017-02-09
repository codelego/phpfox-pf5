<?php

$string  = '{
			"id": "$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e",
			"user_id": 12,
			"updated": 1477389808,
			"lifetime": 1
		}';

$obj = json_decode($string,true);

echo var_export($obj);