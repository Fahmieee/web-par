<div class="padding-top">
	<div class="box">
	    <div class="item">
		    <div class="item-bg">
		      <img src="<?php echo base_url()."assets/images/photo/".$users->photo;?>" class="blur">
		    </div>
		    <div class="p-a-lg pos-rlt text-center">
		    	<?php
	            if(!empty($users->photo)){?>
	            	<div class="avatar-md">
	             		<img width="100px" src="<?php echo base_url()."assets/images/photo/".$users->photo;?>">
	             	</div>
	            <?php }else{?> 
	            	<div class="avatar-md">
	             		<img width="100px" src="<?php echo base_url()?>assets/images/default-image.jpg">
	             	</div>
	            <?php } ?>
		    </div>
		</div>
	    <div class="p-5 text-center">
	    	<a href class="text-md m-t block"><?php echo $users->first_name;?></a>
	    	<p><small><?php echo $users_groups->name;?></small></p>
	    	<form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data">
	    		<input type="file" class="" id="photo" placeholder="FOTO" name="photo_file">
		    	<button class="btn btn-sm primary" type="submit"> Change Photo </button>
	    	</form>
	    </div>
	</div>
</div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-change-password" src="<?php echo base_url()?>assets/js/require.js"></script>