<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\PesertaMagang;

class KuotaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = PesertaMagang::with(['user'])
            ->where('is_active','=',1)
            ->get();
        return view('kuota')->with([
            'data' => $data
        ]);
    }
}
