<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function welcome()
    {
        $view = view('welcome');
        $view->pages = Page::all()->sortBy('position');
//        dd(json_decode(Page::first()->body));
        return $view;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = view('home');

        $view->pages = Page::all()->sortBy('position');

        return $view;
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }
}
