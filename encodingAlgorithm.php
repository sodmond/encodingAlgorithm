<?php

//Offset Algorithm

$intVal = 		"a";
$offsetNum = 	26;
$char_list = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$_offset = strpos($char_list, $intVal) + $offsetNum;

echo "Characters list :- ".$char_list."<hr>";
echo "Initial value is $intVal";
echo "<br>";
echo "Offset number is $offsetNum";
echo "<br>";
echo "Offset value is ".$char_list[$_offset];

?>