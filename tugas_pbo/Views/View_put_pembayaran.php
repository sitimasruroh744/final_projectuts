<?php

// Memanggil fungsi dari CSRF
include('../Config/Csrf.php');

include '../Controllers/Controller_pembayaran.php';
// Membuat Object dari Class pembayaran
$pembayaran = new Controller_pembayaran();
$id_pembayaran = base64_decode($_GET['id_pembayaran']);
$GetPembayaran = $pembayaran->GetData_Where($id_pembayaran);
?>



<?php
foreach ($GetPembayaran as $Get) {
?>

    <div class="card border-light bg-success">
        <div class="card-header"><a class="btn btn-primary" href="main.php?menu=<?php echo base64_encode('id_pem') ?>">Kembali</a></div>
        <div class="card-body text-dark">
            <h4 class="card-title">Form Ubah Siswa</h4>

            <p class="card-text">
            <form action="../Config/Routes.php?function=put_pembayaran" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo CreateCSRF(); ?>" />

                <input type="hidden" name="id_pembayaran" value="<?php echo $Get['id_pembayaran']; ?>">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Petugas</label>
                    <div class="col-sm-4">
                        <select name="id_petugas" required class="form-control">
                            <?php
                            $GetPetugas = $pembayaran->GetData_Petugas();
                            foreach ($GetPetugas as $GetP) : ?>
                                <option value="<?php echo $GetP['id_petugas']; ?>"><?php echo $GetP['nama_petugas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="nisn" value="<?php echo $Get['nisn']; ?>" readonly required><input type="text" value="<?php echo $Get['nama']; ?>" readonly required class="form-control">

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Bayar</label>
                    <div class="col-sm-10">
                        <input type="text" name="tgl_bayar" value="<?php echo $Get['tgl_bayar']; ?>" onKeyPress="return isNumberKey(event);" required class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bulan Bayar</label>
                    <div class="col-sm-10">
                        <input type="text" name="bulan_dibayar" value="<?php echo $Get['bulan_dibayar']; ?>" onKeyPress="return ValidateAlpha(event);" required class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tahun Bayar</label>
                    <div class="col-sm-10">
                        <input type="text" name="tahun_bayar" value="<?php echo $Get['tahun_bayar']; ?>" onKeyPress="return isNumberKey(event);" required class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nominal SPP</label>
                    <div class="col-sm-4">
                        <select name="id_spp" required class="form-control">
                            <option value="<?php echo $Get['id_spp']; ?>">
                                <?php
                                if ($Get['id_spp'] == "1") {
                                    echo "30000";
                                } else if ($Get['id_spp'] == "2") {
                                    echo "25000";
                                } elseif ($Get['id_spp'] == "3") {
                                    echo "20000";
                                } else {
                                    echo "15000";
                                }
                                ?>
                            </option>
                            <!-- Logic combo Get database -->

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
                        <input type="text" name="jumlah_bayar" value="<?php echo $Get['jumlah_bayar']; ?>" onKeyPress="return isNumberKey(event);" required class="form-control">
                    </div>
                </div>

                <input style="margin-left: 92%;" class="btn btn-primary" type="submit" name="proses" value="Tambah">
            </form>
            </p>
        </div>
    </div>

    <br>

<?php
}
?>

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