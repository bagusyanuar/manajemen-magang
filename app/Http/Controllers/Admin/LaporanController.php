<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\PesertaMagang;

class LaporanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function laporan_peserta()
    {
        if ($this->request->ajax()) {
            $status = $this->field('status');

            $query = PesertaMagang::with(['user.peserta.pembimbing.karyawan'])
                ->where('di_terima', '=', 1);

            if ($status === '1') {
                $query->where('is_active', '=', 1);
            }

            if ($status === '2') {
                $query->where('is_active', '=', 0);
            }
            $data = $query->get();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.peserta');
    }
}
