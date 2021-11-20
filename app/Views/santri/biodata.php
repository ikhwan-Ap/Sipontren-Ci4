<?= $this->extend('layout/template_santri'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $title; ?></h1>
    </div>
    <?= session()->getFlashdata('message'); ?>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Biodata</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" value="<?= $santri['nama_lengkap']; ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control" value="<?= $santri['nis']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No Hp</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class=" input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control phone-number" value="<?= $santri['no_hp_santri']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kamar</label>
                            <div class="input-group">
                                <input type="text" class="form-control currency" value="<?= $santri['id_kamar']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diniyah</label>
                            <input type="text" class="form-control purchase-code" value="<?= $santri['id_diniyah']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Program</label>
                            <input type="text" class="form-control invoice-input" value="<?= $santri['id_program']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['tanggal_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['tempat_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['tempat_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['tempat_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['jenis_kelamin']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Desa/kelurahan</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['desa_kelurahan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['kecamatan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['kabupaten']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control datemask" value="<?= $santri['provinsi']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['gol_darah']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Catatan Medis</label>
                            <input type="text" class="form-control creditcard" value="<?= $santri['catatan_medis']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['pendidikan_terakhir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pengalaman Mondok</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['pengalaman_mondok']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Sekarang</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['pendidikan_sekarang']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Almet</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['nama_almet']; ?>">
                        </div>
                        <div class="form-group">
                            <label>NISN/NIM</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['nisn_nim']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['jurusan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kelas/Semester</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['kelas_semester']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control inputtags" value="<?= $santri['status']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Biodata Orang tua</h4>
                    </div>
                    <div class="card-body">
                        <div class="section-title mt-0">Default</div>
                        <div class="form-group">
                            <label>Default Select</label>
                            <select class="form-control">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>
                        <div class="section-title">Select 2</div>
                        <div class="form-group">
                            <label>Select2</label>
                            <select class="form-control select2">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select2 Multiple</label>
                            <select class="form-control select2" multiple="">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                                <option>Option 6</option>
                            </select>
                        </div>
                        <div class="section-title">jQuery Selectric</div>
                        <div class="form-group">
                            <label>jQuery Selectric</label>
                            <select class="form-control selectric">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                                <option>Option 6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>jQuery Selectric Multiple</label>
                            <select class="form-control selectric" multiple="">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                                <option>Option 6</option>
                            </select>
                        </div>
                        <div class="section-title">Select Group Button</div>
                        <div class="form-group">
                            <label class="form-label">Size</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="50" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">S</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="100" class="selectgroup-input">
                                    <span class="selectgroup-button">M</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="150" class="selectgroup-input">
                                    <span class="selectgroup-button">L</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="200" class="selectgroup-input">
                                    <span class="selectgroup-button">XL</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Icons input</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="transportation" value="2" class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-mobile"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="transportation" value="1" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-tablet"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="transportation" value="6" class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-laptop"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="transportation" value="6" class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-times"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Icon input</label>
                            <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-sun"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="2" class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-moon"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="3" class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-cloud-rain"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="4" class="selectgroup-input">
                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-cloud"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Your skills</label>
                            <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value" value="HTML" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">HTML</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value" value="CSS" class="selectgroup-input">
                                    <span class="selectgroup-button">CSS</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value" value="PHP" class="selectgroup-input">
                                    <span class="selectgroup-button">PHP</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value" value="JavaScript" class="selectgroup-input">
                                    <span class="selectgroup-button">JavaScript</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
                                    <span class="selectgroup-button">Ruby</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
                                    <span class="selectgroup-button">Ruby</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value" value="C++" class="selectgroup-input">
                                    <span class="selectgroup-button">C++</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Toggle Switches</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="control-label">Toggle switches</div>
                            <div class="custom-switches-stacked mt-2">
                                <label class="custom-switch">
                                    <input type="radio" name="option" value="1" class="custom-switch-input" checked>
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Option 1</span>
                                </label>
                                <label class="custom-switch">
                                    <input type="radio" name="option" value="2" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Option 2</span>
                                </label>
                                <label class="custom-switch">
                                    <input type="radio" name="option" value="3" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Option 3</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label">Toggle switch single</div>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">I agree with terms and conditions</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Date &amp; Time Picker</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="d-block">Date Range Picker With Button</label>
                            <a href="javascript:;" class="btn btn-primary daterange-btn icon-left btn-icon"><i class="fas fa-calendar"></i> Choose Date
                            </a>
                        </div>
                        <div class="form-group">
                            <label>Date Picker</label>
                            <input type="text" class="form-control datepicker">
                        </div>
                        <div class="form-group">
                            <label>Date Time Picker</label>
                            <input type="text" class="form-control datetimepicker">
                        </div>
                        <div class="form-group">
                            <label>Date Range Picker</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control daterange-cus">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Time Picker</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control timepicker">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>