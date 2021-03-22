<?php
$time = date("Y-m-d H:i", time());
$log = $e->getMessage()." in ".$e->getFile()." on line ".$e->getLine();
$contents = "$time\t$log\r";

file_put_contents($file, $contents, FILE_APPEND);
