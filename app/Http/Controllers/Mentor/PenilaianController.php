<?php


namespace App\Http\Controllers\Mentor;


use App\Helper\CustomController;
use App\Models\PesertaMagang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenilaianController extends CustomController
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
                ->where('pembimbing_id', '=', auth()->id())
                ->get();
            return $this->basicDataTables($data);
        }
        return view('Mentor.penilaian.index');
    }

    public function detail($id)
    {
        $data = PesertaMagang::with(['user.peserta.pembimbing.karyawan', 'user.pengajuan_diterima'])
            ->findOrFail($id);
        if ($this->request->method() === 'POST') {
            return $this->confirm($data);
        }
        return view('Mentor.penilaian.detail')->with([
            'data' => $data,
        ]);
    }

    /**
     * @param Model $data
     * @return \Illuminate\Http\RedirectResponse
     */
    private function confirm($data)
    {
        try {
            $score = $this->postField('score');

            $data_request = [
                'nilai' => $score
            ];
            $data->update($data_request);
            return redirect()->back()->with('success', 'Berhasil Melakukan Penilaian...');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'terjadi kesalahan server...');
        }
    }
}
