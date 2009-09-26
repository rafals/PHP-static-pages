<?php

$request = $_SERVER['REQUEST_URI'];
$params = array();
$params_num = 0;

foreach(split("/", $request) as $param) {
	if($param) {
		array_push($params, $param);
		$params_num++;
	}
}

$node = 0;

function content($view = 'index') {
	global $node;
	global $params_num;
	global $params;
	//echo 'n'.$node.' pn'.$params_num;
	$path = array('views');
	for ($i = 0; $i <= $node; $i++){
		//echo ' i'.$i;
		if (isset($params[$i])) {
			array_push($path,$params[$i]);
		} else if ($i == $params_num) {
			array_push($path,$view);
		} else {
			$path = array('404');
		}
	}
	$file = join('/', $path).'.php';
	//echo $file;
	$node++;
	if (file_exists($file)) { include($file); } else { include('404.php'); }
}

include('views/layout.php');

?>