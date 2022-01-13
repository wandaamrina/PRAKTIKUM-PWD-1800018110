<!DOCTYPE html>
<html>
<head>
	<title>PENCARIAN Mahasiswa</title>
	<style type="text/css">
		* {
			font-family: "Trebuchet MS";
		}
		h1 {
			text-transform: uppercase;
			color: purple;
		}
		table {
			border: 1px solid #ddeeee;
			border-collapse: collapse;
			border-spacing: 0;
			width: 70%;
			margin: 10px auto 10px auto;
		}
		th, td {
			border: 1px solid #ddeeee;
			padding: 20px;
			text-align: left;
		}
	</style>
</head>
<body>
	<center><h1>Pencarian mahasiswa</h1></center>
	<form method="GET" action="index.php" style="text-align: center;">
		<label>Kata Pencarian : </label>
		<input type="text" name="kata_cari" value="<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>"  />
		<button type="submit">Cari</button>
	</form>
	<table>
		<thead>
			<tr>
				<th>Nim</th>
				<th>nama</th>
				<th>jenis kelamin</th>
				<th>alamat</th>
				<th>tanggal lahir</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//untuk meinclude kan koneksi
			include('koneksi.php');

				//jika kita klik cari, maka yang tampil query cari ini
				if(isset($_GET['kata_cari'])) {
					//menampung variabel kata_cari dari form pencarian
					$kata_cari = $_GET['kata_cari'];

					//jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
					//jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
					$query = "SELECT * FROM mahasiswa WHERE nim like '%".$kata_cari."%' OR nama like '%".$kata_cari."%' OR jkel like '%".$kata_cari."%' ORDER BY nim ASC";
				} else {
					//jika tidak ada pencarian, default yang dijalankan query ini
					$query = "SELECT * FROM mahasiswa ORDER BY nim ASC";
				}
			
				

				$result = mysqli_query($con, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($con)." - ".mysqli_error($con));
				}
				//kalau ini melakukan foreach atau perulangan
				while ($row = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td><?php echo $row['nim']; ?></td>
				<td><?php echo $row['nama']; ?></td>
				<td><?php echo $row['jkel']; ?></td>
				<td><?php echo $row['alamat']; ?></td>
				<td><?php echo $row['tgllhr']; ?></td>
			</tr>
			<?php
			}
			?>

		</tbody>
	</table>
</body>
</html>