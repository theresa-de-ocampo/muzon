<?php
function convert_to_long_date_time($date_time) {
	$time_stamp = strtotime($date_time);
	$formatted_date = date("M. j, Y \\a\\t g:i A", $time_stamp);
	if (strpos($formatted_date, "May") !== false)
		$formatted_date = str_replace(".", "", $formatted_date);
	return $formatted_date;
}
