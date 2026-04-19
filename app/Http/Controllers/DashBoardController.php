<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    /**
     * controller methord render view dashboard page.
     *
     * @return \illuminate\View\View\Factory|\Illuminate\View\View
     */
    public function board()
    {
        return view('pages.dashboard');
    }
}
