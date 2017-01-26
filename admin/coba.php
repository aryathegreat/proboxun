<?php

$dbh = new PDO('mysql:host=localhost;dbname=db_spkboxer', "root", "");


$jeniskelamin1= "Laki-laki";
$jeniskelamin2="Perempuan";

if(isset($_POST['simpan'])){

$nama=$_POST['txt_nama'];
$alamat=$_POST['txt_alamat'];
$jenis_kelamin=$_POST['cmb_jeniskelamin'];
$satlat=$_POST['txt_satlat'];
$username=$_POST['txt_username'];
$pass1=$_POST['txt_pass1'];
$pass2=$_POST['txt_pass2'];
?>

Nama: <?php echo "$nama"; ?><br>
Alamat: <?php echo "$alamat";?><br>
Jenis Kelamin: <?php echo "$jenis_kelamin";?><br>
Satlat: <?php echo "$satlat";?><br>
Username: <?php echo "$username";?><br>
Password1: <?php echo "$password";?><br>
Password2: <?php echo "$password1";?><br>

<?php
$dbh->query("INSERT INTO user (nama, alamat, jenis_kelamin,satlat, username, password)
      VALUES('$nama','$alamat','$jenis_kelamin','$satlat', '$username','$password')");
}

 ?>

        <div style="font-family:Arial;font-size:12px;padding:3px ">
        <div style="font-size:18px;padding:10px 0 10px 0 ">TAMBAH DATA PENGUJI</div>
        <form method="post">
        <input name="txt_action" type="hidden" value="<?php echo $str->action;?>">
		<input name="txt_id" type="hidden" value="<?php echo $str->id;?>">
        <table width="100%" border="0" cellspacing="4" cellpadding="0" class="tabel_reg">
          <tr>
            <td width="120"valign="top">Nama</td>
            <td><input name="txt_nama" type="text" size="40" value="" required></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td><input name="txt_alamat" type="text" size="40" value="" required></td>
          </tr>

          <tr>
            <td>Jenis Kelamin</td>
            <td><select name="cmb_jeniskelamin" required>
        <option value="<?php echo $jeniskelamin1; ?>">Laki-laki</option>
        <option value="<?php echo $jeniskelamin2; ?>">Perempuan </option>
        </select>
      </td>
          </tr>

          <tr>
            <td>Satlat</td>
            <td><input name="txt_satlat" type="text" size="40" value="" required> </td>
          </tr>
          <tr>
            <td>Username</td>
            <td><input name="txt_username" type="text" size="5" value="" required></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input name="txt_password1" type="password" size="5" value="" required></td>
          </tr>
          <tr>
            <td>Password (Ulangi)</td>
            <td><input name="txt_password2" type="password" size="5" value="" required></td>
          </tr>
          <tr>
            <td></td>
            <td><input name="simpan" type="submit" > <input name="cmd_batal" type="button" onClick="location.href='?hal=data_penguji';" value="Batal"></td>
          </tr>
        </table>
        </form>


        </div>