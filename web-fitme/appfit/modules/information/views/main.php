<?PHP
  if(isset($listapp) && count($listapp) != 0){
    foreach ($listapp as $key => $value) {
      $Id = $value['app_id'];
      $Logo_img = $value['app_logo'];
      $Text_Name = $value['app_name'];
      $TEXT_Detail= $value['app_detail'];
      $Lastname= $value['lastedit_name'];
      $Lastdate= $value['lastedit_date'];
    }
  }
?>
<style>
.padding_left{padding-left: 20px;}
.mergin_left{ margin-left: 55px}
@media only screen and (max-width: 576px) {
    .padding_line{padding-top: 10px;}
    .padding_left{"padding-left: unset;}
    .mergin_left{ margin-left: unset}
}
</style>

<!-- Breadcrumb for page -->
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-content">
<!-- Contents for page -->
<br/>
<div class="row">
    <div class="col-12 col-md-5"><img width="100%" src="<?=base_url('assets/inspinia/images/7470 [Converted].jpg');?>" /></div>
    <div class="col-12 col-md-1"></div>
    <div class="col-12 col-md-6 padding_line" align="rigth">
        <h3><i class="fa fa-cogs"></i>  การตั้งค่าระบบ <?=$Text_Name; ?></h3>

        <div class="padding_left"><h4><a href="<?=site_url('administrator/administrator/main');?>"><p>ข้อมูลผู้ดูแลระบบ</p></a></h4></div>
        <div class="padding_left"><h4><a href="<?=site_url('about/index');?>"><p>ข้อมูลผู้จัดทำ</p></a></h4></div>
        <div class="padding_left"><h4><a href="<?=site_url('administrator/settings/index');?>"><p>ข้อมูลเกี่ยวกับ app</p></a></h4></div>
    </div>
</div>
<div class="row" style="margin-top:50px;">
    <div class="col-12 col-md-7">
        <div clas="row">
            <div class="col-12 col-md-12"><?=$TEXT_Detail; ?></div>
            <div class="col-12 col-md-12">
                <br/>
                <p><h3>เกร็ดความรู้</h3></p>
                <p>
                    <?PHP if(count($listTip) != 0){ ?>
                        <?PHP foreach ($listTip as $key => $value) {
                            $Title = $value['tip_title'];
                        ?>
                        <div style="margin-left: 20px;"><p><i class="fa fa-twitch"></i>  <?=$Title;?></p></div>
                         <?php } ?>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5" align="right"><img width="60%" src="<?=base_url('assets/inspinia/images/381025-PCQAOI-961.jpg');?>" /></div>
</div>

<br/>
<!-- End contents for page -->
</div>
</div>
</div>
</div>
</div>
