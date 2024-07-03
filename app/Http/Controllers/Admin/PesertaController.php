<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pengajuan;
use App\Models\PesertaMagang;
use App\Models\User;

class PesertaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = PesertaMagang::with(['user.peserta.pembimbing.karyawan'])
                ->where('is_active', '=', 1)
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.peserta-magang.index');
    }

    public function detail($id)
    {
        $data = PesertaMagang::with(['user.peserta.pembimbing.karyawan', 'user.pengajuan_diterima'])
            ->findOrFail($id);
        return view('admin.peserta-magang.detail')->with([
            'data' => $data,
        ]);
    }
}
