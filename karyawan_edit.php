<?php 
    include "header.php";
?>

<?php
    $nik = $_GET['nik'];
    $sql = mysqli_query($koneksi, "SELECT * FROM t_karyawan WHERE nik='$nik'");
    if (mysqli_num_rows($sql)==0) {
?>

<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
    </button>NIK Tidak Ada
</div>

<?php
    }
    else {
        $row = mysqli_fetch_assoc($sql);
    }
    //Proses Simpan Data
    if(isset($_POST['save'])) {
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $jabatan = $_POST['jabatan'];
        $status = $_POST['status'];

        $update = mysqli_query($koneksi, "UPDATE t_karyawan SET nama='$nama',tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir',alamat='$alamat', no_telepon='$no_telepon', jabatan='$jabatan', status='$status' WHERE nik='$nik'") or die(mysqli_error());
        if($update) {
?>
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
    </button>Data berhasil disimpan
</div>

<meta http-equiv='refresh' content='1; url=karyawan_data.php'>

<?php
        }
        else {
?>

<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
    </button>Data gagal disimpan, silahkan coba lagi
</div>

<?php
        }
    }
?>

<h2>Data Karyawan &raquo; Edit Data</h2>
<form class="form-horizontal" action="" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">NIK</label>
        <div class="col-sm-2">
            <input type="text" name="nik" class="form-control" placeholder="NIK" value="<?php echo $row['nik'] ?>" required>            
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-4">
            <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $row['nama'] ?>" required>            
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Tempat Lahir</label>
        <div class="col-sm-4">
            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo $row['tempat_lahir'] ?>" required>            
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Tanggal Lahir</label>
        <div class="col-sm-4">
            <input type="date" name="tanggal_lahir" class="input-group form-control" value="<?php echo $row['tanggal_lahir'] ?>" required>            
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Alamat</label>
        <div class="col-sm-3">
            <textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $row['alamat'] ?></textarea> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">No Telepon</label>
        <div class="col-sm-3">
            <input type="text" name="no_telepon" class="form-control" placeholder="No Telepon" value="<?php echo $row['no_telepon'] ?>" required>            
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Jabatan</label>
        <div class="col-sm-2">
        <select name="jabatan" id="jabatan" class="form-control"> 
        <?php 
            $options = set_and_enum_values($koneksi, 't_karyawan', 'jabatan'); 
            foreach ($options as $option) : 
            $selected = ($row['jabatan'] && $row['jabatan'] == $option) ? ' selected="selected"' : ''; 
            ?> 
            <option value="<?php echo $option; ?>" <?php echo $selected; ?>><?php echo $option ?></option> 
            <?php endforeach; ?> 
        </select>    
        </div>
        <div class="col-sm-3">
        <b>Jabatan Sekarang :</b> <span class="label label-info"><?php echo $row['jabatan'] ?></span>
        </div>
    </div>
        <div class="form-group">
            <label name="status" class="col-sm-3 control-label">Status</label>
            <div class="col-sm-2">
                <select name="status" id="status" class="form-control"> 
                    <?php 
                    $options = set_and_enum_values($koneksi, 't_karyawan', 'status'); 
                    foreach ($options as $option) : 
                    $selected = ($row['status'] && $row['status'] == $option) ? ' selected="selected"' : ''; 
                    ?> 
                    <option value="<?php echo $option; ?>" <?php echo $selected; ?>><?php echo $option ?></option> 
                    <?php endforeach; ?> 
                    </select>          
            </div>
            <div class="col-sm-3">
                <b>Status Sekarang:</b> <span class="label label-info"><?php echo $row['status'] ?></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp; </label>
        <div class="col-sm-6">
            <button type="submit" name="save" class="btn btn-sm btn-primary">Add</button>
            <button type="reset" class="btn btn-sm btn-warning" value="Reset">Reset</button>
            <button class="btn btn-sm btn-danger" onclick="history.back()">Kembali</button>
        </div>
    </div>
</form>