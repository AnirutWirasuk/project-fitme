<?PHP
  if(isset($listdata) && count($listdata) != 0){
    foreach ($listdata as $key => $value) {
      $Id = $value['admin_id'];
      $Text_Name = $value['admin_fname'];
      $Text_lastname = $value['admin_lname'];
      $Text_Tel = $value['admin_tel'];
      $Text_Email = $value['admin_email'];
    }
    $title = "Update";
    $title_th = "อัพเดตข้อมูล";
    $actionUrl = site_url('administrator/update');
  }else{
    $Id = NULL;
    $Text_fullName = NULL;
    $Select_Positon = NULL;
    $Text_Address = NULL;
    $Text_Tel = NULL;
    $Text_Email = NULL;
    $title = "Create";
    $title_th = "เพิ่มข้อมูล";
    $actionUrl = site_url('administrator/create');
  }
?>

<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?=$title_th;?></h2>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="<?=site_url('administrator/main');?>">ข้อมูลผู้ดูแลระบบ</a></li>
            <li class="active"><strong><?=$title_th;?></strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div>
<!-- End breadcrumb for page -->

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-content">
<!-- Contents for page -->
<form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formAdministrators" id="formAdministrators" class="form-horizontal" novalidate>
    <input type="hidden" name="formcrf" id="formcrf" value="<?=$formcrf;?>">
    <input type="hidden" name="Id" id="Id" value="<?=$Id?>">
    <br/>
    <div class="form-group">
        <label class="col-sm-2 control-label">ชื่อ<span class="text-muted">*</span></label>
        <div class="col-sm-4"><input type="text" name="Text_Name" id="Text_Name" value="<?PHP if(isset($Text_Name)){echo $Text_Name;}?>" class="form-control"></div>
        <label class="col-sm-2 control-label">นามสกุล<span class="text-muted">*</span></label>
        <div class="col-sm-4"><input type="text" name="Text_lastname" id="Text_lastname" value="<?PHP if(isset($Text_lastname)){echo $Text_lastname;}?>" class="form-control"></div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">เบอร์โทรศัพท์</label>
        <div class="col-sm-10"><input type="text" name="Text_Tel" id="Text_Tel" class="form-control" value="<?PHP if(isset($Text_Tel)){echo $Text_Tel;}?>"></div>
    </div>
    <?PHP if(empty($Id)){?>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">อีเมล์(ชื่อผู้ใช้งาน)<span class="text-muted">*</span></label>
        <div class="col-sm-10"><input type="text" name="Text_Email" id="Text_Email" data-url="<?=site_url('administrator/checkemail');?>" class="form-control" value="<?PHP if(isset($Text_Email)){echo $Text_Email;}?>"></div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">รหัสผ่าน<span class="text-muted">*</span></label>
        <div class="col-sm-10"><input type="password" name="Text_passWord" id="Text_passWord" class="form-control"></div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label">ยืนยัน รหัสผ่าน<span class="text-muted">*</span></label>
        <div class="col-sm-10"><input type="password" name="Text_confirmPassword" id="Text_confirmPassword" class="form-control"></div>
    </div>
    <?PHP }?>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-5">
            <a href="<?=site_url('administrator/main');?>"><button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button></a>
            <button class="btn btn-w-m btn-primary" type="submit">บันทึกข้อมูล</button>
        </div>
    </div>
</form>
<!-- End contents for page -->
</div>
</div>
</div>
</div>
</div>
