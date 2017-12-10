<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class site extends Controller
{
    public function run_site() {
    	return view('site.index.blade.php');
    }
}
