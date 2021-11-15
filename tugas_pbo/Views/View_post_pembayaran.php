<?php
// Memanggil fungsi dari CSRF
include('../Config/Csrf.php');

include '../Controllers/Controller_pembayaran.php';
// Membuat Object dari Class pembayaran
$pembayaran = new Controller_pembayaran();
$GetSpp = $pembayaran->GetData_Siswa();
?>

<div class="card border-light bg-success">
    <div class="card-header"><a class="btn btn-primary" href="main.php?menu=<?php echo base64_encode('id_pem') ?>">Kembali</a></div>
    <div class="card-body text-dark">
        <h4 class="card-title">Form Pembayaran</h4>

        <p class="card-text">
        <form action="../Config/Routes.php?function=create_pembayaran" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo CreateCSRF(); ?>" />

            <input type="hidden" name="id_pembayaran">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Petugas</label>
                <div class="col-sm-4">
                    <select name="id_petugas" required class="form-control">
                        <option value="">Pilih Petugas</option>
                        <option value="1">coba petugas</option>
                        <option value="2">coba admin</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-4">
                    <select name="nisn" required class="form-control">
                        <option value="">Choose...</option>
                        <?php
                        foreach ($GetSpp as $GetP) : ?>
                            <option value="<?php echo $GetP['nisn']; ?>"><?php echo $GetP['nama']; ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Bayar</label>
                <div class="col-sm-10">
                    <input type="text" name="tgl_bayar" onKeyPress="return isNumberKey(event);" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Bulan Bayar</label>
                <div class="col-sm-10">
                    <input type="text" name="bulan_dibayar" onKeyPress="return ValidateAlpha(event);" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun Bayar</label>
                <div class="col-sm-10">
                    <input type="text" name="tahun_bayar" onKeyPress="return isNumberKey(event);" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nominal SPP</label>
                <div class="col-sm-4">
                    <select name="id_spp" required class="form-control">
                        <option value="">Choose...</option>
                        <option value="1">30000</option>
                        <option value="2">25000</option>
                        <option value="3">20000</option>
                        <option value="4">15000</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Bayar</label>
                <div class="col-sm-10">
                    <input type="text" name="jumlah_bayar" onKeyPress="return isNumberKey(event);" required class="form-control">
                </div>
            </div>

            <input style="margin-left: 92%;" class="btn btn-primary" type="submit" name="proses" value="Tambah">
        </form>

        </p>
    </div>


</div>

<br>


<script>
    function ValidateAlpha(evt) {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)

            return false;
        return true;
    }

    function isNumberKey(evt) {
        //var e = evt || window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode != 46 && charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>