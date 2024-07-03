<?php


namespace App\Http\Controllers\Peserta;


use App\Helper\CustomController;
use App\Models\Karyawan;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $data = Kegiatan::with(['user'])
                ->get();
            return $this->basicDataTables($data);
        }
        return view('peserta.kegiatan.index');
    }

    public function add()
    {
        if ($this->request->method() === 'POST') {
            return $this->store();
        }
        return view('peserta.kegiatan.add');
    }

    public function delete($id)
    {
        try {
            Kegiatan::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    private $rule = [
        'date' => 'required',
        'activity' => 'required',
    ];

    private $message = [
        'date.required' => 'kolom tanggal wajib diisi',
        'activity.required' => 'kolom kegiatan wajib diisi',
    ];

    private function store()
    {
        try {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'Harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }
            $data_request = [
                'user_id' => auth()->id(),
                'tanggal' => $this->postField('date'),
                'kegiatan' => $this->postField('activity'),
            ];
            Kegiatan::create($data_request);
            return redirect()->back()->with('success', 'Berhasil menyimpan data karyawan...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }
}
