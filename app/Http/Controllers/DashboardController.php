<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show the single-page dashboard used to manage the library.
     */
    public function __invoke(): View
    {
        return view('dashboard');
    }
}
