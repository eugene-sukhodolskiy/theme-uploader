<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class template_controller extends Controller
{
    public function upload() {
    	//dd($_POST);
    	DB::table('templates')->insert(['meta_cms' => $_POST['cms'],
    	 'date_at_create' => 'NOW()',
    	  'date_of_update' => 'NOW()',
    	   'link_on_demo' => '',
    	   'name' => $_POST[''] ]);
    }
}
