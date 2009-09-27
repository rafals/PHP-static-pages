<?php

// strona umieszczona na http://a.com/
//$request = $_SERVER['REQUEST_URI'];

// strona umieszczona na http://a.com/b/c/d/
$request = str_replace('/b/c/d/', '/', $_SERVER['REQUEST_URI']);

$params = array();
$params_num = 0;

foreach(split("/", $request) as $param) {
	if($param) {
		array_push($params, $param);
		$params_num++;
	}
}

$node = 0;

function file_join($arr) {
	return join(DIRECTORY_SEPARATOR, $arr);
}

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
	$file = file_join($path).'.php';
	//echo $file;
	$node++;
	if (file_exists($file)) { include($file); } else { include('404.php'); }
}

include(file_join(array('views', 'layout.php')));

?>