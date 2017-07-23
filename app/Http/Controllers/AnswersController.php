<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function  store(Request $request,$question)
    {
        dd($request->all());
    }
}
