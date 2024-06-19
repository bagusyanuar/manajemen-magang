<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Karyawan;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        if ($this->request->method() === 'POST') {
            return $this->confirm($data);
        }
        $mentors = User::with(['karyawan'])
            ->where('role', '=', 'karyawan')
            ->get();
        return view('admin.pengajuan-magang.detail')->with([
            'data' => $data,
            'mentors' => $mentors
        ]);
    }

    /**
     * @param Model $data
     * @return \Illuminate\Http\RedirectResponse
     */
    private function confirm($data)
    {
        try {
            DB::beginTransaction();
            $status = $this->postField('status');
            $start = $this->postField('start');
            $end = $this->postField('end');
            $reason = $this->postField('reason');
            $mentor = $this->postField('mentor');

            /** @var Model $member */
            $member = $data->user->peserta;
            $data_application = [
                'status' => $status,
                'deskripsi' => $reason
            ];

            if ($status === 'diterima') {
                $data_application['deskripsi'] = '';
            }

            $data->update($data_application);

            $data_member = [
                'tanggal_mulai' => null,
                'tanggal_selesai' => null,
                'pembimbing_id' => null,
                'is_active' => false,
                'di_terima' => false,
            ];
            if ($status === 'diterima') {
                $data_member['tanggal_mulai'] = $start;
                $data_member['tanggal_selesai'] = $end;
                $data_member['is_active'] = true;
                $data_member['di_terima'] = true;
                $data_member['pembimbing_id'] = $mentor;
            }
            $member->update($data_member);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil Melakukan Konfirmasi...');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('failed', 'terjadi kesalahan server...');
        }
    }
}
