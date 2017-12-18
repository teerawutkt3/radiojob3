<?php
namespace common\components;

class Util{
	
	public static function ViewError($param){
		echo "<pre>";
		var_dump($param);
		echo "</pre>";
		die();
		
	}
}