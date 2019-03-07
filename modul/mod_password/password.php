<style type="text/css">
#info {
	border:1px solid #E78686;padding:15px;background:#FFE1E1;width:95%;color:#D22E23;text-align:center;margin:10px;
}
#info1 {
	border:1px solid #006600;padding:15px;background:#66ff99;width:95%;color:#006600;text-align:center;margin:10px;
}
</style>
<?php	
session_start();
	if ($_GET['aksi']=="ganti"){
	    if($_POST['passwordlama'] == '' && $_POST['cpassword'] == '' && $_POST['passwordbaru'] == '')
	    {
	        mysql_query("UPDATE admins SET email = '".$_POST['email']."' WHERE level='$_SESSION[level]'");
	        echo "<div id=\"info1\">Proses Pergantian Email Berhasil!</div>";
	    }
	    else if($_POST['passwordlama'] != '' || $_POST['cpassword'] != '' || $_POST['passwordbaru'] != '')
	    {
	        if($_POST['passwordbaru'] == $_POST['cpassword'])
	        {
                $sql = mysql_query("SELECT * FROM admins WHERE level='$_SESSION[level]'");
                $r = mysql_fetch_array($sql);
                $passwordlama = $r['password'];
                $id = $r['id'];
                if($_POST['passwordlama'] == $passwordlama)
                {
                    mysql_query("UPDATE admins SET password='$_POST[passwordbaru]', email='$_POST[email]' WHERE  id='$id'");
                    echo "<div id=\"info1\">Password atau Email Anda Berhasil Di Ubah</div>";
                }
                else
                {
                    echo "<div id=\"info\">Password Lama Yang Anda Masukkan Tidak Ada Dalam Database</div>";
                }
            }
            else
            {
                echo "<div id=\"info\">Proses Pergantian Email atau Password Tidak Berhasil, ulangi Kembali<br />Anda Salah Memasukkan Password Pada \"Ulangi Password Baru\"</div>";
            }   
	    }
	}
	$qdetail = mysql_query("SELECT * FROM admins WHERE level='$_SESSION[level]'");
	$detail = mysql_fetch_array($qdetail);
?>
<div class='box box-solid box-primary'>
  <div class='box-header'>
    <h3 class='box-title'>Form Edit Email dan Password</h3>
  </div>
  <div class='box-body'  style="background-color: #333333">
    <div align='center'>
      <form name='form2' method='POST' action='?module=password&aksi=ganti' id='form2' onSubmit="return validasi2(this)">
        <table width=340 align="center"  style="background-color: #333333">
          <tr>
            <td colspan="2"><small>*Kosongkan password jika hanya ingin mengganti email</small></td>
          </tr>
          <tr>
            <td>Ganti Email</td>
            <td><input type='email' name='email' style="background-color: #333333" value="<?php echo $detail['email']; ?>"></td>
          </tr>
          <tr>
            <td>Masukkan Password Lama 			</td>
            <td><input type='password' name='passwordlama'  style="background-color: #333333"></td>
          </tr>
          <tr>
            <td>Masukkan Password Baru			</td>
            <td> <input type='password' name='passwordbaru' id='passwordbaru'  style="background-color: #333333"></td>
          </tr>
          <tr>
            <td>Ulangi Password Baru  		</td>
            <td><input type='password' name='cpassword' id='cpassword'  style="background-color: #333333"></td>
          </tr>
          <tr>
            <td> 		</td>
            <td> <input type='submit' name='ganti' value='Ganti!' class='btn btn-success'></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<script>
function validasi2(form2){
  if(form2.passwordlama.value != "" || form2.passwordbaru.value != "" || form2.cpassword.value != "")
  {
    if (form2.passwordlama.value == ""){
    alert("Anda belum mengisikan Password Lama.");
    form2.passwordlama.focus();
    return (false);
  }
  if (form2.passwordbaru.value == ""){
    alert("Anda belum mengisikan Password Baru.");
    form2.passwordbaru.focus();
    return (false);
  }
  if (form2.cpassword.value == ""){
    alert("Ulangi Password Baru.");
    form2.cpassword.focus();
    return (false);
  }
  return (true);   
  }
  else
  {
      return (true);   
  }
}	
</script>
