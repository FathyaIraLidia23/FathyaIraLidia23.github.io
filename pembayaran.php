<!DOCTYPE html>
<HTML>
<HEAD>
    <title>Membuat Form</title>
</head>
<body>
<h2>Membuat Form</h2>

<form>
	<fieldset>
		<legend>Contoh Form Master Input Mahasiswa</legend>
		<table>
			<tr>
				Kode Pembayaran <br>
                <?php

$rand = rand(10000, 50000);

echo $rand;
?>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr valign="top">
				<td>Alamat</td>
				<td>:</td>
				<td><textarea name="alamat" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<input type="radio" name="jenis_kelamin" value="P"> Pria
					<input type="radio" name="jenis_kelamin" value="W"> Wanita
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input type="submit" value="Simpan"> <input type="reset" value="Reset"></td>
			</tr>
		</table>
	</fieldset>
</form>

</body>
</html>