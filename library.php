<?php
# Fungsi untuk membalik tanggal dari format English (Y-M-D) --> Indo (D-M-Y)
//function IndonesiaTgl($tanggal) {
//    $tgl=substr($tanggal,8,2);
//    $bln=substr($tanggal,5,2);
//    $thn=substr($tanggal,0,4);
//    $tanggal="$tgl-$bln-$thn";
//    return $tanggal;
//}

#Fungsi untuk membuat format rupiah pada angka(uang)
function format_angka($angka) {
    $hasil=number_format($angka,0, ",",".");
    return $hasil;
}

#Fungsi koneksi ke tabel ENUM
function set_and_enum_values( &$koneksi, $table , $field ) 
{ 
    $query = "SHOW COLUMNS FROM $table LIKE '$field'"; 
    $result = mysqli_query( $koneksi, $query ) or die( 'Error getting Enum/Set field ' . mysqli_error($koneksi) ); 
    $row = mysqli_fetch_row($result); 
 
    if(stripos($row[1], 'enum') !== false || stripos($row[1], 'set') !== false) 
    { 
        $values = str_ireplace(array('enum(', 'set('), '', trim($row[1], ')')); 
        $values = explode(',', $values); 
        $values = array_map(function($str) { return trim($str, '\'"'); }, $values); 
    } 
 
    return $values; 
}

# Fungsi untuk membalik tanggal dari format English (Y-m-d) -> Indo (dd Nama Bulan Tahun)
function indonesiaTgl($tanggal){ 
    $bulan = array ( 
     1 =>  'Januari', 
     'Februari', 
     'Maret', 
     'April', 
     'Mei', 
     'Juni', 
     'Juli', 
     'Agustus', 
     'September', 
     'Oktober', 
     'November', 
     'Desember' 
    ); 
    $pecahkan = explode('-', $tanggal);  
        
    if($pecahkan[1]=="00"){ 
     return "INVALID"; 
    } 
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0]; 
   }

?>