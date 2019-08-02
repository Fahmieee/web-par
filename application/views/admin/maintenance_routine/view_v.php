 
<!-- Main content -->
<div class="padding-top"> 
   <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Detail Parts Perawatan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" id="form" method="POST" action="">
              <div class="box-body">
               <?php if(!empty($this->session->flashdata('message_error'))){?>
			    <div class="alert alert-danger">
			    <?php   
			       print_r($this->session->flashdata('message_error'));
			    ?>
			    </div>
			    <?php }?> 
                <input type="hidden" name="id" value="<?php echo $id;?>"> 
                 <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">Merk</label> 
                  <div class="col-sm-9"> 
                     <select name="merk" id="merk" class="form-control" disabled="">
                        <?php foreach($merk_units as $unit){?>
                          <?php if($merk == $unit->id){ ?>
                        <option value="<?php echo $unit->id;?>" selected><?php echo $unit->name;?></option>
                       <?php }else{ ?>
                        <option value="<?php echo $unit->id;?>"><?php echo $unit->name;?></option>
                      <?php }?>
                      <?php }?>
                      </select>
                  </div>
                </div> 
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 control-label">KM</label> 
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="merk" placeholder="KM" name="distance" value="<?php echo $distance;?>"  disabled="">
                  </div>
                </div>
                 <div class="form-group row">
                    <div class="col-sm-9"> 
                      <label for="inputEmail3" class="col-sm-3 control-label">Parts</label> 
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" name="" id="checkAll" class="cb-element"> Select All/Deselect All
                    </div> 
                </div> 
                <hr>
                <?php
                function isDataSelected($data,$id){ 
                  if(!empty($data)){
                    foreach ($data as $key => $value) {
                      if($id == $value->part_id){
                        return true;
                      }
                    }
                  }
                  
                  return false;
                };  
                ?>
                <div class="form-group row"> 
                  <div class="col-sm-9"> 
                    <?php foreach($parts as $part){

                      ?>
                     <div class="checkbox">
                      <label><input type="checkbox" 
                        class="cb-element-child" name="parts[]" id="parts" value="<?php echo $part->id?>"
                         <?php echo (isDataSelected($maintenance_parts,$part->id)?"checked":"")?> >
                        <?php echo $part->name;?></label>
                    </div>
                    <?php }?>
                  </div>
                </div> 
                <div class="form-group row m-t-md">
                  <div class="col-sm-12 text-right">
                    <a href="<?php echo base_url();?>maintenance_routine" class="btn btn-sm btn-default ">Batal</a>
                   
                  </div>
                </div>
                <!-- /.box-footer -->
              </div>
              <!-- /.box-body -->
            </form>
          </div> 

        </div>
        
      </div>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-maintenance-routine" src="<?php echo base_url()?>assets/js/require.js"></script>