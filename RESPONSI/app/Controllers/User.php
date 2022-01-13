<?php

namespace App\Controllers;
use App\Models\buketModel;

class User extends BaseController
{
	// protected $partaiModel;
	protected $buketModel;
	protected $session;

	public function __construct(){
        $this->session = service('session');
        $this->buketModel = new BuketModel();
        
	}
    
    public function index()
    {
        $buket = $this->buketModel->where('buket_status', 'Ada')->findAll();
        $data = [
            'title' => 'Galeria Buket',
            'buket' => $buket
        ];

        return view('v_index', $data);
    }

    public function daftarbuket()
    {
		session();

        $data = [
            'title' => 'Daftar buket | DPRD Halteng'
        ];

        return view('v_daftar', $data);
    }
    

    public function save_buket()
    {
		// validasi input
		if (!$this->validate([
            'gambar' => [
				'rules' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'uploaded' => 'Masukkan gambar buket.',
					'max_size' => 'Ukuran gambar terlalu besar.',
					'is_image' => 'Yang anda pilih bukan gambar.',
					'mime_in' => 'Yang anda pilih bukan gambar.'
				]
                ],
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
			return redirect()->to('/daftarbuket')->withInput()->with('validation', $validation->getErrors());
		}
        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('assets/buket', $namaGambar);

        $this->buketModel->save([
            'buket_nama' => $this->request->getVar('nama'),
            'buket_gambar' => $namaGambar,
            'buket_harga' => $this->request->getVar('harga'),
            'buket_pemilik' => $this->request->getVar('pemilik'),
            'buket_kontak' => $this->request->getVar('kontak'),
            'buket_wa' => $this->request->getVar('wa'),
            'buket_desc' => $this->request->getVar('desc'),
        ]);

        session()->setFlashdata('pesan', 'Silahkan lakukan pembayaran 10k melalui no rek 123456 atas nama Nurul Rossa!');

        // dd(session()->getFlashdata('pesan'));

        return redirect()->to('/daftarbuket');
    }

    public function cari_buket()
    {
        $key = $this->request->getVar('key');
        $find = $this->buketModel->like('buket_nama', '%'.$key.'%')
                                  ->orlike('buket_desc', '%'.$key.'%')
                                  ->findAll();
        
        $data = [
            'title' => 'Pencarian buket',
            'buket' => $find
        ];
        
        return view('v_pencarian', $data);
    }
}
