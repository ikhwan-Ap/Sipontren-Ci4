<?= $this->extend('layout/template_admin'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-button">
            <a href="/pembayaran" class="btn btn-light mr-3"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $title; ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/pembayaran">Pembayaran</a></div>
            <div class="breadcrumb-item">Pembayaran</div>
        </div>
    </div>

    <?= session()->getFlashdata('message'); ?>

    <div class="card col-lg-8">
        <form action="/pembayaran/<?= $BelumLunas['id_keuangan']; ?>" method="POST">
            <div class="card-header">
                <h4 class="text-dark">Pembayaran Santri</h4>
            </div>
            <div class="card-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id_keuangan" value="<?= $BelumLunas['id_keuangan']; ?>">
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Nama Lengkap</label>
                        <p class="form-control"><?= $BelumLunas['nama_lengkap']; ?></p>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>NIS</label>
                        <p class="form-control"><?= $BelumLunas['nis']; ?></p>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label for="nama_pembayaran">Keterangan</label>
                        <p class="form-control"><?= $BelumLunas['nama_pembayaran']; ?></p>
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="jumlah_pembayaran">Tagihan</label>
                        <input id="jumlah_pembayaran" type="text" class="form-control" name="jumlah_pembayaran" value="<?= $BelumLunas['jumlah_pembayaran']; ?>" readonly>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah_pembayaran'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label for="jumlah_bayar">Jumlah Pembayaran</label>
                        <input id="jumlah_bayar" type="number" class="form-control <?= ($validation->hasError('jumlah_bayar')) ? 'is-invalid' : ''; ?>" name="jumlah_bayar" value="<?= old('jumlah_bayar'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah_bayar'); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Bayar</button>
                    <a href="/pembayaran" class="btn btn-light ml-2">Batal</a>
                </div>
        </form>
    </div>


</section>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        var y = document.getElementById("password_conf");
        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
</script>
<?= $this->endSection(); ?>


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
require_once(dirname(__FILE__).'/lang/eng.php');
$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 12);

// add a page
$pdf->AddPage();

// set some text to print
$txt = <<<EOD TCPDF Example 003 Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods. EOD; // print a block of text using Write() $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('example_003.pdf', 'I');