<!-- Main content -->
<div class="padding-top"> 
  <form class="form-horizontal" id="form" method="POST" action="">
  <div class="row">   
    <div class="col-md-12"> 
      <div class="box box-primary">  
         <div class="box-header">
          <h2>Work Order</h2> 
        </div>
        <div class="box-body">
          <?php if(!empty($this->session->flashdata('message_error'))){?>
          <div class="alert alert-danger">
            <?php   
               print_r($this->session->flashdata('message_error'));
            ?>
          </div>
          <?php }?>  
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="hidden"  class="md-input" id="order_id" name="order_id" value="<?php echo $orders->id;?>">
              <input type="text" class="md-input" id="order_no" name="order_no" value="<?php echo $orders->order_no?>" readonly>
              <label for="area_id" class="form-control-feedback">Nomor Order</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text" class="md-input" id="order_date" name="order_date" value="<?php echo date("Y-m-d",strtotime($orders->order_date))?>" readonly>
              <label for="area_id" class="form-control-feedback">Tanggal Order</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text" class="md-input" id="order_wo_no" name="order_wo_no" value="<?php echo $orders->order_wo_no?>" readonly>
              <label for="area_id" class="form-control-feedback">Nomor Work Order</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text" class="md-input" id="order_time" name="order_time" value="<?php echo date("h:i:s",strtotime($orders->order_date))?>" readonly>
              <label for="area_id" class="form-control-feedback">Waktu Order</label>
            </div>
          </div> 
        </div>  
      </div>
    </div> 
    <div class="col-md-12"> 
      <div class="box box-primary">  
         <div class="box-header">
          <h2>Bengkel Tujuan</h2> 
        </div>
        <div class="box-body"> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="workshop_name" name="workshop_name" value="<?php echo $workshops->name;?>" readonly>
              <label for="area_id" class="form-control-feedback">Nama Bengkel</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="workshop_area" name="workshop_area" value="<?php echo $workshops->area_name;?>" readonly>
              <label for="area_id" class="form-control-feedback">Area Bengkel</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="workshop_address" name="workshop_address" value="<?php echo $workshops->address;?>" readonly>
              <label for="area_id" class="form-control-feedback">Alamat Bengkel</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="workshop_city" name="workshop_city" value="<?php echo $workshops->city_name;?>" readonly>
              <label for="area_id" class="form-control-feedback">Kota Bengkel</label>
            </div>
          </div> 
        </div>  
      </div>
    </div> 
     <div class="col-md-12">
      <div class="box box-primary"> 
        <div class="box-header with-border"> 
            <h2> Informasi Estimasi </h2> 
        </div>   
        <div class="box-body">  
          <div class="full-width">
            <div class="form-group row m-t-md"> 
              <div class="col-sm-6">
                <div class="full-width text-center">
                  <div class="md-form-group col-sm-12">
                  <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off"  readonly="" value="<?php echo $orders->est_biaya_part?>" >
                    <label for="branch" class="form-control-feedback">Estimasi Biaya Part(IDR)</label>
                  </div>
                </div>  
                <div class="full-width text-center">
                  <div class="md-form-group col-sm-12">
                  <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off"  readonly="" value="<?php echo $orders->est_biaya_jasa?>" >
                    <label for="branch" class="form-control-feedback">Estimasi Biaya Jasa (IDR)</label>
                  </div>
                </div>   
                <div class="full-width text-center">
                  <div class="md-form-group col-sm-12">
                  <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off"  readonly="" value="<?php echo $orders->est_biaya_maintenance . ' Jam'?>" >
                    <label for="branch" class="form-control-feedback">Estimasi Waktu</label>
                  </div>
                </div>   
                <div class="full-width text-center">
                  <div class="col-sm-6">
                    <a href="<?php echo base_url('./assets/images/bukti_estimasi/' . $orders->file) ?>" target="_blank" class="btn btn-primary">Download File</a>
                  </div>
                </div>   
              </div>  
            </div>
          </div>  
        </div>  
      </div>
    </div> 
    <div class="col-md-12"> 
      <div class="box box-primary">  
         <div class="box-header">
          <h2>Informasi kendaraan</h2> 
        </div>
        <div class="box-body"> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="unit_branch" name="unit_branch" value="<?php echo $units->branch_name;?>" readonly>
              <label for="area_id" class="form-control-feedback">Cabang</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="merk" name="merk" value="<?php echo $units->produk_name;?>" readonly>
              <label for="area_id" class="form-control-feedback">Merk</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="unit_type" name="unit_type" value="<?php 
                  if($units->type_unit == 1){
                    echo "Dedicated";
                  }else{
                    echo "Pool";
                  }
              ?>" readonly>
              <label for="area_id" class="form-control-feedback">Tipe Unit</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="model" name="model" value="<?php echo $units->model;?>" readonly>
              <label for="area_id" class="form-control-feedback">Model</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="asset_type" name="asset_type"
              value="<?php 
                  if($units->type_assets == 1){
                    echo "PAR";
                  }else{
                    echo "Vendor";
                  }
              ?>" readonly>
              <label for="area_id" class="form-control-feedback">Tipe Aset</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="varian" name="varian" value="<?php echo $units->varian;?>" readonly>
              <label for="area_id" class="form-control-feedback">Varian</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="no_police" name="no_police" value="<?php echo $units->no_police;?>" readonly>
              <label for="area_id" class="form-control-feedback">No Polisi</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="year" name="year" value="<?php echo $units->years;?>" readonly>
              <label for="area_id" class="form-control-feedback">Tahun</label>
            </div>
          </div> 
          <div class="form-group row  col-sm-12">
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="mileage" name="mileage" value="<?php echo $units->mileage;?>" readonly>
              <label for="area_id" class="form-control-feedback">Jarak Tempuh (KM)</label>
            </div>
            <div class="md-form-group  col-sm-6">
              <input type="text"  class="md-input" id="stnk_due_date" name="stnk_due_date" value="<?php echo $units->stnk_due_date;?>" readonly>
              <label for="area_id" class="form-control-feedback">Masa STNK</label>
            </div>
          </div> 
        </div>  
      </div>
    </div>  
     <div class="col-md-12">
      <div class="box box-primary"> 
        <div class="box-header with-border"> 
          <div class="col-sm-12 row">
              <div class="col-sm-6">
                Last Maintenance
              </div>
              <div class="col-sm-6">
                Request Maintenance
              </div>
          </div>
        </div>   
        <div class="box-body">  
          <div class="full-width">
            <div class="form-group row m-t-md">
                 <div class="col-sm-6">
                <div class="col-sm-12 row text-center">
                  <div class="md-form-group col-sm-6">
                    <input class="md-input" id="no_order" name="no_order" autocomplete="off" readonly=""  value="<?php 
                      if($lastOrder->service_type == "treatment"){
                        echo "Perawatan";
                      }else{
                        echo "Repair";
                      }
                    ?>">
                    <label for="branch" class="form-control-feedback">Jenis Maintenance</label>
                  </div>
                  <div class="md-form-group col-sm-6">
                    <input class="md-input" id="no_order" name="no_order" autocomplete="off" readonly=""  value="<?php echo date("d F Y", strtotime($lastOrder->order_date));?>">
                    <label for="branch" class="form-control-feedback">Tanggal Maintenance</label>
                  </div>
                </div>  
                <div class="col-sm-12 full-width text-center">
                  <div class="col-sm-4">
                    <p><b>Unit Yang diperiksa</b></p> 
                  </div>
                  <div class="col-sm-2">
                      <ol>
                        <?php foreach($lastOrder->parts as $part){?>
                          <li><b><?php echo $part->part_name;?></b></li> 
                        <?php }?>
                      </ol>
                  </div>
                </div>   
              </div>
              <div class="col-sm-6">
                <div class="full-width text-center">
                  <div class="md-form-group col-sm-12">
                  <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off"  readonly="" value="<?php echo $maintenance->distance;?>" >
                    <label for="branch" class="form-control-feedback">Jenis Maintenance</label>
                  </div>
                </div>  
                <div class="full-width text-center">
                  <div class="col-sm-4">
                    <p><b>Unit Yang diperiksa</b></p> 
                  </div>
                  <div class="col-sm-2">
                      <ol>
                        <?php foreach($parts as $part){?>
                          <li><b><?php echo $part->name;?></b></li> 
                        <?php }?>
                      </ol>
                  </div>
                </div>  

                <div class="full-width text-center">
                  <div class="md-form-group col-sm-12">
                    <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off" required value="Perbaikan" readonly="">
                    <label for="branch" class="form-control-feedback">Jenis Maintenance</label> 
                  </div>
                </div>  
                <div class="full-width text-center">
                  <div class="col-sm-4">
                    <p><b>Unit Yang diperiksa</b></p> 
                  </div>
                  <div class="col-sm-12">
                       <ol>
                         <?php foreach($part_repairs as $part){?>
                          <div class="row col-sm-12">
                            <div class="col-sm-3"> <p><b><?php echo $part->part_name;?></b></p> </div>
                            <div class="col-sm-6">  
                                <a href="<?php echo base_url()?>assets/images/repair/<?php echo $part->file;?>" target="_blank">
                                  <span class="fa fa-image"></span>  
                                </a> 
                              </div> 
                          </div> 
                        <?php }?>
                      </ol>
                  </div>
                </div>  
              </div>  
            </div>
          </div>  
        </div>  
      </div>
    </div> 

    <div class="col-md-12"> 
      <div class="box box-primary">  
         <div class="box-header">
          <h2>Catatan/Tindakan Koreksi</h2> 
        </div>
        <div class="box-body">  
          <div class="form-group row  col-sm-12"> 
            <textarea class="md-input" id="note" name="note" readonly><?php echo $orders->description?></textarea> 
          </div>  
        </div>  
      </div>
    </div> 
    <div class="col-md-12"> 
      <div class="box box-primary">  
        <div class="box-body"> 
          <div class="form-group row m-t-md">
            <div class="col-sm-12 text-right"> 
              <a href="<?php echo base_url();?>maintenance_request" class="btn btn-sm btn-default ">Batal</a>
            </div>
          </div> 
        </div>  
      </div>
    </div> 
   
  </div> 
  </form>
</div>
<div class="padding"></div>
 <script data-main="<?php echo base_url()?>assets/js/main/main-maintenance-routine" src="<?php echo base_url()?>assets/js/require.js"></script>