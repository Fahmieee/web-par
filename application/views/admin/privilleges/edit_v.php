<div class="padding-top">
  <div class="row"> 
    <div class="col-md-12"> 
      <form class="form-horizontal" id="form" method="POST" action="">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Privilege</h3>
          </div>
          <div class="box-divider m-0"></div>
          <div class="box-body">
            <?php if(!empty($this->session->flashdata('message_error'))){?>
            <div class="alert alert-danger">
            <?php   
             print_r($this->session->flashdata('message_error'));
            ?>
            </div>
            <?php }?>
            <input type="hidden" name="id" value="<?php echo $id;?>"> 
            <input type="hidden" id="group_id_selected" value="<?php echo $group_id;?>"> 
            <input type="hidden" id="role_id_selected" value="<?php echo $role_id;?>">
            <div class="full-width">
              <div class="md-form-group full-width">
                <select id="area_id" name="area_id" class="md-input">
                  <option value="">Pilih Area</option>
                  <?php
                  foreach ($areas as $key => $area) { ?>
                  <?php if($area->id == $area_id){?>
                  <option value="<?php echo $area->id?>" selected><?php echo $area->name;?></option>
                  <?php }else{?>
                  <option value="<?php echo $area->id?>"><?php echo $area->name;?></option>
                  <?php }?> 
                 
                  <?php }
                  ?>
                </select>
                <label for="area_id" class="form-control-feedback">Area</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group full-width">
                <select id="group_id" name="group_id" class="md-input">
                  <option value="">Pilih Grup</option> 
                </select>
                <label for="group_id" class="form-control-feedback">Departemen</label>
              </div>
            </div>
            <div class="full-width">
              <div class="md-form-group full-width">
                <select id="role_id" name="role_id" class="md-input">
                  <option value="">Pilih Role</option>
                </select>
                <label for="role_id" class="form-control-feedback">Pilih Jabatan</label>
              </div>
            </div>
          </div> 
        </div>   
        <div class="box box-primary">  
          <div class="box-header with-border">
            <div class="col-sm-10"><h3 class="box-title">Menu</h3></div>
            <div class="col-sm-2">
               <div class="checkbox"> 
                
                </div> 
            </div>
          </div>
          <div class="box-body">  
              <table class="table table-striped">
                <thead>
                  <th style="width:70px"> <label class="mar-0 control control--checkbox"><input type="checkbox" id="checkAll"><div class="control__indicator" style="top:-15px;"></div></label ></th>
                  <th>Menu</th>
                  <th>Fungsi</th>
                </thead>
                <?php  

                function isMenuSelected($menu_selecteds,$menu_id){
                  foreach ($menu_selecteds as $key => $value) {
                    if($menu_id == $value['menu_id'] && count($value['functions']) >= 5){
                      return true;
                    }
                  }
                  return false;
                };  
                function isMenuFunctionSelected($menu_selecteds,$menu_id,$function_id){ 
                  foreach ($menu_selecteds as $key => $menus) {
                    if($menu_id == $menus['menu_id']){ 
                      foreach ($menus['functions'] as $key => $function) {  
                        if($function_id == $function['id']){
                          return true;
                        } 
                      }
                    }
                  }
                  return false;
                }; 

                 
                foreach($menus as $key => $data_menu){?>
                  <tr>
                    <td class="valign-mid"> 
                      <label class="mar-0 control control--checkbox"> 
                        <input type="checkbox" class="cb-element" name="menus[]" 
                        value="<?php echo $data_menu['id'];?>" 
                        <?php echo (isMenuSelected($menu_selecteds,$data_menu['id'])?"checked":"")?>><div class="control__indicator" style="top:-8px;"></div>
                      </label  > 
                    </td class="valign-mid">
                    <td> <span class="valign-mid"><?php echo $data_menu['name'];?></span>
                      <div class="btn-group dropdown pull-right padright-15 borright-soft-grey">
                      <button class="btn white dropdown-toggle btn-sm hide-caret" data-toggle="dropdown">Pilih Fungsi</button>
                      <div class="dropdown-menu dropdown-menu-form dropdown-menu-scale pull-right">
                        <?php    
                          foreach($data_menu['functions'] as $function){   
                            ?> 
                             <label class="col-12 control control--checkbox">
                              <span class="pull-left fsize-14 padleft-10"><?php echo $function['name']?> </span>
                              <input type="checkbox" class="cb-element-child" 
                              name="functions[<?php echo $data_menu['id'];?>][]" 
                              value="<?php echo $function['id']?>"
                              <?php echo (isMenuFunctionSelected($menu_selecteds,$data_menu['id'],$function['id'])?"checked":"")?>>
                              <div class="control__indicator no-bg-right"></div>
                            </label> 
                          <?php  }?>
                          </div>
                        </div>
                        </td>
                        <td class="valign-mid">
                       <?php    
                          foreach($data_menu['functions'] as $function){   
                              
                            if(
                              (isMenuFunctionSelected($menu_selecteds,$data_menu['id'],$function['id']))
                            ){
                        ?>
                          <span class="label fsize-14 w-normal marright-5 text-black">
                              <?php echo $function['name']?>
                            </span>
                          <?php }?> 
                      <?php  }?>   
                    </td>
                  </tr>
                <?php }?>
              </table> 
              <div class="form-group row m-t-md">
                <div class="col-sm-12 text-right">
                  <button type="submit" class="btn btn-sm btn-info uppercase" id="save-btn">Simpan</button>
                  <a href="<?php echo base_url();?>privilleges" class="btn btn-sm btn-danger uppercase">Batal</a>
                </div>
              </div>
          </div>  
        </div>  
      </form>
    </div> 
  </div>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-privilleges" src="<?php echo base_url()?>assets/js/require.js"></script>