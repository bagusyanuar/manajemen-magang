<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pengajuan;

class PengajuanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = Pengajuan::with(['user.peserta'])
                ->where('status', '=', 'menunggu')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.pengajuan-magang.index');
    }

    public function detail($id)
    {
        $data = Pengajuan::with(['user.peserta'])
            ->findOrFail($id);
        return view('admin.pengajuan-magang.detail')->with(['data' => $data]);
    }
}
