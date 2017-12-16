<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class template_controller extends Controller
{
    public function upload() {

    	function curl_post($url, array $post = NULL, array $options = array()) { 
		    $defaults = array( 
		        CURLOPT_POST => 1, 
		        CURLOPT_HEADER => 0, 
		        CURLOPT_URL => $url, 
		        CURLOPT_FRESH_CONNECT => 1, 
		        CURLOPT_RETURNTRANSFER => 1, 
		        CURLOPT_FORBID_REUSE => 1, 
		        CURLOPT_TIMEOUT => 4, 
		        CURLOPT_POSTFIELDS => http_build_query($post) 
		    ); 

		    $ch = curl_init(); 
		    curl_setopt_array($ch, ($options + $defaults)); 
		    if( ! $result = curl_exec($ch)) 
		    { 
		        trigger_error(curl_error($ch)); 
		    } 
		    curl_close($ch); 
		    return $result; 
		} 

    	$data = json_decode(Input::get('data'), true);

    	$cmsname = DB::table('meta') -> select('meta_value') -> where('id', $data['cms']) -> get();
    	$cmsname = $cmsname[0] -> meta_value;

    	$data['zip'] = explode('data:application/zip;base64,', $data['zip']);	
		$data['zip'] = $data['zip'][1];

    	$response = curl_post('http://wp/upload-and-demo.php', [
    		'cms_name' => $cmsname,
    		'theme_name' => $data['template_name'],
    		'url' => 'http://wp',
    		'zip' => $data['zip']
    	]);

    	$response = json_decode($response, true);

    	// INSERT TO DB
    	$template_id = DB::table('templates')->insertGetId([
			'meta_cms' => $data['cms'],
			'date_at_create' => date('Y-m-d H:i:s'),
			'date_of_update' => date('Y-m-d H:i:s'),
			'link_on_demo' => $response['demo-url'],
			'name' => $data['template_name'],
			'meta_browsers' => json_encode($data['compatible-browsers']),
			'meta_tech' => json_encode($data['compatible-with']),
			'meta_file_type' => json_encode($data['file_type']),
			'count_column' => $data['column'],
			'meta_layout' => $data['layout'],
			'description' => $data['description']
    	]);

    	foreach($data['keywords'] as $i => $keyword){
    		DB::table('keywords') -> insert([
    			'template_id' => $template_id,
    			'key_name' => $keyword
    		]);
    	}

    	foreach($data['thumbnails'] as $i => $thumb){
    		DB::table('thumbnails') -> insert([
    			'template_id' => $template_id,
    			'src' => $thumb,
    			'item_index' => $i
    		]);
    	}

    	return 'true';
    }

    public function templateList($cms_id){
    	$templates = DB::table('templates') -> select('*') -> where('meta_cms', $cms_id) -> get();
    	$data = ['templates' => $templates];
    	$thumbs = [];
    	foreach($templates as $item => $template){
    		// return json_encode($template -> id);
    		$thumbs[] = DB::table('thumbnails') -> select('*') -> where('template_id', $template -> id) -> first();
    	}
    	$data['thumbs'] = $thumbs;
    	return json_encode($data);
    }
}
