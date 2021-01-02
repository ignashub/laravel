<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function index()
    {
        $title = 'MyFirstApp';

        return view("app", compact('title'));
    }
    public function recipes()
    {
        $recipes = [];
        return view("recipes", compact('recipes'));
    }
    public function overview()
    {
        return view("overview");
    }
}
