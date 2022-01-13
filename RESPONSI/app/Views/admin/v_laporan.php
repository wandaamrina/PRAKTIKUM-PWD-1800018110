
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pembayaran</title>
	
	<style >
		body{
			font-family: arial;
		}
		
		}
		table{
			border-collapse: collapse;
		}
	</style>
</head>
<body onload="window.print()">
	<h3>BARKAS AMANAH<b><br/>LAPORAN PENJUALAN BUKET</b></h3>
	<br/>
	<hr/>
	<!-- Tanggal  -->
	<br/>
	<br>
	<table border="1" cellspacing="" cellpadding="4" width="100%">
	<tr>
		<th>NO</th>
		<th>NAMA BUKET</th>
		<th>HARGA</th>
		<th>PEMILIK</th>
		<th>KONTAK</th>
		<th>STATUS</th>
		<th>TANGGAL DAFTAR</th>
	</tr>
	<?php
    $i = 1; 
    foreach ($buket as $dta) {
	 ?>
	<tr>
		<td align="center"><?= $i ?></td>
		<td align="center"><?= $dta['buket_nama'] ?></td>
		<td align="center"><?php echo 'Rp '.number_format($dta['buket_harga'] ,2,',','.'); ?></td>
		<td align="center"><?= $dta['buket_pemilik'] ?></td>
		<td align="center"><?= $dta['buket_kontak'] ?></td>
		<td align="center"><?= $dta['buket_status'] ?></td>
		<td align="center"><?= $dta['buket_created'] ?></td>
	</tr>
	<?php $i++; ?>

<?php } ?>
    <tr>
		<td colspan="7" align="right">TOTAL <?php echo 10*($i-1); ?> <?php echo 'Rp '.number_format(10000*($i-1) ,2,',','.'); ?></td>
	</tr>
	</table>
<table width="100%">
	<tr>
		<td></td>
		<td width="200px">
			<BR/>
			<p>Yogyakarta , <?= date('d/m/y') ?> <br/>
				Operator,
			<br/>
			<br/>
			<br/>
		<p>__________________________</p>
		</td>
	</tr>
</table>
</body>
</html>