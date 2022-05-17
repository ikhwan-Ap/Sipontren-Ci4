<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    public $provinsi = [
        'nama_provinsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Provinsi Belum Terisi'
            ]
        ]
    ];

    public $noPasswordAsatidz = [
        'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Username harus diisi!',
                'username' => 'Terdapat username dengan data yang sama',
            ]
        ],
        'no_kk' => [
            'rules' => 'required|numeric|min_length[16]|max_length[16]',
            'errors' => [
                'required' => 'NO KK harus diisi!',
                'numeric' => 'NO KK harus angka!',
                'min_length' => 'NO KK kurang dari 16 Angka',
                'max_length' => 'NO KK lebih dari 16 Angka'
            ]
        ],
        'nama_lengkap' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Lengkap harus diisi!',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!',
            ]
        ],
        'jenis_kelamin' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis Kelamin harus diisi!',
            ]
        ],
        'tempat_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tempat Lahir harus diisi!',
            ]
        ],
        'tanggal_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Lahir harus diisi!',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat harus diisi!',
            ]
        ],
        'no_hp' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nomer Hp  harus diisi!',
            ]
        ],
        'pendidikan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'pendidikan harus diisi!',
            ]
        ],
        'id_program' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'program harus diisi!',
            ]
        ],
        'provinsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'provinsi harus diisi!',
            ]
        ],
        'kabupaten' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'kabupaten harus diisi!',
            ]
        ],
        'kecamatan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'kecamatan harus diisi!',
            ]
        ],
        'desa_kelurahan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'desa harus diisi!',
            ]
        ],
    ];
    public $havePasswordAsatidz = [
        'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Username harus diisi!',
                'username' => 'Terdapat username dengan data yang sama',
            ]
        ],
        'no_kk' => [
            'rules' => 'required|numeric|min_length[16]|max_length[16]',
            'errors' => [
                'required' => 'NO KK harus diisi!',
                'numeric' => 'NO KK harus angka!',
                'min_length' => 'NO KK kurang dari 16 Angka',
                'max_length' => 'NO KK lebih dari 16 Angka'
            ]
        ],
        'password' => [
            'rules' => 'required|matches[password_conf]|min_length[5]',
            'errors' => [
                'required' => 'Password harus diisi!',
                'matches' => 'Password tidak sama dengan Konfirmasi Password!',
                'min_length' => 'Password kurang dari 5 karakter!',
            ]
        ],
        'password_conf' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi Password harus diisi!',
                'matches' => 'Konfirmasi Password tidak sama dengan Password!'
            ]
        ],
        'nama_lengkap' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Lengkap harus diisi!',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!',
            ]
        ],
        'jenis_kelamin' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis Kelamin harus diisi!',
            ]
        ],
        'tempat_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tempat Lahir harus diisi!',
            ]
        ],
        'tanggal_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Lahir harus diisi!',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat harus diisi!',
            ]
        ],
        'no_hp' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nomer Hp  harus diisi!',
            ]
        ],
        'pendidikan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'pendidikan harus diisi!',
            ]
        ],
        'id_program' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'program harus diisi!',
            ]
        ],
        'provinsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'provinsi harus diisi!',
            ]
        ],
        'kabupaten' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'kabupaten harus diisi!',
            ]
        ],
        'kecamatan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'kecamatan harus diisi!',
            ]
        ],
        'desa_kelurahan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'desa harus diisi!',
            ]
        ],
    ];

    public $alumni = [
        'nis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'nis harus diisi!',
            ]
        ],
        'nik_ktp' => [
            'rules' => "required|numeric|min_length[16]|max_length[16]|is_unique[santri.nik_ktp,id_santri,{id_santri}]",
            'errors' => [
                'required' => 'NIK KTP harus diisi!',
                'numeric' => 'NIK KTP harus angka!',
                'min_length' => 'Nik KTP kurang dari 16',
                'is_unique' => 'Nik KTP Telah tersedia'
            ]
        ],
        'no_kk' => [
            'rules' => 'required|numeric|min_length[16]|max_length[16]',
            'errors' => [
                'required' => 'No KK harus diisi!',
                'numeric' => 'No KK harus angka!',
                'min_length' => 'Nomor KK kurang dari 16 !!!'
            ]
        ],
        'nama_lengkap' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Lengkap harus diisi!',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!',
            ]
        ],
        'jenis_kelamin' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis Kelamin harus diisi!',
            ]
        ],
        'tempat_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tempat Lahir harus diisi!',
            ]
        ],
        'tanggal_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Lahir harus diisi!',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat harus diisi!',
            ]
        ],
        'no_hp_santri' => [
            'rules' => 'required|numeric|min_length[11]|max_length[16]',
            'errors' => [
                'required' => 'No HP harus diisi!',
                'numeric' => 'No HP harus angka!',
            ]
        ],
        'pendidikan_terakhir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'pendidikan terakhir harus diisi!',
            ]
        ],
        'pendidikan_sekarang' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'pendidikan harus diisi!',
            ]
        ],
    ];

    public $noPasswordAdmin =  [
        'name' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama harus diisi!'
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!'
            ]
        ],
    ];
    public $havePasswordAdmin = [
        'name' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama harus diisi!'
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!'
            ]
        ],
        'password' => [
            'rules' => 'required|matches[password_conf]|min_length[5]',
            'errors' => [
                'required' => 'Password harus diisi!',
                'matches' => 'Password tidak sama dengan Konfirmasi Password!',
                'min_length' => 'Password kurang dari 5 karakter!',
            ]
        ],
        'password_conf' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi Password harus diisi!',
                'matches' => 'Konfirmasi Password tidak sama dengan Password!'
            ]
        ]
    ];

    public $saveDaftarUlang = [
        'nis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'nis  harus diisi!',
            ]
        ],
        'id_santri' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Lengkap harus diisi!',
            ]
        ],
        'id_tagihan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pembayaran harus diisi!',
            ]
        ],
        'jumlah_bayar' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jumlah yang di bayarkan harus diisi!',
            ]
        ],
        'jumlah_tagihan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'jumlah tagihan harus diisi!',
            ]
        ],
        'waktu' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Bayar  harus diisi!',
            ]
        ],
    ];

    public $savePerizinan = [
        'nis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'NIS harus diisi!'
            ]
        ],
        'nama_lengkap' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Lengkap harus diisi!',
            ]
        ],
        'keterangan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Keterangan harus diisi!',
            ]
        ],
        'tanggal_izin' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Izin harus diisi!',
            ]
        ],
        'tanggal_estimasi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Estimasi Kembali harus diisi!',
            ]
        ]
    ];

    public $saveRegister = [
        'no_kk' => [
            'rules' => 'required|numeric|min_length[16]|max_length[16]',
            'errors' => [
                'required' => 'No KK harus diisi!',
                'numeric' => 'No KK harus angka!',
                'min_length' => 'Nomor KK kurang dari 16 !!!'
            ]
        ],
        'nama_lengkap' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Lengkap harus diisi!',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!',
            ]
        ],
        'jenis_kelamin' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis Kelamin harus diisi!',
            ]
        ],
        'tempat_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tempat Lahir harus diisi!',
            ]
        ],
        'tanggal_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Lahir harus diisi!',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat harus diisi!',
            ]
        ],
        'desa_kelurahan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Desa / Kelurahan harus diisi!',
            ]
        ],
        'kecamatan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kecamatan harus diisi!',
            ]
        ],
        'kabupaten' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kabupaten harus diisi!',
            ]
        ],
        'provinsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Provinsi harus diisi!',
            ]
        ],
        'nama_ayah' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Ayah harus diisi!',
            ]
        ],
        'nama_ibu' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Ibu harus diisi!',
            ]
        ],
        'no_hp_santri' => [
            'rules' => 'required|numeric|min_length[11]|max_length[16]',
            'errors' => [
                'required' => 'No HP harus diisi!',
                'numeric' => 'No HP harus angka!',
            ]
        ],
        'no_hp_wali' => [
            'rules' => 'required|numeric|min_length[11]|max_length[16]',
            'errors' => [
                'required' => 'No HP harus diisi!',
                'numeric' => 'No HP harus angka!',
            ]
        ],
        'catatan_medis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Catatan Medis harus diisi!',
            ]
        ],
        'pendidikan_terakhir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pendidikan Terakhir harus diisi!',
            ]
        ],
        'pengalaman_mondok' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pengalaman Mondok harus diisi!',
            ]
        ],
        'pendidikan_sekarang' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pendidikan Sekarang harus diisi!',
            ]
        ],
        'pekerjaan_ortu' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pekerjaan Ortu Sekarang harus diisi!',
            ]
        ],
        'gol_darah' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Golongan Darah harus diisi!',
            ]
        ],
        'nisn_nim' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'NISN / NIM harus diisi!',
            ]
        ],
        'nama_almet' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Almamater harus diisi!',
            ]
        ],
        'kelas_semester' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kelas / Semester harus diisi!',
            ]
        ],
        'jurusan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jurusan harus diisi!',
            ]
        ],
        'jenis_kendaraan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis Kendaraan harus diisi!',
            ]
        ],
        'plat_nomor' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Plat Nomor harus diisi!',
            ]
        ],
    ];

    public $saveSantri = [
        'nis' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'NIS harus diisi!',
                'numeric' => 'NIS harus angka!'
            ]
        ],
        'nik_ktp' => [
            'rules' => 'required|numeric|min_length[16]|max_length[16]|is_unique[santri.nik_ktp]',
            'errors' => [
                'required' => 'NIK KTP harus diisi!',
                'numeric' => 'NIK KTP harus angka!',
                'min_length' => 'NIK KTP kurang dari 16 Angka',
                'max_length' => 'NIK KTP lebih dari 16 Angka'
            ]
        ],
        'no_kk' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'No KK harus diisi!',
                'numeric' => 'No KK harus angka!'
            ]
        ],
        'password' => [
            'rules' => 'required|matches[password_conf]|min_length[5]',
            'errors' => [
                'required' => 'Password harus diisi!',
                'matches' => 'Password tidak sama dengan Konfirmasi Password!',
                'min_length' => 'Password kurang dari 5 karakter!',
            ]
        ],
        'password_conf' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Konfirmasi Password harus diisi!',
                'matches' => 'Konfirmasi Password tidak sama dengan Password!'
            ]
        ],
        'nama_lengkap' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Lengkap harus diisi!',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi!',
                'valid_email' => 'Email tidak valid!',
            ]
        ],
        'jenis_kelamin' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis Kelamin harus diisi!',
            ]
        ],
        'tempat_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tempat Lahir harus diisi!',
            ]
        ],
        'tanggal_lahir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal Lahir harus diisi!',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat harus diisi!',
            ]
        ],
        'desa_kelurahan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Desa / Kelurahan harus diisi!',
            ]
        ],
        'kecamatan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kecamatan harus diisi!',
            ]
        ],
        'kabupaten' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kabupaten harus diisi!',
            ]
        ],
        'provinsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Provinsi harus diisi!',
            ]
        ],
        'nama_ayah' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Ayah harus diisi!',
            ]
        ],
        'nama_ibu' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Ibu harus diisi!',
            ]
        ],
        'no_hp_santri' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'No HP harus diisi!',
                'numeric' => 'No HP harus angka!',
            ]
        ],
        'no_hp_wali' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'No HP harus diisi!',
                'numeric' => 'No HP harus angka!',
            ]
        ],
        'catatan_medis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Catatan Medis harus diisi!',
            ]
        ],
        'pendidikan_terakhir' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pendidikan Terakhir harus diisi!',
            ]
        ],
        'pengalaman_mondok' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pengalaman Mondok harus diisi!',
            ]
        ],
        'pendidikan_sekarang' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pendidikan Sekarang harus diisi!',
            ]
        ],
        'pekerjaan_ortu' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pekerjaan Ortu Sekarang harus diisi!',
            ]
        ],
        'gol_darah' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Golongan Darah harus diisi!',
            ]
        ],
        'nisn_nim' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'NISN / NIM harus diisi!',
            ]
        ],
        'nama_almet' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Almamater harus diisi!',
            ]
        ],
        'kelas_semester' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kelas / Semester harus diisi!',
            ]
        ],
        'jurusan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jurusan harus diisi!',
            ]
        ],
        'id_program' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Program harus diisi!',
            ]
        ],
        'id_diniyah' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Diniyah harus diisi!',
            ]
        ],
        'id_kelas' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kelas harus diisi!',
            ]
        ],
        'id_kamar' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kamar harus diisi!',
            ]
        ],
        'jenis_kendaraan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Jenis Kendaraan harus diisi!',
            ]
        ],
        'plat_nomor' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Plat Nomor harus diisi!',
            ]
        ],
    ];
    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
}
