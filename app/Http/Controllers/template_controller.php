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
		        CURLOPT_TIMEOUT => 16, 
		        CURLOPT_POSTFIELDS => http_build_query($post) 
		    ); 

		    $ch = curl_init(); 
		    curl_setopt_array($ch, ($options + $defaults)); 
		    if( ! $result = curl_exec($ch)) 
		    { 
		        //trigger_error(curl_error($ch)); 
		        return false;
		    } 
		    curl_close($ch); 
		    return $result; 
		} 

    	$data = json_decode(Input::get('data'), true);

    	// file_put_contents('log.txt', json_encode($data));

    	$cmsname = DB::table('meta') -> select('meta_value') -> where('id', $data['cms']) -> get();
    	$cmsname = $cmsname[0] -> meta_value;


  //   	if(strstr($data['zip'], 'data:application/octet-stream;base64,')){
	 //    	$data['zip'] = explode('data:application/octet-stream;base64,', $data['zip']);	
		// 	$data['zip'] = $data['zip'][1];
		// }else{
		// 	$data['zip'] = explode('data:application/zip;base64,', $data['zip']);	
		// 	$data['zip'] = $data['zip'][1];
		// }

    	// $response = curl_post('http://wp.wection.site/upload-and-demo.php', [
    	// 	'cms_name' => $cmsname,
    	// 	'theme_name' => $data['template_name'],
    	// 	'url' => 'http://wp.wection.site',
    	// 	'zip' => $data['zip']
    	// ]);

    	// file_put_contents('response.txt', $response);
    	
    	// $response = json_decode($response, true);
   //  	if(!isset($response['demo_url']) || $response['demo_url'] == ''){
   //  		$temp_name = md5($data['template_name']);
	 	// 	if(strtolower($cmsname) == 'wordpress'){
			// 	$response['demo-url'] = 'http://wp.wection.site/?themedemo=' . $temp_name;
			// }
   //  	}

    	// INSERT TO DB
    	$template_id = DB::table('templates')->insertGetId([
			'meta_cms' => $data['cms'],
			'date_at_create' => date('Y-m-d H:i:s'),
			'date_of_update' => date('Y-m-d H:i:s'),
			'link_on_demo' => $data['link_on_demo'],
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
    	return $this -> template($cms_id);
    }

    public function templateListWithOrder($cms_id, $order){
        return $this -> template($cms_id, $order);
    }

    public function template($cms_id, $order = NULL, $s = NULL){
        if($order == NULL){
            if($s == NULL){
                $templates = DB::table('templates') -> select('*') -> where('meta_cms', $cms_id) -> get();
            }else{
                $templates = DB::table('templates') -> select('*') -> where('meta_cms', $cms_id) -> where('name', 'like', '%' . $s . '%') -> get();
            }
        }else{
            if($s == NULL){
                $templates = DB::table('templates') -> orderBy($order) -> select('*') -> where('meta_cms', $cms_id) -> get();
            }else{
                $templates = DB::table('templates') -> orderBy($order) -> select('*') -> where('meta_cms', $cms_id) -> where('name', 'like', '%' . $s . '%') -> get();
            }
        }
        $data = ['templates' => $templates];
        $thumbs = [];
        foreach($templates as $item => $template){
            // return json_encode($template -> id);
            $thumbs[] = DB::table('thumbnails') -> select('*') -> where('template_id', $template -> id) -> first();
        }
        $data['thumbs'] = $thumbs;
        return json_encode($data);
    }

    public function search($cms_id, $s){
        return $this -> template($cms_id, NULL, $s);
    }

    public function searchWithOrder($cms_id, $order, $s){
        return $this -> template($cms_id, $order, $s);
    }

    public function isLinkOnDemoUniq(){
        $link = Input::get('link');
        $link = addslashes($link);
        $res = DB::table('templates') -> where('link_on_demo', $link) -> count();
        return json_encode($res);
    }

    public function getTemplateOnLink(){
    	// $link = json_decode($link, true);
    	// $link = $link['link'];
    	$link = Input::get('link');
        $link = addslashes($link);
    	$template = DB::table('templates') -> select('*') -> where('link_on_demo', $link) -> first();
    	$thumbs = DB::table('thumbnails') -> select('*') -> where('template_id', $template -> id) -> get();
    	return json_encode(['template' => $template, 'thumbs' => $thumbs]);
    }

    public function incrementVisibleCounter(){
        $link = Input::get('link');
        $link = addslashes($link);
        $res = DB::table('templates') -> select('id', 'visible_counter') -> where('link_on_demo', $link) -> first();
        DB::table('templates') -> where('id', $res -> id) -> update(['visible_counter' => $res -> visible_counter + 1]);
    }

}
