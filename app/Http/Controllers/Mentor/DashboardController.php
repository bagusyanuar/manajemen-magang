<?php


namespace App\Http\Controllers\Mentor;


use App\Helper\CustomController;

class DashboardController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('Mentor.dashboard');
    }
}
