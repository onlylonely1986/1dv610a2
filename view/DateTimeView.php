<?php

class DateTimeView {

// Thursday, the 12th of September 2019, The time is 11:51:21
	public function show() {

		date_default_timezone_set("Europe/Stockholm");
		$day = Date("l");
		$date = Date("d");

		function monthName() {
			// numeric presentation of month
			$monthNum = Date("m");
			// go to string
			$monthObj = DateTime::createFromFormat('!m', $monthNum);
			$monthName = $monthObj->format('F');
			return $monthName;
		}
		
		$year = Date("20y");
		$time = Date("H:i:s");
		// obs hardcoded "tember" and "th"
		$timeString = $day . ", the " . $date . "th of " . monthName() . " " . $year . ", The time is " . $time;
		

		return '<p>' . $timeString . '</p>';
	}
}