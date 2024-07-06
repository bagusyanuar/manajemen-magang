<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kegiatan;
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

    public function laporan_peserta_cetak()
    {
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
        return $this->convertToPdf('admin.laporan.cetak-peserta', [
            'data' => $data,
        ]);
    }

    public function laporan_kegiatan()
    {
        if ($this->request->ajax()) {
            $start = $this->field('start');
            $end = $this->field('end');
            $query = Kegiatan::with(['user.peserta'])
                ->whereBetween('tanggal', [$start, $end]);

            $data = $query->get();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.kegiatan');
    }

    public function laporan_kegiatan_cetak()
    {
        $start = $this->field('start');
        $end = $this->field('end');
        $query = Kegiatan::with(['user.peserta'])
            ->whereBetween('tanggal', [$start, $end]);

        $data = $query->get();
        return $this->convertToPdf('admin.laporan.cetak-kegiatan', [
            'data' => $data,
            'start' => $start,
            'end' => $end
        ]);
    }


}
