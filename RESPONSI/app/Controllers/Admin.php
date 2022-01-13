<?php

namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\BuketModel;

class Admin extends BaseController
{
	protected $adminModel;
	protected $buketModel;

	public function __construct(){
		$this->session = service('session');
		$this->adminModel = new AdminModel();
		$this->buketModel = new BuketModel();
	}
    
    public function index()
    {
        return view('admin/v_index');
    }

    public function profil()
    {
        $admin = $this->adminModel->first();

        $data = [
            'title' => 'Data Admin | DPRD Halteng',
            'admin' => $admin
        ];

        return view('admin/v_profil', $data);
    }

    public function password()
    {
        $admin = $this->adminModel->first();

        $data = [
            'title' => 'Edit Password | DPRD Halteng',
            'admin' => $admin
        ];

        return view('admin/v_password', $data);
    }

    public function editAdmin()
    {
        $InputAdminId = $this->request->getVar('admin_id');
        $InputAdminNama = $this->request->getVar('admin_nama');
        $InputAdminUsername = $this->request->getVar('admin_username');

        // $admin = $this->adminModel->where('admin_id', $InputAdminId)->first();

        if (!$this->validate([
			'admin_nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama harus diisi.'
				]
			],
			'admin_username' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Username harus diisi.'
				]
			]
		])) {

			$validation = \Config\Services::validation();
			
			return redirect()->to('/profil-admin')->withInput()->with('validation', $validation->getErrors());
		}

        $this->adminModel->save([
			'admin_id' => $InputAdminId,
			'admin_nama' => $InputAdminNama,
			'admin_username' => $InputAdminUsername,
		]);

		session()->setFlashdata('pesan', 'Data berhasil diubah.');

		return redirect()->to('/profil-admin');
    }

    public function editPassword()
    {
        $validation = \Config\Services::validation();
        
        $InputAdminId = $this->request->getVar('admin_id');
        $InputPassLama = md5($this->request->getVar('password_lama'));
        $InputPassBaru = md5($this->request->getVar('password_baru'));
        $InputPassBaru2 = md5($this->request->getVar('password_baru2'));

        $admin = $this->adminModel->where('admin_id', $InputAdminId)->first();

        if($InputPassLama != $admin['admin_pass']){
            session()->setFlashdata('error', 'Password lama tidak sama');

            return redirect()->to('/password-admin');
        }

        // dd($admin);

        if (!$this->validate([
			'password_lama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Password lama harus diisi.',
				]
			],
			'password_baru' => [
				'rules' => 'required|min_length[6]|is_unique[admin.admin_pass]',
				'errors' => [
					'required' => 'Password baru harus diisi.',
                    'min_length' => 'Password tidak boleh kurang dari 6 karakter',
                    'is_unique' => 'Password belum berubah'
				]
            ],
            'password_baru2' => [
				'rules' => 'required|matches[password_baru]',
				'errors' => [
					'required' => 'Verifikasi harus diisi.',
                    'matches' => 'Verifikasi Password tidak sesuai'
				]
            ],
		])) {
			
			return redirect()->to('/password-admin')->withInput()->with('validation', $validation->getErrors());
		}else{
            $this->adminModel->save([
                'admin_id' => $InputAdminId,
                'admin_pass' => $InputPassBaru2
            ]);
    
            session()->setFlashdata('pesan', 'Data berhasil diubah.');
    
            return redirect()->to('/profil-admin');
        }
    
    }

    public function bucketTambah()
    {
        return view('admin/v_tambahbuket');
    }

    public function bucketAktivasi()
    {
        $buket_pending = $this->buketModel->where('buket_status', 'Pending')->findAll();
        $data = [
            'title' => 'Data Buket Pending',
            'buket_pending' => $buket_pending
        ];

        return view('admin/v_buketaktivasi', $data);
    }

    public function aktivasi($id)
    {
        $this->buketModel->save([
            'buket_id' => $id,
            'buket_status' => 'Ada'
        ]);

        return redirect('admin/bucketList');
    }

    public function buketList()
    {
        $buket_ada = $this->buketModel->where('buket_status', 'Ada')->findAll();
        $data = [
            'title' => 'Data buket Pending',
            'buket_ada' => $buket_ada
        ];

        return view('admin/v_buket', $data);
    }

    public function buket_sold()
    {
        $buket_sold = $this->buketModel->where('buket_status', 'Terjual')->findAll();
        $data = [
            'title' => 'Data buket Pending',
            'buket_sold' => $buket_sold
        ];

        return view('admin/v_buketsold', $data);
    }

    public function edit($id)
    {
        $buket_edit = $this->buketModel->where('buket_id', $id)->first();
        $data = [
            'title' => 'Data Buket Pending',
            'buket' => $buket_edit
        ];

        return view('admin/v_editbuket', $data);
    }

    public function update()
    {
		// validasi input
		if (!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama buket harus diisi.'
				]
			],
			'harga' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Harga buket harus diisi.'
				]
			],
			'kontak' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Kontak pemilik buket harus diisi.'
				]
			],
			'pemilik' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama pemilik buket harus diisi.'
				]
			]
		])) {

			$validation = \Config\Services::validation();
			//dd($validation);
			return redirect()->to('/admin/edit/'.$this->request->getVar('id'))->withInput()->with('validation', $validation->getErrors());
		}

        $this->buketModel->save([
            'buket_id' => $this->request->getVar('id'),
            'buket_nama' => $this->request->getVar('nama'),
            'buket_harga' => $this->request->getVar('harga'),
            'buket_pemilik' => $this->request->getVar('pemilik'),
            'buket_kontak' => $this->request->getVar('kontak'),
            'buket_desc' => $this->request->getVar('desc'),
        ]);

        session()->setFlashdata('pesan', 'Silahkan lakukan pembayaran 25k melalui no rek 21947838 atas nama Wanda Amrina Rosyada!');

        // dd(session()->getFlashdata('pesan'));

        return redirect()->to('/admin/buketList');
    }

    public function save()
    {
		// validasi input
		if (!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama buket harus diisi.'
				]
			],
			'harga' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Harga buket harus diisi.'
				]
			],
			'kontak' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Kontak pemilik buket harus diisi.'
				]
			],
			'pemilik' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama pemilik buket harus diisi.'
				]
			]
		])) {

			$validation = \Config\Services::validation();
			//dd($validation);
			return redirect()->to('/admin/bucketTambah'.$this->request->getVar('id'))->withInput()->with('validation', $validation->getErrors());
		}

        $gmbr = $this->request->getFile('gambar');
        $gambar = $gmbr->getRandomName();
        $gmbr->move('assets/gambar', $gambar);

        $this->buketModel->save([
            'buket_nama' => $this->request->getVar('nama'),
            'buket_gambar' => $gambar,
            'buket_status' => 'Pending',
            'buket_harga' => $this->request->getVar('harga'),
            'buket_pemilik' => $this->request->getVar('pemilik'),
            'buket_kontak' => $this->request->getVar('kontak'),
            'buket_desc' => $this->request->getVar('desc'),
        ]);

        session()->setFlashdata('pesan', 'Silahkan lakukan pembayaran 25k melalui no rek 21947838 atas nama Wanda Amrina Rosyada!');

        // dd(session()->getFlashdata('pesan'));

        return redirect()->to('/admin/buketList');
    }

    public function sold($id)
    {
        $this->buketModel->save([
            'buket_id' => $id,
            'buket_status' => 'Terjual'
        ]);

        return redirect()->to('/buket-sold');
    }

    public function batal_buket($id)
    {
        $this->buketModel->delete($id);

        return redirect()->to('/admin/buketAktivasi');
    }


	public function hapus($id)
	{

		$this->buketModel->delete($id);
		//$this->gambarwisataModel->deleteGambar($id);
		session()->setFlashdata('pesan', 'Data berhasil dihapus.');

		return redirect()->to('/admin/buketList');
	}

    public function laporan()
    {
        $buket = $this->buketModel->findAll();
        $data = [
            'buket' => $buket
        ];

        return view('admin/v_laporan', $data);
    }

    public function pilih_tgl()
    {
        return view('admin/v_laporan');
    }
    
}
