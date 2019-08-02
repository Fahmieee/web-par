<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
    </style>
<div class="padding-top"> 
  <div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" id="form" method="POST" action="">
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Membuat Bengkel</h3>
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
          <div class="full-width">
            <div class="md-form-group full-width">
               <select id="rekanan" name="rekanan" class="md-input">
                <option value="0">Pilih Rekanan/Non Rekanan</option> 
                <option value="1" <?php if($rekanan == 1){ echo "selected";}?>>Rekanan</option> 
                <option value="2" <?php if($rekanan == 2){ echo "selected";}?>>Non Rekanan</option>  
              </select>
              <label for="code" class="form-control-feedback">Rekanan/Non Rekanan</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="code" name="code" autocomplete="off" required value="<?php echo $code;?>">
              <label for="code" class="form-control-feedback">Kode Bengkel</label>
            </div>
          </div> 
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="name" name="name" autocomplete="off" required value="<?php echo $name;?>">
              <label for="name" class="form-control-feedback">Nama Bengkel</label>
            </div>
          </div>   
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="phone_number" name="phone_number" autocomplete="off" required value="<?php echo $phone_number;?>">
              <label for="phone_number" class="form-control-feedback">No Telp Bengkel</label>
            </div>
          </div>  
          <div class="full-width">
            <div class="md-form-group full-width">
              <select id="area_id" name="area_id" class="md-input">
                <option value="0">Pilih Area</option> 
                <?php foreach($areas as $area){?>
                  <?php if($area->id == $area_id){?>
                    <option value="<?php echo $area->id?>" selected><?php echo $area->name;?></option> 
                  <?php }else{?>
                    <option value="<?php echo $area->id?>"><?php echo $area->name;?></option> 
                  <?php }?>
                <?php }?>
              </select>
              <label for="area" class="form-control-feedback">Area</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group full-width">
             <select id="city_id" name="city_id" class="md-input">
                <option value="0">Pilih Kota</option>
                <?php foreach($cities as $city){?> 
                 <?php if($city->id == $city_id){?>
                    <option value="<?php echo $city->id?>" selected><?php echo $city->name;?></option> 
                  <?php }else{?>
                    <option value="<?php echo $city->id?>"><?php echo $city->name;?></option> 
                  <?php }?>
                <?php }?>
              </select>
              <label for="city" class="form-control-feedback">Kota</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group   full-width">
              <textarea class="md-input" id="address" name="address" autocomplete="off" required><?php echo $address;?></textarea>
              <label for="address" class="form-control-feedback">Alamat</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="lat" name="lat" autocomplete="off" required value="<?php echo $lat;?>" readonly>
              <label for="lat" class="form-control-feedback">Latitude</label>
            </div>
          </div>
          <div class="full-width">
            <div class="md-form-group full-width">
              <input class="md-input" id="long" name="long" autocomplete="off" required value="<?php echo $long?>" readonly>
              <label for="long" class="form-control-feedback">Longitude</label>
            </div>
          </div>
          <div class="full-width">
            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
            <div id="map"></div>
          </div> 
        </div>  
      </div> 
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Spesifikasi Bengkel</h3>
        </div> 
        <div class="box-divider m-0"></div>
        <div class="box-body"> 
          <div class="full-width">
            <div class="md-form-group full-width">
              <!-- <input class="md-input" id="merk" name="merk" autocomplete="off" value="<?php echo $merk;?>"> -->
                <label for="lat" class="form-control-feedback">Merk Unit</label>
               <select name="merk" id="merk" class="form-control">
                <option value="">Pilih Merk Unit</option>
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
          <div class="full-width">
            <div class="md-form-group full-width">
              <div class="row">

                <?php 
                  function isPartSelected($part_selecteds,$part_id){ 
                    if(!empty($part_selecteds)){ 
                      foreach ($part_selecteds as $key => $parts) {
                        if($part_id == $parts->specification_id){  
                          return true;
                        }  
                      }
                      return false;
                    }
                  }
                ?>
                <?php 
                if(!empty($parts)){ 
                  foreach($parts as $part){?>
                  <div class="col-md-4 marbot-10">
                    <label class="mar-0 control control--checkbox"> 
                    <input type="checkbox" class="cb-element" name="parts[]" value="<?php echo $part->id;?>" 
                    <?php echo (isPartSelected($workshop_parts,$part->id)?"checked":"")?>>
                      <div class="control__indicator"></div><span><?php echo $part->name;?></span>
                    </label>
                  </div>
                  <?php }?>
                <?php }?>
              </div>
            </div>
          </div>
        </div>  
      </div> 
      <div class="box box-primary">
        <div class="box-header with-border full-width">
          <h3 class="box-title pull-left">Info PIC Bengkel</h3>
          <a class="btn btn-sm btn-warning pull-right" id="add-pic"><i class="fa fa-plus"></i>Tambah PIC</a>
        </div> 
        <div class="box-divider m-0"></div>
        <div class="box-body" id="pic-container"> 
          <?php foreach($workshop_pics as $pic){?>
          <div class="row">
            <div class="col-md-3">
              <div class="full-width">
                <div class="md-form-group full-width">
                  <input class="md-input" id="pic_name" name="pic_name[]" autocomplete="off" value="<?php echo $pic->name;?>">
                  <label  >Nama PIC</label>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="full-width">
                <div class="md-form-group full-width">
                  <input class="md-input" id="pic_phone" name="pic_phone[]" autocomplete="off"  value="<?php echo $pic->phone;?>">
                  <label >No Handphone</label>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="full-width">
                <div class="md-form-group full-width">
                  <input class="md-input" id="pic_email" name="pic_email[]" autocomplete="off" value="<?php echo $pic->email;?>">
                  <label >Email PIC</label>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="full-width">
                <div class="md-form-group full-width">
                  <select id="pic_cs" name="pic_cs[]" class="md-input">
                    <option value="0" <?php if($pic->is_cs == 0) echo "selected";?>>No</option>
                    <option value="1" <?php if($pic->is_cs == 1) echo "selected";?>>Yes</option>
                  </select>
                  <label >Select as CS</label>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
        </div>  
      </div> 
      <div class="box box-primary"> 
        <div class="box-body"> 
          <div class="form-group row m-t-sm">
            <div class="col-sm-12 text-right">
              <button type="submit" class="btn btn-sm btn-info uppercase" id="save-btn">Simpan</button>
              <a href="<?php echo base_url();?>workshop" class="btn btn-sm btn-danger uppercase">Batal</a>
            </div>
          </div>  
        </div>  
      </div> 
      </form>
    </div> 
  </div>
</div>
<div class="padding"></div> 
 <script data-main="<?php echo base_url()?>assets/js/main/main-workshop" src="<?php echo base_url()?>assets/js/require.js"></script>