<?php


namespace App\Http\Controllers\Peserta;


use App\Helper\CustomController;
use App\Models\Karyawan;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

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
                ->where('user_id', '=', auth()->id())
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

            if ($this->request->hasFile('file')) {
                $file = $this->request->file('file');
                $extension = $file->getClientOriginalExtension();
                $document = Uuid::uuid4()->toString() . '.' . $extension;
                $storage_path = public_path('assets/kegiatan');
                $documentName = $storage_path . '/' . $document;
                $data_request['file'] = '/assets/kegiatan/' . $document;
                $file->move($storage_path, $documentName);
            }
            Kegiatan::create($data_request);
            return redirect()->back()->with('success', 'Berhasil menyimpan data kegiatan...');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', 'terjadi kesalahan server...');
        }
    }

    public function pdf()
    {
        $start = $this->field('start');
        $end = $this->field('end');
        $query = Kegiatan::with([])
            ->where('user_id','=', auth()->id());

        $data = $query->get();
        return $this->convertToPdf('peserta.kegiatan.cetak', [
            'data' => $data,
            'start' => $start,
            'end' => $end
        ]);
    }
}
