<style>
.checked {
    color: orange;
}
</style>
<div class="padding-top">
  <div class="box padtop-15"> 
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="photo-contain pull-left marleft-15 marright-15">
            <?php if(!empty($users->foto)){?>
            <img src="<?php echo base_url()?>assets/images/photo-dummy.png">
          <?php }else{?>
            <img src="<?php echo base_url()?>assets/images/photo/<?php echo $users->photo;?>">
           <?php }?> 
          </div>
          <div class="text-contain-2 pull-left padleft-15">
            <p class="text-blue marbot-0 bolder"><?php echo $users->first_name;?></p> 
            <p class="text-grey marbot-0 fsize-10"><?php 
            if($users->driver_type == 1){
              echo "DEDICATED";
            }else{
              echo "POOL";
            }
            ;?></p>
            
          </div>     
          <div class="text-contain-2 pull-left padleft-15">
            <p class="text-blue marbot-0 bolder marbot-15">Rating</p>
            <div class="full-width">
              <p class="text-blue fsize-46 single-line marbot-0 bolder pull-left marright-5">
                <?php echo number_format($rata_rating,0);?></p>
              <div class="pull-left">
                 <?php 

                    $rating = $rata_rating ;
                    $jumlah_rating = 5;
                    for ($i=0; $i < $jumlah_rating ; $i++) { 
                      if($i < $rating){
                        ?>
                         <span class="fa fa-star checked"></span>
                        <?php
                      }else{ ?>

                    <span class="fa fa-star"></span>
                      <?php  }
                    }
                    ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box-body">
      <hr>
      <ul class="nav nav-tabs nav-tabs-text">
        <li class="nav-item active">
          <a class="nav-link" href="#inthespot" data-toggle="tab">Review In The Spot</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#periodik" data-toggle="tab">Review Periodik</a>
        </li>
      </ul>
    </div>
  </div> 
  <div class="box">
    <div class="box-body">
      <div class="tab-content martop-15 clearfix">
        <div class="tab-pane active" id="inthespot">
          <h3 class="marbot-15">Review Terbaru</h3>
          <div class="row">
            <?php 
            if(!empty($review_spot)){ 
              foreach($review_spot as $review){?>
                <div class="col-sm-12 marbot-15">
                  <div class="image-contain">
                    <img src="<?php echo base_url()?>assets/images/review/<?php echo $review->file;?>">
                  </div>
                  <?php 
                  if($review->nilai==1){ ?>
                    <div class="smiley sad"></div>
                 <?php  }else if($review->nilai==2){?>
                    <div class="smiley standar"></div>
                  <?php }else{?>
                      <div class="smiley happy"></div> 
                  <?php }
                  ?>
                 
                  <div class="text-contain-3">
                    <div class="full-width">
                      <span class="text-blue fsize-18 bolder dtable pull-left single-line"> <?php echo $review->note?></span>  
                      <div class='marleft-15 pull-left'>
                        <?php 

                        $rating = $review->rating ;
                        $jumlah_rating = 5;
                        for ($i=0; $i < $jumlah_rating ; $i++) { 
                          if($i < $rating){
                            ?>
                             <span class="fa fa-star checked"></span>
                            <?php
                          }else{ ?> <span class="fa fa-star"></span>
                          <?php  }
                        }
                        ?>
                       
                       
                      </div>
                    </div>
                     
                    <p class="text-darkgrey fsize-13 italic"><?php echo $review->created_at?></p>
                  </div>
                </div> 
              <?php }
            }?>
          </div>
        </div>
        <div class="tab-pane" id="periodik">
          <div class="box-subheader">
            <h3 class="pull-left">Review Periodik</h3>
            <?php   $month = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");?>
            <div class="pull-right">
              <select class="form-control" id="filter-month">
                <option value="0">Semua Bulan</option>
              <?php foreach($review_periodik as $key=>$review){  ?>
                <option value="<?php echo $key?>"><?php echo $month[$key-1]?></option>    
              <?php }?>
              </select>
            </div>
          </div>
          <div class="row">
          <?php 
        
          if(!empty($review_periodik)){
            foreach($review_periodik as $key=>$review){  ?>
              <div class="col-sm-12 marbot-15 report" id="<?php echo $key?>">
                <div class="image-contain borright-grey col-sm-4">
                  <p class="text-blue italic fsize-12 text-right padright-10">Periode - <?php 
                  echo $month[$key-1];?></p>
                  <img class="marbot-10" src="<?php echo base_url()?>assets/images/icon-user.png">
                </div> 
                 
                <div class="rate-contain col-sm-8">
                  <?php foreach($review as $value){?>
                    <div class="col-sm-12 row marbot-15">
                      <div class="col-sm-8">
                        <p class="fsize-12 bolder"><?php echo $value->item_name?></p>  
                        <p class="fsize-10 bolder marbot-0 italic"><?php echo $value->created_at?></p>
                        <div >
                         <?php  
                            $rating = $value->rating ;
                            $jumlah_rating = 5;
                            for ($i=0; $i < $jumlah_rating ; $i++) { 
                              if($i < $rating){
                                ?>
                                 <span class="fa fa-star checked"></span>
                                <?php
                              }else{ ?> 
                                <span class="fa fa-star"></span>
                              <?php  }
                            }
                            ?>  
                        </div>
                      </div>
                      <div class="col-sm-4">
                         <p class="fsize-12">Note : <?php echo $value->note?></p>    
                      </div> 
                    </div> 
                    <hr>
                   <?php }?>
                </div> 
              </div>
            <?php } ?>
          <?php } ?>
             
          </div>
        </div>
      </div>
    </div>
  </div>
</div>   
<div class="padding"></div>
<script 
  data-main="<?php echo base_url()?>assets/js/main/main-report-driver" 
  src="<?php echo base_url()?>assets/js/require.js">  
</script>