<?PHP
  if(isset($listdata) && count($listdata) != 0){
    foreach ($listdata as $key => $value) {
      $Id = $value['app_id'];
      $Logo_img = $value['app_logo'];
      $Text_Name = $value['app_name'];
      $TEXT_Detail= $value['app_detail'];
      $Lastname= $value['lastedit_name'];
      $Lastdate= $value['lastedit_date'];
    }
  }
?>
<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>การตั้งค่า</h2>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li class="active"><strong>ข้อมูลเกี่ยวกับแอพพลิเคชั่น</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div>
<!-- End breadcrumb for page -->

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
<!-- Tab   -->
<div class="tabs-container">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false">ข้อมูลเกี่ยวกับแอพพลิเคชั่น</a></li>
        <li><a data-toggle="tab" href="#tab-2" aria-expanded="false">Logo แอพพลิเคชั่น</a></li>
    </ul>

<!-- Contents Tab -->
<div class="tab-content">
    <div id="tab-1" class="tab-pane active">
        <div class="panel-body">
        <!-- Contents for page -->
        <form action="<?=site_url('administrator/settings/update')?>" method="post" enctype="multipart/form-data" name="formSettings" id="formSettings" class="form-horizontal" novalidate>
            <input type="hidden" name="frmseting" id="frmseting" value="<?=$frmseting;?>">
            <input type="hidden" name="Id" id="Id" value="<?=$Id?>">
            <br/>
            <div class="form-group">
                <label class="col-sm-2 control-label">ชื่อแอพพลิเคชั่น<span class="text-muted">*</span></label>
                <div class="col-sm-10"><input placeholder="ชื่อแอพพลิเคชั่น" type="text" name="Text_Name" id="Text_Name" value="<?=$Text_Name;?>" class="form-control"></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">รายละเอียดแอพพลิเคชั่น<span class="text-muted">*</span></label>
                <div class="col-sm-10">
                    <textarea placeholder="รายละเอียดแอพพลิเคชั่น" rows="5" type="text" name="TEXT_Detail" id="TEXT_Detail" class="form-control"><?=$TEXT_Detail;?></textarea>
                </div>
            </div>
            <br/>
            <div class="form-group">
                <div class="col-sm-12 control-label">อัพเดตข้อมูลโดย <?=$Lastname;?> : <?=$Lastdate;?></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-5"><button class="btn btn-primary" type="submit">อัพเดตข้อมูล</button></div>
            </div>
        </form>
        <!-- End contents for page -->
        </div>
    </div>
    <div id="tab-2" class="tab-pane">
        <div class="panel-body">
        <!-- Contents for page -->
        <form action="<?=site_url('administrator/settings/updateimg')?>" method="post" enctype="multipart/form-data" name="formlogo" id="formlogo" class="form-horizontal" novalidate>
            <input type="hidden" name="frmseting" id="frmseting" value="<?=$frmseting;?>">
            <input type="hidden" name="Id" id="Id" value="<?=$Id?>">
            <br/>
            <div class="form-group">
                <div class="col-sm-3">
                    <center><img style="border:1px solid #000000; padding: 10px; background:#000000;" width="50%" src="<?=site_url('uploads/application/'.$Logo_img);?>"/></center>
                </div>
                <div class="col-sm-9">
                    <p><b>Logo ปัจจุบันที่ใช้งานอยู่</b></p>
                    <p>URL:: uploads/application/<?=$Logo_img;?></p>
                    <br/>
                    <input type="file" name="File_img" id="File_img" value="<?=$Logo_img;?>" class="form-control" placeholder="ชื่อแอพพลิเคชั่น">
                </div>
            </div>
            <br/>
            <div class="form-group">
                <div class="col-sm-12 control-label">อัพเดตข้อมูลโดย <?=$Lastname;?> : <?=$Lastdate;?></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-5"><button class="btn btn-primary" type="submit">อัพเดตข้อมูล</button></div>
            </div>
        </form>
        <!-- End contents for page -->
        </div>
    </div>
</div>
<!-- Contents Tab -->
</div>
<!-- Tab   -->
</div>
</div>
</div>
