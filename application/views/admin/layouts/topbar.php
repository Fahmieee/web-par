<div class="app-header white box-shadow">
  <div class="navbar navbar-toggleable-sm flex-row align-items-center pad-0">
    <!-- Open side - Naviation on mobile -->
      <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
        <i class="material-icons">&#xe5d2;</i>
      </a>  
      <!-- navbar left -->
      <ul class="nav navbar-nav mr-auto padleft-25">
        <li class="nav-item">

         
          <?php    
          if($parent_page_name!="root"){
            if($path_active_name == "report/detailworkshop"){
              echo '<span class="fsize-18 bolder marright-5"> History Pelayanan |</span>  
                    <span class="text-grey fsize-18 bolder cut-text"> History Pelayanan Bengkel</span>';
            }elseif($path_active_name == "report/review_periodik"){
              echo '<span class="fsize-18 bolder marright-5"> History Pelayanan |</span>  
                     <span class="text-grey fsize-18 bolder cut-text"> History Pelayanan Driver</span>';
            }elseif($path_active_name == "report/detailorder"){
              echo '<span class="fsize-18 bolder marright-5"> History Pelayanan |</span>  
                      <span class="text-grey fsize-18 bolder cut-text"> History Pelayanan</span>';
            }elseif($path_active_name == "maintenance_request/view_wo"){
              echo '<span class="fsize-18 bolder marright-5"> Maintenance Service |</span>  
                    <span class="text-grey fsize-18 bolder cut-text"> Detail Work Order</span>';
            }elseif($path_active_name == "maintenance_request/create_wo"){
              echo '<span class="fsize-18 bolder marright-5"> Maintenance Service |</span>  
                      <span class="text-grey fsize-18 bolder cut-text"> Form Create Work Order</span>';
            }elseif($path_active_name == "preorder/view_preorder"){
              echo '<span class="fsize-18 bolder marright-5"> Maintenance Service  |</span>  
                    <span class="text-grey fsize-18 bolder cut-text"> Detail Pre Order</span>';
            }else{
              echo ' <span class="fsize-18 bolder marright-5">'.$parent_page_name.
              ' | </span>  <span class="text-grey fsize-18 bolder cut-text">'.$page.'</span>'
              ;
            }
          }  
          ?></span>
         </li>
      </ul>
      <!-- navbar right -->
      <ul class="nav navbar-nav ml-auto flex-row height-56"> 
        <li class="nav-item dropdown">
          <span class="avatar w-32 pull-left marright-5 martop-15">
            <?php
            if(!empty($users->photo)){?>
              <img src="<?php echo base_url()?>assets/images/photo/<?php echo $users->photo;?>" alt="..."> 
            <?php }else{?> 
              <img src="<?php echo base_url()?>assets/images/default-image.png" alt="..."> 
             <?php }
            ?>
           
          </span>
          <span class="header-name pull-left marright-15 martop-15">
            <span class="fullname"><?php echo $users->first_name;?></span>
            <span class="rolename"><?php echo $users_groups->name;?></span>
          </span>
          <div class="btn-group dropdown pull-left">
            <a class="header-dropdown dropdown-toggle height-56" data-toggle="dropdown"></a>
              <div class="dropdown-menu dropdown-menu-scale pull-right" style="position: absolute;float:right;">
                <a class="dropdown-item" href="<?php echo base_url();?>inbox">Inbox <span class="label warn m-l-xs"><?php echo (!empty($notifications))?count($notifications):0;?></span></a>
                <a class="dropdown-item" href="<?php echo base_url();?>profile">Profile</a>
                <a class="dropdown-item" href="<?php echo base_url();?>profile/change_photo">Change Profile Photo</a>
                <a class="dropdown-item" href="<?php echo base_url();?>profile/change_password">Change Password</a>
                <a class="dropdown-item" href="<?php echo base_url();?>auth/logout">Logout</a> 
              </div>
            </div>
          </li>
        </ul>
        <!-- / navbar right -->
    </div>
</div>