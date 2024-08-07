<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Pengajuan;
use App\Models\PesertaMagang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

class RegisterController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        if ($this->request->method() === 'POST') {
            DB::beginTransaction();
            try {
                $email = $this->postField('email');
                $username = $this->postField('username');
                $password = Hash::make($this->postField('password'));
                $role = 'peserta';
                $name = $this->postField('name');
                $phone = $this->postField('phone');
                $address = $this->postField('address');
                $institute = $this->postField('institute');

                $data_account = [
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'role' => $role,
                    'password_hint' => $this->postField('password'),
                ];

                $user = User::create($data_account);

                $data_member = [
                    'user_id' => $user->id,
                    'nama' => $name,
                    'no_hp' => $phone,
                    'instansi' => $institute,
                    'alamat' => $address
                ];

                PesertaMagang::create($data_member);

                $data_application = [
                    'user_id' => $user->id,
                    'no_pengajuan' => 'PM-' . date('YmdHis'),
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'status' => 'menunggu',
                    'deskripsi' => ''
                ];

                if ($this->request->hasFile('document')) {
                    $file = $this->request->file('document');
                    $extension = $file->getClientOriginalExtension();
                    $document = Uuid::uuid4()->toString() . '.' . $extension;
                    $storage_path = public_path('assets/document');
                    $documentName = $storage_path . '/' . $document;
                    $data_application['surat_pengajuan'] = '/assets/document/' . $document;
                    $file->move($storage_path, $documentName);
                }

                if ($this->request->hasFile('cv')) {
                    $file = $this->request->file('cv');
                    $extension = $file->getClientOriginalExtension();
                    $document = Uuid::uuid4()->toString() . '.' . $extension;
                    $storage_path = public_path('assets/cv');
                    $documentName = $storage_path . '/' . $document;
                    $data_application['cv'] = '/assets/cv/' . $document;
                    $file->move($storage_path, $documentName);
                }

                Pengajuan::create($data_application);
                DB::commit();
                return redirect()->route('register.finish')->with('finish', 'oke');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('failed', 'terjadi kesalahan server...');
            }
        }
        return view('register');
    }

    public function finish()
    {
        if (!Session::has('finish')) {
            return redirect()->route('login');
        }
        Session::flush();
        return view('register-selesai');
    }
}
