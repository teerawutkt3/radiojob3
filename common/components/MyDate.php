<?php

namespace common\components;

class MyDate {
	const ThMonths = [ 
			"ม.ค.",
			"ก.พ.",
			"มี.ค.",
			"เม.ย.",
			"พ.ค.",
			"มิ.ย.",
			"ก.ค.",
			"ส.ค.",
			"ก.ย.",
			"ต.ค.",
			"พ.ย.",
			"ธ.ค." 
	];
	const fullThMonths = [ 
			"มกราคม",
			"กุมภาพันธ์",
			"มีนาคม",
			"เมษายน",
			"พฤษภาคม",
			"มิถุนายน",
			"กรกฎาคม",
			"สิงหาคม",
			"กันยายน",
			"ตุลาคม",
			"พฤศจิกายน",
			"ธันวาคม" 
	];
	public static function ST($month) {
		return array_search ( $month, self::ThMonths ) + 1;
	}
	public static function FST($date, $delimiter = " ", $isBE = true) {
		$d = explode ( $delimiter, $date );
		return $d [0] . "-" . (array_search ( $d [1], self::ThMonths ) + 1) . "-" . ($d [2] - ($isBE ? 543 : 0));
	}
	
	public static function TimeDigit2int($date, $delimiter = " ", $isBE = true) {
		if ($delimiter == " ")
			$d = preg_split ( '/\s+/', $date );
			else
				$d = explode ( $delimiter, $date );
				
				if (sizeof ( $d ) > 3)
					$time = $d [3];
					else
						$time = "";
						return date ( "U", strtotime ( $d [0] . "-" . $d[1]. "-" . ($d [2] - ($isBE ? 543 : 0)) . " " . $time ) );
	}
	
	public static function T2int($date, $delimiter = " ", $isBE = true) {
		if ($delimiter == " ")
			$d = preg_split ( '/\s+/', $date );
		else
			$d = explode ( $delimiter, $date );
		
		if (sizeof ( $d ) > 3)
			$time = $d [3];
		else
			$time = "";
		$dt =  date ( "U", strtotime ( $d [0] . "-" . (array_search ( $d [1], self::ThMonths ) + 1) . "-" . ($d [2] - ($isBE ? 543 : 0)) . " " . $time ) );
		die(" dt ".$dt);
		return $dt;
	}
	
	public static function Time2int($time, $delimiter = " ", $isBE = true) {
	                    $dt =  date ( "U", strtotime ( $time ) );
	                    return $dt;
	}
}