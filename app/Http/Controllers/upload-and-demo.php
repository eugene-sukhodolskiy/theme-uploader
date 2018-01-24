<?php

/**
 * [unzipToThemesDir unzip template zip file to dir with tempates]
 * @param  [string] $pathToZIP [path to ZIP]
 * @param  [string] $pathToTemplates [path to templates dir]
 * @return [bool]       [true or false]
 */
function unzipToThemesDir($pathToZIP, $pathToTemplates, $theme_name){
	@mkdir($pathToTemplates . $theme_name, 0777);

	$zip = new ZipArchive;
	if ($zip->open($pathToZIP) === TRUE) {
	    $zip->extractTo($pathToTemplates . $theme_name);
	    $zip->close();
	    return true;
	} else {
	    return false;
	}
}

/**
 * [getPathToThemes get path to dir with templates]
 * @param  [string] $cms_name [cms name]
 * @return [string]           [path]
 */
function getPathToThemes($cms_name){
	$name = strtolower($cms_name);
	$path = [
		'wordpress' => 'wp-content/themes/'
	];

	return $path[$name];
}


/**
 * [getPathToOurTemplate create path to ZIP]
 * @param  [string] $path [path to template dir]
 * @param  [string] $name [theme name]
 * @return [string]       [path To ZIP]
 */
function getPathToOurZIP($path, $name){
	$name = strtolower($name);
	$name = explode(' ', $name);
	$name = implode('', $name);

	return $path . $name . '.zip';
}

/**
 * [createZIPfile Create zip archive from base64]
 * @param  [string] $base64 [zip file in base64]
 * @param  [string] $path   [path to template]
 * @return [bool]         [true of false]
 */
function createZIPfile($base64, $path){
	$zip = base64_decode($base64);
	
	if(!file_put_contents($path, $zip, FILE_BINARY)){
		return false;
	}

	return true;
}

function getDemoLink($url, $theme_name, $cms_name){
	$cms_name = strtolower($cms_name);
	if($cms_name == 'wordpress'){
		$link = $url . '/?themedemo=' . $theme_name;
	}

	return $link;
}

function getThemeName($theme_name){
	// $theme_name = strtolower($theme_name);
	// $theme_name = explode(' ', $theme_name);
	// $theme_name = implode('', $theme_name);
	return md5($theme_name);
}

/**
 * [run script and display json response]
 */
function run(){

	// file_put_contents('response_.txt', 'work');
	$path = getPathToThemes($_POST['cms_name']);
	$theme_name = getThemeName($_POST['theme_name']);
	$pathToZIP = getPathToOurZIP($path, $theme_name);

	file_put_contents('vars.txt', json_encode(['pathToZIP' => $pathToZIP, 'pathToTemplates' => $path, 'theme-name' => $theme_name]));
	
	$result = ['err-flag' => false];
	if(!createZIPfile($_POST['zip'], $pathToZIP)){
		$result['err'] = 'Could not create ZIP';
		$result['err-flag'] = true;
	}

	if(!unzipToThemesDir($pathToZIP, $path, $theme_name)){
		$result['err'] = 'Could not unpackege ZIP';
		$result['err-flag'] = true;
	}

	$result['demo-url'] = getDemoLink($_POST['url'], $theme_name, $_POST['cms_name']);

	// response
	$response = json_encode($result);
	file_put_contents('response.txt', $response);
	echo($response);
}

run();