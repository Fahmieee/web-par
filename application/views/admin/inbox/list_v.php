 <style type="text/css">
   .list-item{
    padding: 10px !important;
    margin-bottom: 10px !important;
   }

   .read{
    background-color: #e6fcf7; 
   }
 </style>
<div class="padding-top">
  <div class="box">  
    <div class="box-body">

      <!-- for dispatcher task -->
      <?php 
      if (!empty($task_notifications)):
        foreach ($task_notifications as $key => $notification): ?> 
        <li class="list-item">
          <a herf="" class="list-left">
            <span class="w-40 circle blue">
              <i class="fa fa-calendar"></i>
            </span>
          </a>
          <div class="list-body">
            <div class="col-sm-12 form-group row">
                <div class="col-sm-4"><a href="">PPJK Service</a></div>
                <div class="col-sm-8"> 
                    
                </div>
                <div class="col-sm-12">
                    <small class="text-muted text-ellipsis">H<?php echo $notification->diff ?> PPJK No. : <?php echo $notification->ppjk_no ?> Akan Dimulai</small>
                </div>
            </div>  
          </div>
        </li>
        <?php endforeach?>
      <?php endif ?>

      <?php 
      if (!empty($all_notifications)):
        foreach ($all_notifications as $key => $notification): 

          $is_read = "";
          if($notification->is_read == 0){
            $is_read = "read";
          }
          ?> 
        <li class="list-item <?php echo $is_read;?>">
          <a herf="" class="list-left">
            <span class="w-40 circle blue">
              <i class="fa fa-exclamation"></i>
            </span>
          </a>
          <div class="list-body">
            <div class="col-sm-12 form-group row">
                <div class="col-sm-4">
                  <?php if($notification->category =="WORKSHOP"){?>
                    <a id="<?php echo $notification->id;?>" url="<?php echo base_url()?>workshop/detail/<?php echo $notification->reference_id ?>" class="item-notif">
                      <?php echo $notification->title ?>
                    
                    </a>
                  <?php }elseif($notification->category =="WORKSHOP"){?>
                     <a id="<?php echo $notification->id;?>" url="<?php echo base_url()?>workshop/detail/<?php echo $notification->reference_id ?>" class="item-notif">
                      <?php echo $notification->title ?>
                      
                    </a>  
                  <?php }elseif($notification->category =="DRIVER"){?>
                    <a id="<?php echo $notification->id;?>" url="<?php echo base_url()?>driver/detail/<?php echo $notification->reference_id ?>" class="item-notif">
                      <?php echo $notification->title ?>
                    
                    </a>
                  <?php }elseif($notification->category =="ORDER"){?>
                      <a id="<?php echo $notification->id;?>" url="<?php echo base_url()?>maintenance_request/view_wo/<?php echo $notification->reference_id;?>"
                        class="item-notif">
                        <?php echo $notification->title;?> 
                      </a>
                  <?php }elseif($notification->category =="PREORDER"){?>
                     <a id="<?php echo $notification->id;?>" url="<?php echo base_url()?>preorder/view_preorder/<?php echo $notification->reference_id ?>"
                      class="item-notif"> 
                      <?php echo $notification->title ?></a> 

                  <?php }?>
                </div>
                
                <div class="col-sm-12">
                    <small class="text-muted text-ellipsis"><?php echo $notification->message ?></small>
                </div>
            </div>  
          </div>
        </li>
        <?php endforeach?>
      <?php else: ?>
        <p class="text-center grey-100">There's no notification</p>
      <?php endif ?>
        
    </div>
  </div> 
</div>   
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-notification" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>