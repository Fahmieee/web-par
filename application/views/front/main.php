<!DOCTYPE html>
<html lang="en">
    <head>
		<title>PT Pelabuhan Cilegon Mandiri</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="icon" type="image/png" href="<?php echo base_url()?>assets/images/frontend/favicon.png" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/frontend/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/frontend/responsive.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap/dist/css/bootstrap-table.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/fonts/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/fonts/gotham/GothamNarrow.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/material-design-icons.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2/select2.min.css">

		<script src="<?php echo base_url()?>assets/plugins/jquery/dist/jquery.js"></script>
		<script src="<?php echo base_url()?>assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url()?>assets/plugins/datatables/bootstrap-table.js"></script>
		<script src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url()?>assets/plugins/select2/select2.min.js"></script>
		
	</head>

	<body>
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 brand">
						<div class="row">
							<img src="<?php echo base_url()?>assets/images/pcm.png">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<p class="main-title">Jadwal Pelayanan PT. PCM</p>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<div class="bg">
			<div class="container padtopbot-20">
				<div class="row">
					<div class="bg-transparent">
						<div class="bg-white">
							<div class="box-title">
								<p class="pull-left m-none">PPJK Information</p>
								<button class="btn btn-sm btn-default pull-right btn-sm btn-responsive" id="btn_adv_search">Change to Advance Search</button>
							</div>
							<form class="col-12 padtopbot-20" action="" method="POST">
								<div class="row">
									<div class="full-width">
										<div class="box-collapse">
											<div class="row">
												<div class="col-sm-6">
													<select class="form-control mbot-15" name="tugs_name" data-selectjs="true">
														<option value="" disabled selected hidden>Tug Boats</option>
														<?php foreach ($pandus as $key => $value): ?>
															<option value="<?php echo $value->first_name?>"><?php echo $value->first_name?></option> 
														<?php endforeach ?> 
													</select>
												</div>
												<div class="col-sm-6">
													<select class="form-control mbot-15" name="ppjk_status">
														<option value="" disabled selected hidden>Status</option>
														<option value="0">PROGRESS</option>
														<option value="1">DONE</option>
														<option value="2">REJECTED</option>
													</select>
												</div>
												<div class="col-sm-6" data-datepicker="true">
													<input type="text" name="sliptime_start_from" class="form-control mbot-15" placeholder="Dari Tanggal">
												</div>
												<div class="col-sm-6" data-datepicker="true">
													<input type="text" name="sliptime_start_to" class="form-control mbot-15" placeholder="Sampai Tanggal">
												</div>
											</div>
										</div>
										<div class="box-search">
							  				<i class="fa fa-search icon-float"></i>
							    			<input type="text" class="form-control padleft-50" id="search" name="search_general" placeholder="Silahkan input PPJK No, Nama Kapal, Nama Agen">
							    		</div>
									  	<button type="submit" class="btn btn-sm btn-primary btn-search bolder" style="height: 37px;">SEARCH</button>
								  	</div>
							  	</div>
							</form>
							<div class="tab-responsive">
								<table class="table-blue" data-toggle="table">
									<thead>
										<tr>
											<th data-sortable="true">DATE</th>
											<th data-sortable="true">TIME</th>
											<th data-sortable="true">CALL SIGN AGENT</th>
											<th data-sortable="true">VESSEL NAME</th>
											<th data-sortable="true">JETTY</th>
											<th data-sortable="true">STATUS</th>
											<th data-sortable="true">JOB ORDER</th>
											<th data-sortable="true">TUG BOAT</th>
											<th data-sortable="true">CALL SIGN PILOT</th>
											<th data-sortable="true">remark</th>
										</tr>
									</thead>
									<tbody>
										<?php if (empty($schedules)): ?>
											<tr>
												<td colspan="10">Data tidak ditemukan!</td>
											</tr>
										<?php else: ?>
											<?php foreach($schedules as $data){?>
											<tr>
												<td><?php echo date("d/m/Y",strtotime($data->sliptime_start));?></td>
												<td><?php echo date("H:i",strtotime($data->sliptime_start));?></td>  
												<td><?php echo $data->call_sign;?></td>
												<td> <?php echo $data->ship_name;?></td> 
												<td> <?php echo $data->origin_port_name;?></td>
												<td>
													<?php echo $data->job_order_status;?>
													<!-- <?php if ($data->shipping_type == 1): ?>
														<img src="<?php echo base_url()?>assets/images/flag/berthing.svg" width="10px"> <?php echo $data->shipping_type_name;?>
													<?php elseif ($data->shipping_type == 3): ?>
														<img src="<?php echo base_url()?>assets/images/flag/shifting.svg" width="10px"> <?php echo $data->shipping_type_name;?>
													<?php elseif ($data->shipping_type == 2): ?>
														<img src="<?php echo base_url()?>assets/images/flag/unberthing.svg" width="10px"> <?php echo $data->shipping_type_name;?>
													<?php else: ?>
														<img src="<?php echo base_url()?>assets/images/flag/urgent.svg" width="10px"> <?php echo $data->shipping_type_name;?>
													<?php endif ?> -->
												</td> 
												<td> 
												 
													<?php if ($data->shipping_type == 1): ?>
														<img src="<?php echo base_url()?>assets/images/flag/berthing.svg" width="10px"> <?php echo $data->shipping_type_name;?>
													<?php elseif ($data->shipping_type == 2): ?>
														<img src="<?php echo base_url()?>assets/images/flag/unberthing.svg" width="10px"> <?php echo $data->shipping_type_name;?>
													<?php elseif ($data->shipping_type == 3): ?>
														<img src="<?php echo base_url()?>assets/images/flag/shifting.svg" width="10px"> <?php echo $data->shipping_type_name;?>
													<?php else: ?>
														<img src="<?php echo base_url()?>assets/images/flag/urgent.svg" width="10px"> <?php echo $data->shipping_type_name;?>
													<?php endif ?>
												</td>

												<td><i class="material-icons">&#xe532;</i> <?php echo $data->tunda_code;?></td>
												<td> <?php echo $data->pandu_call_sign;?></td>
												<td>-</td> 
											</tr>
											<?php }?>
										<?php endif ?>
										 
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$("#btn_adv_search").click(function(){
			    $(".box-collapse").toggle(100);
			});
			$('*[data-datepicker="true"] input[type="text"]').datepicker({
				format: 'dd MM yyyy',
				todayBtn: true,
				orientation: "bottom left",
				autoclose: true,
				todayHighlight: true
			});
			$('*select[data-selectjs="true"]').select2({width: '100%', theme: 'frontend'});
		</script>
	</body>

</html>