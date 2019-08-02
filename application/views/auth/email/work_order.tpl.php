<html>
<head>
	<style>
		table, td, th { 
			border: 1px solid black;
			 border-collapse: collapse;
		}
		.table td{
			padding:10px;
		}
	</style>
</head>
<body>
	 <table class="table">
	 	<tr>
	 		<td><img src="<?php echo base_url();?>assets/images/logo.png"></td>
	 		<td>WORK ORDER</td>
	 		<td>
	 			<p>Order No : <?php echo $orders[0]->order_no;?> </p>
	 			<p>WO No :<?php echo $orders[0]->order_wo_no;?> </p>
	 			<p>TANGGAL:<?php echo $orders[0]->order_date;?> </p>

	 		</td>
	 	</tr>
	 	<tr>
	 		<td colspan="3"> 	
	 			<p>Kepada : <?php echo $workshops[0]->name;?> </p>
	 			<p>Dari : PT. PRIMA ARMADA RAYA - Patra jasa office Tower Lantai 1 </p> 
	 		</td>  
	 	</tr>
	 	<tr>
	 		<td colspan="3"> 	
	 			 Dengan Hormat,<br>
	 			 Bersama ini kami kirimkan kendaraan Agar diadakan pemeriksaan untuk <?php 
	 			 if($orders[0]->service_type== "treatment"){
	 			 	echo "Perawatan";
	 			 }else if($orders[0]->service_type== "repair"){
	 			 	echo "Perbaikan";
	 			 } else{
	 			 	echo "Darurat";
	 			 }
	 			 ?>:
	 			 <br>
	 			 <?php foreach($parts as $part){?>
	 			 	<p><?php echo $part->part_name;?></p>
	 			 <?php }?>
	 		</td>  
	 	</tr>
	 </table>
</body>
</html>