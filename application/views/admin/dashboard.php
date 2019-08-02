<div ui-view class="app-body" id="view">
  	<div class="pad-25">
	    <div class="row marbot-20"> 
  			<div class="col-sm-8">
		        <div class="box p-a"> 
		          <div class="clear">
		  				<div id="monthly" style="min-width: 310px; height: 270px; margin: 0 auto"></div>
		          </div>
		        </div>
		    </div>
		    <div class=" col-sm-4">
		    	<div class=" col-sm-12" style="min-height: 100px;">
			        <div class="box p-a"> 
	                    <div style="float:left;">
	                    	<span><?php echo $jumlah_perawatan?></span> <br>
			          		<span>Permintaan Perawatan</span>	
	                    </div> 
				   		<img src="<?php echo base_url();?>assets/images/icon-wrench.png">
			        </div>
			    </div> 
			    <div class=" col-sm-12"  style="min-height: 100px;">
			        <div class="box p-a">
	                    <div style="float:left;">
	                    	<span><?php echo $jumlah_perbaikan?></span> <br>
			          		<span>Permintaan Perbaikan</span>	
	                    </div> 
			        	<img src="<?php echo base_url();?>assets/images/icon-wrench.png">
			        </div>
			    </div> 
			     <div class=" col-sm-12"  style="min-height: 100px;">
			        <div class="box p-a">
	                    <div style="float:left;">
	                    	<span><?php echo $jumlah_darurat?></span> <br>
			          		<span>Permintaan Darurat</span>	
	                    </div> 
			        	<img src="<?php echo base_url();?>assets/images/icon-wrench.png">
			        </div>
			    </div> 
		    </div>
		    <div class="col-sm-6">
		        <div class="box p-a"> 
		        	<p><b>&nbsp;  &nbsp;</b></p>
		          <div class="clear">
		  				<div id="week" style="min-width: 310px; height: 270px; margin: 0 auto"></div>
		          </div>
		        </div>
		    </div>
		    <div class="col-sm-6">
		        <div class="box p-a"> 
		        	<p><b>Total Today : <?php echo $total_today;?></b></p>
		          	<div class="clear">
		  				<div id="today" style="min-width: 310px; height: 270px; margin: 0 auto"></div>
		          	</div>
		        </div>
		    </div>
		</div> 
	    <div class="box">
	      	<div class="box-body">
	      		<div class="table-responsive">
	        	 <table class="table table-striped" id="table-dashboard">
	        	 	<thead>
	        	 		<tr>
	        	 			<th>No Work Order</th>
	        	 			<th>Date</th>
	        	 			<th>Maintenance</th>
	        	 			<th>Nama Bengkel</th>
	        	 			<th>Nama Driver</th> 
	        	 			<th>No Polisi</th>
	        	 			<th>Merk</th>
	        	 			<th>Model</th> 
	        	 			<th>Total</th> 
	        	 			<th>Status</th>
	        	 		</tr>
	        	 	</thead> 
	        	 </table>
	        	</div>
	      	</div>
	    </div>
	</div> 
</div>  
<div class="padding"></div>

 <script data-main="<?php echo base_url()?>assets/js/main/main-dashboard" src="<?php echo base_url()?>assets/js/require.js"></script>