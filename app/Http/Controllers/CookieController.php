<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use App\Http\Requests\PeminjamanRequest;

class CookieController extends Controller
{
    public function store(PeminjamanRequest $request)
    {
    	$cookie = Cookie::get('data');

    	$data = json_decode($cookie);

    	if ($data) {
    		array_push($data, $request->all());
    	}
    	else{
    		$data = [$request->all()];
    	}

    	Cookie::queue('data', json_encode($data), 60);

    	return response()->json(['data'=>$data]);

    }
}
