<?php
// Memanggil fungsi dari CSRF
include('../Config/Csrf.php');

?>
<div class="card border-light bg-success">
    <div class="card-header"><a class="btn btn-primary" href="main.php?menu=<?php echo base64_encode('id_pet') ?>">Kembali</a></div>
    <div class="card-body text-dark">
        <h4 class="card-title">Form Tambah Petugas</h4>

        <p class="card-text">
        <form action="../Config/Routes.php?function=create_petugas" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo CreateCSRF(); ?>" />

            <input type="hidden" name="id_petugas">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" onKeyPress="return ValidateAlpha(event);" required class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" name="password" onKeyPress="return isNumberKey(event);" required class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Petugas</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_petugas" onKeyPress="return ValidateAlpha(event);" required class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nominal SPP</label>
                <div class="col-sm-4">
                    <select name="level" required class="form-control">
                        <option value="">Pilih</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Petugas">Petugas</option>
                    </select>
                </div>
            </div>

            <input style="margin-left: 92%;" class="btn btn-primary" type="submit" name="proses" value="Tambah">
        </form>

        </p>
    </div>


</div>
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