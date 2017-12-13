<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class meta_controller extends Controller
{
    public function get_browser() {
    	$browser_list = DB::table('meta')->select('meta_value', 'id')->where('meta_name', 'Browser')->get();
    	return json_encode($browser_list);
    }

    public function get_tech($cms) {
    	$tech_list = DB::table('meta')->select('meta_value', 'id')->where('meta_cms', $cms)->where('meta_name', 'tech')->get();
    	return json_encode($tech_list);
    }

    public function get_file_type() {
    	$file_type_list = DB::table('meta')->select('meta_value', 'id')->where('meta_name', 'file_type')->get();
    	return json_encode($file_type_list);
    }

    public function get_columns() {
        $colums_list = DB::table('meta')->select('meta_value', 'id')->where('meta_name', 'columns')->get();
        return json_encode($colums_list);
    }
    public function get_layout() {
        $layout_list = DB::table('meta')->select('meta_value', 'id')->where('meta_name', 'layout')->get();
        return json_encode($layout_list);
    }
    public function get_resolution() {
        $resolution_list = DB::table('meta')->select('meta_value', 'id')->where('meta_name', 'resolution')->get();
        return json_encode($resolution_list);
    }
    public function get_compatible($cms) {
        $compatible_list = DB::table('meta')->select('meta_value', 'id')->where('meta_name', 'compatible')->where('meta_cms', $cms)->get();
        return json_encode($compatible_list);
    }

    public function get_cms() {
        function get_count_templates($cms_id) {
            $count_templates = DB::table('templates')->where('meta_cms', $cms_id)->count();
            return $count_templates;
        }

        $cms_list = DB::table('meta')->select('meta_value', 'id')->where('meta_name', 'cms')->get();
        // $cms_list = json_encode($cms_list);
        // $cms_list = json_decode($cms_list, false);
        $cms_list = (array)$cms_list;
        $result;
        foreach($cms_list as $key => $val){
            $result = $val;
        }
        foreach($result as $inx => $item){
            $result[$inx] = (array)$result[$inx];
            $result[$inx]['count'] = get_count_templates($result[$inx]['id']);
        }
        
        return json_encode($result);
    }
}
