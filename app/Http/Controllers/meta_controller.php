<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class meta_controller extends Controller
{
    public function get_browser() {
    	$browser_list = DB::table('meta')->select('meta_value')->where('meta_name', 'Browser')->get();
    	return json_encode($browser_list);
    }

    public function get_tech($cms) {
    	$tech_list = DB::table('meta')->select('meta_value')->where('meta_cms', $cms)->where('meta_name', 'tech')->get();
    	return json_encode($tech_list);
    }

    public function get_file_type() {
    	$file_type_list = DB::table('meta')->select('meta_value')->where('meta_name', 'file_type')->get();
    	return json_encode($file_type_list);
    }

    public function get_columns() {
        $colums_list = DB::table('meta')->select('meta_value')->where('meta_name', 'columns')->get();
        return json_encode($colums_list);
    }
    public function get_layout() {
        $layout_list = DB::table('meta')->select('meta_value')->where('meta_name', 'layout')->get();
        return json_encode($layout_list);
    }
    public function get_resolution() {
        $resolution_list = DB::table('meta')->select('meta_value')->where('meta_name', 'resolution')->get();
        return json_encode($resolution_list);
    }
    public function get_compatible($cms) {
        $compatible_list = DB::table('meta')->select('meta_value')->where('meta_name', 'compatible')->where('meta_cms', $cms)->get();
        return json_encode($compatible_list);
    }

    public function get_cms() {
        $cms_list = DB::table('meta')->select('meta_value')->where('meta_name', 'cms')->get();
        return json_encode($cms_list);
    }
}
