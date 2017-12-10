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

    public function get_tech() {
    	$browser_list = DB::table('meta')->select('meta_value')->where('meta_name', 'tech')->get();
    	return json_encode($browser_list);
    }

    public function get_file_type() {
    	$browser_list = DB::table('meta')->select('meta_value')->where('meta_name', 'file_type')->get();
    	return json_encode($browser_list);
    }
}
