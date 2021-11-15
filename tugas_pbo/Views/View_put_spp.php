<?php

// Memanggil fungsi dari CSRF
include('../Config/Csrf.php');

include '../Controllers/Controller_spp.php';
// Membuat Object dari Class spp
$spp = new Controller_spp();
$id_spp = base64_decode($_GET['id_spp']);
$GetSpp = $spp->GetData_Where($id_spp);
?>



<?php
foreach ($GetSpp as $Get) {
?>

    <div class="card border-light bg-success">
        <div class="card-header"><a class="btn btn-primary" href="main.php?menu=<?php echo base64_encode('id_sp') ?>">Kembali</a></div>
        <div class="card-body text-dark">
            <h4 class="card-title">Form Ubah Spp</h4>

            <p class="card-text">
            <form action="../Config/Routes.php?function=put_spp" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo CreateCSRF(); ?>" />

                <input type="hidden" name="id_spp" value="<?php echo $Get['id_spp']; ?>">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                        <input type="text" name="tahun" onKeypress="return isNumberKey(event)" value="<?php echo $Get['tahun']; ?>" required class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nominal</label>
                    <div class="col-sm-10">
                        <input type="text" name="nominal" onKeypress="return isNumberKey(event)" value="<?php echo $Get['nominal']; ?>" required class="form-control">
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