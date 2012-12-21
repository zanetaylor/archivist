<?php
//SLIM
require 'Slim/Slim.php';
require 'Views/TwigView.php';

//CONFIG
TwigView::$twigDirectory =	__DIR__	. '/Twig/lib/Twig';

//START
$app = new Slim(array(
	'view' => new TwigView
));

//ROUTES
//home
$app->get('/', function() use ($app){
	//echo 'Welcome to Missive.';
	return $app->render('home.html');
});
$app->get('/collection/', function() use ($app){
	
});
//popular
$app->get('/popular', function() use ($app){
	return $app->render('popular.html', array(
		//'items' => $data->response->docs,
		'title' => 'Popular Selections'
	));
});
//video
$app->get('/video', function() use ($app){
	$url = 'http://www.archive.org/advancedsearch.php?q=mediatype%3Avideo&fl%5B%5D=avg_rating&fl%5B%5D=call_number&fl%5B%5D=collection&fl%5B%5D=contributor&fl%5B%5D=coverage&fl%5B%5D=creator&fl%5B%5D=date&fl%5B%5D=description&fl%5B%5D=downloads&fl%5B%5D=foldoutcount&fl%5B%5D=format&fl%5B%5D=headerImage&fl%5B%5D=identifier&fl%5B%5D=imagecount&fl%5B%5D=language&fl%5B%5D=licenseurl&fl%5B%5D=mediatype&fl%5B%5D=month&fl%5B%5D=num_reviews&fl%5B%5D=oai_updatedate&fl%5B%5D=publicdate&fl%5B%5D=publisher&fl%5B%5D=rights&fl%5B%5D=scanningcentre&fl%5B%5D=source&fl%5B%5D=subject&fl%5B%5D=title&fl%5B%5D=type&fl%5B%5D=volume&fl%5B%5D=week&fl%5B%5D=year&sort%5B%5D=&sort%5B%5D=&sort%5B%5D=&rows=50&page=1&output=json';
	
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($client);
	curl_close($client);
	
	$data = json_decode($response);
	//echo var_dump($data->response->docs);
	return $app->render('section.html', array(
		'items' => $data->response->docs,
		'title' => 'Videos & Moving Images'
	));
});
//audio
$app->get('/audio', function() use ($app){
	$url = 'http://www.archive.org/advancedsearch.php?q=mediatype%3Aaudio&fl%5B%5D=avg_rating&fl%5B%5D=call_number&fl%5B%5D=collection&fl%5B%5D=contributor&fl%5B%5D=coverage&fl%5B%5D=creator&fl%5B%5D=date&fl%5B%5D=description&fl%5B%5D=downloads&fl%5B%5D=foldoutcount&fl%5B%5D=format&fl%5B%5D=headerImage&fl%5B%5D=identifier&fl%5B%5D=imagecount&fl%5B%5D=language&fl%5B%5D=licenseurl&fl%5B%5D=mediatype&fl%5B%5D=month&fl%5B%5D=num_reviews&fl%5B%5D=oai_updatedate&fl%5B%5D=publicdate&fl%5B%5D=publisher&fl%5B%5D=rights&fl%5B%5D=scanningcentre&fl%5B%5D=source&fl%5B%5D=subject&fl%5B%5D=title&fl%5B%5D=type&fl%5B%5D=volume&fl%5B%5D=week&fl%5B%5D=year&sort%5B%5D=&sort%5B%5D=&sort%5B%5D=&rows=50&page=1&output=json';
	
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($client);
	curl_close($client);
	
	$data = json_decode($response);
	//echo var_dump($data->response->docs);
	return $app->render('section.html', array('items' => $data->response->docs, 'title' => 'Audio, Music, & Sounds'));
});
//deets
$app->get('/view/(:id)', function($id) use ($app){
	$url = 'http://www.archive.org/details/'
		. $id
		. '&output=json';
	
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($client);
	curl_close($client);
	$data = json_decode($response);
	
	$files = (array) $data->files;
	$filenames = array_keys($files);
	
	if (!is_null($data)) {
		return $app->render('details.html', array('item' => $data, 'files' => $files, 'filenames' => $filenames));
	} else {
		echo 'error!';
	}
});
//admin
$app->get('/admin', function() use ($app){
	
});

//go
$app->run();
?>