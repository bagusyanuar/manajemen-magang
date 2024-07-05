<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pengajuan;
use App\Models\PesertaMagang;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

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
        if ($this->request->method() === 'POST' && $this->request->ajax()) {
            return $this->confirm_finish($data);
        }
        return view('admin.peserta-magang.detail')->with([
            'data' => $data,
        ]);
    }

    /**
     * @param Model $data
     * @return \Illuminate\Http\JsonResponse
     */
    private function confirm_finish($data)
    {
        try {
            $data->update([
                'is_active' => false
            ]);
            return $this->jsonSuccessResponse('Berhasil melakukan konfirmasi.');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse('terjadi kesalahan server...');
        }
    }
}
