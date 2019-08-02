<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <?php   $this->load->view("admin/layouts/header");?>
<body class="  skin-black-light sidebar-mini">
<div class="loadingpage"><img src="<?php echo base_url()?>assets/images/loading.svg"></div>
<div class="app" id="app">

 	
  	<?php   $this->load->view("admin/layouts/sidemenu");?>
  	<div id="content" class="app-content box-shadow-z0" role="main">
  		<?php 	$this->load->view("admin/layouts/topbar");?> 
  		<div ui-view class="app-body" id="view"> 
  		<?php   $this->load->view($content);?>
  		</div>
  		<?php   $this->load->view("admin/layouts/footer");?>
  	</div>

  	<div class="modal" id="alert_modal">
	  <div class="modal-dialog">
	    <div class="modal-content"> 
	      <div class="modal-body alert-msg"> 
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-default alert-cancel" data-dismiss="modal">Batal</button>
	        <button type="button" class="btn btn-sm btn-danger alert-ok">Ok</button>
	      </div>
	    </div> 
	  </div> 
	</div>
	<div class="modal" id="alert_approval">
	  <div class="modal-dialog">
	    <div class="modal-content"> 
	      <div class="modal-body alert-msg"> 
	      </div>
	      <div class="modal-footer">
	      	 <button type="button" class="btn btn-sm btn-default alert-cancel text-left" data-dismiss="modal">Cancel</button>
	        <button type="button" class="btn btn-sm btn-default alert-reject" data-dismiss="modal">Reject</button>
	        <button type="button" class="btn btn-sm btn-danger alert-approve">Approve</button>
	      </div>
	    </div> 
	  </div> 
	</div>
</div> 
</body> 

  <input type="hidden" id="base_url" value="<?php echo base_url();?>">
</html>

