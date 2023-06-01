<?php 
    include "header.php";
?>

<?php
    if(isset($_POST['add'])) {
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $jabatan = $_POST['jabatan'];
        $status = $_POST['status'];
        $cek = mysqli_query($koneksi, "SELECT * FROM t_karyawan WHERE nik='$nik'");
        if(mysqli_num_rows($cek)) {
?>

<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
    </button>NIK Sudah Ada!
</div>
<?php
    }
    else {
            $insert = mysqli_query($koneksi, "INSERT INTO t_karyawan(nik, nama, tempat_lahir, tanggal_lahir, alamat, no_telepon, jabatan, status) VALUES ('$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$no_telepon', '$jabatan', '$status')") or die(mysqli_error($koneksi));
            if ($insert) {
?>

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
    </button>Data Karyawan berhasil disimpan.
    <meta http-equiv='refresh' content='1;
    url=karyawan_data.php' />
</div>

<?php
    } else {
?>

<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
    </button>Ups, Data Karyawan gagal disimpan!
</div>
<?php
            }
        }
    }
?>



<h2>Data Karyawan &raquo; Tambah Data</h2>
<hr />
<form class="form-horizontal" action="" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">NIK</label>
        <div class="col-sm-2">
            <input type="text" name ="nik" class="form-control" placeholder="NIK" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-4">
            <input type="text" name ="nama" class="form-control" placeholder="Nama" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Tempat Lahir</label>
        <div class="col-sm-4">
            <input type="text" name ="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Tanggal Lahir</label>
        <div class="col-sm-4">
            <input type="date" name ="tanggal_lahir" value="" class="input-group form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Alamat</label>
        <div class="col-sm-3">
            <textarea name ="alamat" class="form-control" placeholder="Alamat"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">No Telepon</label>
        <div class="col-sm-3">
            <input type="text" name ="no_telepon" maxlength="12" class="form-control" placeholder="No Telepon" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Jabatan</label>
        <div class="col-sm-2">
        <select name="jabatan" id="jabatan" class="form-control"> 
        <?php 
            $options = set_and_enum_values($koneksi, 't_karyawan', 'jabatan'); 
            foreach ($options as $option) : 
            $selected = ('Operator' && 'Operator' == $option) ?  : ''; 
        ?> 
        <option value="<?php echo $option; ?>"> <?php echo $option ?></option> 
        <?php endforeach; ?> 
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Status</label>
        <div class="col-sm-2">
        <select name="status" id="status" class="form-control"> 
        <?php 
            $options = set_and_enum_values($koneksi, 't_karyawan', 'status'); 
            foreach ($options as $option) : 
            $selected = ('Operator' && 'Operator' == $option) ?  : ''; 
        ?> 
        <option value="<?php echo $option; ?>"> <?php echo $option ?></option> 
        <?php endforeach; ?> 
        </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp; </label>
        <div class="col-sm-6">
            <button type="submit" name="add" class="btn btn-sm btn-primary" value="SIMPAN">Simpan</button>
            <button type="reset" class="btn btn-sm btn-warning" value="Reset">Reset</button>
            <button class="btn btn-sm btn-danger" onclick="history.back()">Kembali</button>
        </div>
    </div>
</form>

<?php 
    include "footer.php";
?>