<?php

// Memanggil fungsi dari CSRF
include('../Config/Csrf.php');

include '../Controllers/Controller_siswa.php';
// Membuat Object dari Class siswa
$siswa = new Controller_siswa();
$nisn = base64_decode($_GET['nisn']);
$GetSiswa = $siswa->GetData_Where($nisn);

?>

<?php
foreach ($GetSiswa as $Get) {
?>
    <div class="card border-light bg-success">
        <div class="card-header"><a class="btn btn-primary" href="main.php?menu=<?php echo base64_encode('id_s') ?>">Kembali</a></div>
        <div class="card-body text-dark">
            <h4 class="card-title">Form Ubah Siswa</h4>

            <p class="card-text">
            <form action="../Config/Routes.php?function=put_siswa" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo CreateCSRF(); ?>" />

                <div class="form-group row">
                    <!-- <label class="col-sm-2 col-form-label">NISN</label> -->
                    <div class="col-sm-10">
                        <input type="hidden" name="nisn" value="<?php echo $Get['nisn']; ?>" onKeyPress="return  isNumberKey(event);" required class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIS</label>
                    <div class="col-sm-10">
                        <input type="text" name="nis" value="<?php echo $Get['nis']; ?>" onKeyPress="return  isNumberKey(event);" required class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" value="<?php echo $Get['nama']; ?>" onKeyPress="return ValidateAlpha(event);" required class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-4">
                        <select name="id_kelas" required class="form-control">
                            <?php
                            $GetKelas = $siswa->GetData_Kelas();
                            foreach ($GetKelas as $GetK) : ?>
                                <option value="<?php echo $GetK['id_kelas'] ?>"><?php echo $GetK['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" value="<?php echo $Get['alamat']; ?>" required class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" name="no_telp" value="<?php echo $Get['no_telp']; ?>" onKeyPress="return  isNumberKey(event);" required class="form-control">
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
                <input style="margin-left: 92%;" class="btn btn-primary" type="submit" name="proses" value="Tambah">
            </form>
            </p>
        </div>
    </div>
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