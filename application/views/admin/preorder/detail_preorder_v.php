 
<div class="padding-top">
   <div class="row"> 
      <div class="col-md-12"> 
        <form class="form-horizontal" id="form" method="POST" action="" enctype="multipart/form-data"> 
          <input type="hidden" name="token" value="<?php echo $orders->token;?>">
          <input type="hidden" name="workshop_id" value="<?php echo $orders->workshop_id;?>">
          <input type="hidden" name="user_id" value="<?php echo $orders->user_id;?>">
          <input type="hidden" name="service_type" value="<?php echo $orders->service_type;?>">
          <input type="hidden" name="type" value="<?php echo $orders->type;?>">
          <input type="hidden" name="id" value="<?php echo $orders->id;?>">
          <div class="box box-primary"> 
            <div class="box-body">  
              <div class="full-width">
                <div class="form-group row m-t-md">
                  <div class="col-sm-6">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="no_order" name="no_order" autocomplete="off" readonly="" value="<?php echo $orders->preorder_no;?>">
                        <label for="branch" class="form-control-feedback">Nomor Preorder</label>
                      </div>
                    </div>   
                  </div>
                  <div class="col-sm-6">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off" readonly="" value="<?php echo date("Y-m-d",strtotime($orders->order_date));?>">
                        <label for="branch" class="form-control-feedback">Tanggal Order</label>
                      </div>
                    </div> 
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="waktu_order" name="waktu_order" autocomplete="off" readonly="" value="<?php echo date("H:i:s",strtotime($orders->order_date));?>">
                        <label for="branch" class="form-control-feedback">Waktu Order</label>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>  
            </div>  
          </div>
          <div class="box box-primary"> 
            <div class="box-body">  
              <div class="full-width">
                <div class="form-group row m-t-md"> 
                  <div class="col-sm-2">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off" readonly="" value="<?php echo $drivers->first_name;?>">
                        <label for="branch" class="form-control-feedback">Nama Driver</label>
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm-2">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off" readonly="" value="<?php if($drivers->driver_type == 1){ echo "Dedicated"; }else{echo "Pool";}?>">
                        <label for="branch" class="form-control-feedback">Tipe Driver</label>
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm-2">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off" readonly="" value="<?php echo $drivers->phone;?>">
                        <label for="branch" class="form-control-feedback">No HP Driver</label>
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm-2">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off" readonly="" value="<?php echo $data_users->first_name;?>">
                        <label for="branch" class="form-control-feedback">Nama User</label>
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm-2">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off" readonly="" value="<?php echo $data_users->phone;?>">
                        <label for="branch" class="form-control-feedback">No HP User</label>
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm-2">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off" readonly="" value="<?php echo $data_users->department;?>">
                        <label for="branch" class="form-control-feedback">Alokasi</label>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>  
            </div>  
          </div>    
          <div class="box box-primary">
            <div class="box-header with-border"> 
              Informasi Kendaraan
            </div>   
            <div class="box-body">
              <div class="form-group row m-t-md">
                <div class="col-sm-6">
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <select class="md-input" id="branch_id">
                        <option value=""> Pilih Cabang</option>
                        <?php foreach($branches as $branch){ ?> 
                           <?php if($branch->id == $units->branch_id){?> 
                            <option value="<?php echo $branch->id;?>" selected><?php echo $branch->name;?></option>
                            <?php }else{?> 
                              <option value="<?php echo $branch->id;?>"><?php echo $branch->name;?></option>
                          <?php }?>
                        <?php }?>
                      </select>
                      <label for="branch" class="form-control-feedback">Cabang</label>
                    </div>
                  </div>   
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="type_assets" name="type_assets" autocomplete="off" required value="<?php if($units->type_assets == 1){
                        echo "PAR";
                      }else{
                        echo "VENDOR";
                      }?>">
                      <label for="type_assets" class="form-control-feedback">Tipe Assets</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12"> 
                      <select class="md-input" id="branch_id">
                        <option value=""> Pilih Fungsi Unit</option>
                        <option value="1" <?php if($units->type_unit == 1){ echo "selected"; }?>> Dedicated</option>
                        <option value="2" <?php if($units->type_unit == 2){ echo "selected"; }?>> Pool</option>
                      </select>
                      <label for="type_unit" class="form-control-feedback">Fungsi Unit</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="merk" name="merk" autocomplete="off" required value="<?php echo $units->produk_name?>">
                      <label for="merk" class="form-control-feedback">Merk Unit</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="model" name="model" autocomplete="off" required value="<?php echo $units->model?>">
                      <label for="model" class="form-control-feedback">Model Unit</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="varian" name="varian" autocomplete="off" required value="<?php echo $units->varian?>">
                      <label for="varian" class="form-control-feedback">Varian Unit</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="mes" name="mes" autocomplete="off" required value="<?php echo $units->mes?>">
                      <label for="mes" class="form-control-feedback">Cakupan Mesin</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="transmition" name="transmition" autocomplete="off" required value="<?php echo $units->transmition?>">
                      <label for="transmition" class="form-control-feedback">Transmisi</label>
                    </div>
                  </div>  
                </div>
                <div class="col-sm-6">
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="years" name="years" autocomplete="off" required value="<?php echo $units->years?>">
                      <label for="years" class="form-control-feedback">Tahun</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="mileage" name="mileage" autocomplete="off" required value="<?php echo $units->mileage?>">
                      <label for="mileage" class="form-control-feedback">Jarak Tempuh</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="stnk_due_date" name="stnk_due_date" autocomplete="off" required value="<?php echo $units->stnk_due_date?>">
                      <label for="stnk_due_date" class="form-control-feedback">Masa Berlaku STNK</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="kir_due_date" name="kir_due_date" autocomplete="off" required value="<?php echo $units->kir_due_date?>">
                      <label for="kir_due_date" class="form-control-feedback">Masa Berlaku KIR</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="chassis_number" name="chassis_number" autocomplete="off" required value="<?php echo $units->chassis_number?>">
                      <label for="chassis_number" class="form-control-feedback">Nomor Rangka</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="machine_number" name="machine_number" autocomplete="off" required value="<?php echo $units->machine_number?>">
                      <label for="machine_number" class="form-control-feedback">Nomor Mesin</label>
                    </div>
                  </div>  
                  <div class="full-width text-center">
                    <div class="md-form-group col-sm-12">
                      <input class="md-input" id="color" name="color" autocomplete="off" required value="<?php echo $units->color?>">
                      <label for="color" class="form-control-feedback">Warna</label>
                    </div>
                  </div>    
                </div>
              </div>
            </div>
          </div>  
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
                        <input class="md-input" id="no_order" name="no_order" autocomplete="off" readonly="" value="<?php 
                        if($lastOrder->service_type == "repair"){
                          echo "Perbaikan";
                        }else if($lastOrder->service_type == "treatment"){
                          echo "Perawatan";
                        }else{
                          echo "Darurat";
                        }
                        ?>">
                        <label for="branch" class="form-control-feedback">Jenis Maintenance</label>
                      </div>
                      <div class="md-form-group col-sm-6">
                        <input class="md-input" id="no_order" name="no_order" autocomplete="off" readonly="" value="<?php echo date("Y-m-d",strtotime($lastOrder->order_date));?>">
                        <label for="branch" class="form-control-feedback">Tanggal Maintenance</label>
                      </div>
                    </div>  
                    <div class="col-sm-12 full-width text-center">
                      <div class="col-sm-4">
                        <p><b>Unit Yang diperiksa</b></p> 
                      </div>
                      <div class="col-sm-2">
                         <ol>
                            <?php foreach($lastOrder->parts as $parts){?>
                            
                            <li><?php echo $parts->part_name;?></li>
                          <?php }?>
                          </ol>
                      </div>
                    </div>   
                  </div>
                  <div class="col-sm-6">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="tgl_order" name="tgl_order" autocomplete="off"  readonly="" value="<?php 
                        if($lastOrder->service_type == "repair"){
                          echo "Perbaikan";
                        }else if($lastOrder->service_type == "treatment"){
                          echo "Perawatan";
                        }else{
                          echo "Darurat";
                        }
                        ?>">
                        <label for="branch" class="form-control-feedback">Jenis Maintenance</label>
                      </div>
                    </div>  
                    <div class="full-width text-center">
                      <div class="col-sm-4">
                        <p><b>Unit Yang diperiksa</b></p> 
                      </div>
                      <div class="col-sm-2">
                          <ol>
                            <?php foreach($part_perawatan as $key=>$parts){?> 
                            <li><?php echo $parts;?></li>
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
                      <div class="col-sm-2">
                           <ol>
                            <?php foreach($part_perbaikan as $key=>$parts){

                              ?> 
                            <li><?php echo $parts;?></li>
                          <?php }?>
                          </ol>
                      </div>
                    </div>  
                  </div>  
                </div>
              </div>  
            </div>  
          </div> 
          <div class="box box-primary">  
            <div class="box-header with-border"> 
              Pilih Bengkel
            </div>    
            <div class="box-body">  
              <div class="full-width">
                <div class="form-group row m-t-md">
                  <div class="col-sm-6">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <select class="md-input select2" id="branch_id">
                        <option value=""> Pilih Bengkel</option>
                        <?php foreach($workshops as $workshop){ ?>
                          <?php if($workshop->id == $orders->workshop_id){?>
                          <option value="<?php echo $workshop->id;?>" selected><?php echo $workshop->name;?></option>
                        <?php }else{?>

                          <option value="<?php echo $workshop->id;?>"><?php echo $workshop->name;?></option>
                        <?php }?>
                        <?php }?>
                      </select>
                      <label for="branch" class="form-control-feedback">Bengkel</label>
                    </div>
                    </div>   
                  </div>
                  <div class="col-sm-6">
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                        <input class="md-input" id="est_biaya_part" name="est_biaya_part" autocomplete="off" required>
                        <label for="branch" class="form-control-feedback">Estimasi Part</label>
                      </div>
                    </div> 
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="est_biaya_jasa" name="est_biaya_jasa" autocomplete="off" required>
                        <label for="branch" class="form-control-feedback">Estimasi Jasa</label>
                      </div>
                    </div> 
                    <div class="full-width text-center">
                      <div class="md-form-group col-sm-12">
                      <input class="md-input" id="est_biaya_maintenance" name="est_biaya_maintenance" autocomplete="off" required>
                        <label for="branch" class="form-control-feedback">Estimasi Waktu Maintenance</label>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>  
            </div>  
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">  
            </div> 
            <div class="box-body">   
                <div class="col-sm-12 text-right">
                  <button type="submit" class="btn btn-sm btn-info" id="save-btn">Simpan</button>
                  <a href="<?php echo base_url();?>preorder" class="btn btn-sm btn-danger ">Batal</a>
                </div>
              
            </div>    
          </div> 
      </form>
      </div> 
    </div>
</section>
<div class="padding"></div>
<script data-main="<?php echo base_url()?>assets/js/main/main-preorder" src="<?php echo base_url()?>assets/js/require.js"></script>