<?php
// Memanggil fungsi dari CSRF
include('../Config/Csrf.php');

include '../Controllers/Controller_siswa.php';
// Membuat Object dari Class siswa
$siswa = new Controller_siswa();
$GetKelas = $siswa->GetData_Kelas();
?>


<div class="card border-light bg-success">
    <div class="card-header"><a class="btn btn-primary" href="main.php?menu=<?php echo base64_encode('id_s') ?>">Kembali</a></div>
    <div class="card-body text-dark">
        <h4 class="card-title">Form Tambah Siswa</h4>

        <p class="card-text">
        <form action="../Config/Routes.php?function=create_siswa" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo CreateCSRF(); ?>" />
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-10">
                    <input style="background-color: lightgray;  color: royalblue;" type="text" name="nisn" onKeyPress="return  isNumberKey(event);" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIS</label>
                <div class="col-sm-10">
                    <input style="background-color: lightgray;  color: royalblue;" type="text" name="nis" onKeyPress="return  isNumberKey(event);" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input style="background-color: lightgray;  color: royalblue;" type="text" name="nama" onKeyPress="return ValidateAlpha(event);" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-4">
                    <select name="id_kelas" required class="form-control" style="background-color: lightgray;  color: royalblue;">
                        <option value="">Choose...</option>
                        <?php
                        foreach ($GetKelas as $Get) : ?>
                            <option value=" <?php echo $Get['id_kelas'] ?>"><?php echo $Get['nama_kelas'] ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input style="background-color: lightgray;  color: royalblue;" type="text" name="alamat" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10">
                    <input style="background-color: lightgray;  color: royalblue;" type="text" name="no_telp" onKeyPress="return  isNumberKey(event);" required class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nominal SPP</label>
                <div class="col-sm-4">
                    <select name="id_spp" required class="form-control" style="background-color: lightgray;  color: royalblue;">
                        <option value="">Choose...</option>
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