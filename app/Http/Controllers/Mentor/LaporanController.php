<?php


namespace App\Http\Controllers\Mentor;


use App\Helper\CustomController;
use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Builder;

class LaporanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function laporan_kegiatan()
    {
        if ($this->request->ajax()) {
            $start = $this->field('start');
            $end = $this->field('end');
            $query = Kegiatan::with(['user.peserta'])
                ->whereHas('user.peserta', function ($q) {
                        /** @var Builder $q */
                    return $q->where('pembimbing_id', '=', auth()->id());
                })
                ->whereBetween('tanggal', [$start, $end]);

            $data = $query->get();
            return $this->basicDataTables($data);
        }
        return view('Mentor.laporan.kegiatan');
    }

    public function laporan_kegiatan_cetak()
    {
        $start = $this->field('start');
        $end = $this->field('end');
        $query = Kegiatan::with(['user.peserta'])
            ->whereHas('user.peserta', function ($q) {
                /** @var Builder $q */
                return $q->where('pembimbing_id', '=', auth()->id());
            })
            ->whereBetween('tanggal', [$start, $end]);

        $data = $query->get();
        return $this->convertToPdf('Mentor.laporan.cetak-kegiatan', [
            'data' => $data,
            'start' => $start,
            'end' => $end
        ]);
    }
}

