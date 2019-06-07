<?PHP
  if(isset($listdata) && count($listdata) != 0){
    foreach ($listdata as $key => $value) {
      $Id = $value['tip_id'];
      $Text_title = $value['tip_title'];
      $Iddis = $value['dis_id'];
      $Text_detail = $value['tip_detail'];
      $File_img = $value['tip_imgcover'];
      $Text_eye = $value['tip_show'];

    }
    $TitlePage = "อัพเดทข้อมูล";
    $titlePageEN = "Update";
    $actionUrl = site_url('tip/update');
  }else{
    $TitlePage = "เพิ่มข้อมูล";
    $titlePageEN = "Create";
    $actionUrl = site_url('tip/create');
    $Text_eye = 1;
  }
?>

<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?=$TitlePage;?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าหลัก</a></li>
      <li><a href="<?=site_url('tip/index');?>">เกร็ดความรู้</a></li>
      <li class="active"><strong><?=$TitlePage;?></strong></li>
    </ol>
  </div>
  <div class="col-lg-2"></div>
</div>
<!-- End breadcrumb for page -->
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
<!-- Contents for page -->
<div class="tabs-container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="false"><?=$TitlePage;?> เกร็ดความรู้</a></li>
      <div class="mail-tools tooltip-demo">
        <div class="btn-group pull-right">
          <button class="btn btn-w-m btn-white btn-sm Btn-reload" data-toggle="tooltip" data-placement="left" title="" data-original-title="โหลดหน้าเว็บใหม่"><i class="fa fa-refresh"></i> Refresh</button>
          <button class="btn btn-white btn-sm Btn-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="ซ่อน/แสดง">
            <?PHP if($Text_eye == 1){?><i class="fa fa-eye"></i><?PHP }else{ ?><i class="fa fa-eye-slash"></i><?PHP }?>
          </button>
          <?PHP if(!empty($Id)){ ?>
            <button class="btn btn-white btn-sm Btn-delete" data-url="<?=site_url('tip/delete/'.$value['tip_id']);?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="ลบข้อมูล"><i class="fa fa-trash-o"></i> </button>
          <?PHP }?>
        </div>
      </div>
  </ul>

  <div class="tab-content">
    <div id="tab-2" class="tab-pane active">
      <div class="panel-body">
        <form action="<?=$actionUrl; ?>" method="post" enctype="multipart/form-data" name="frmTip_<?=$titlePageEN;?>" id="frmTip_<?=$titlePageEN;?>" class="form-horizontal" novalidate>
          <input type="hidden" name="crform" id="crform" value="<?=$crform;?>">
          <input type="hidden" name="Id" id="Id" value="<?PHP if(isset($Id)){echo $Id;}?>">
          <input type="hidden" name="Text_eye" id="Text_eye" class="Text_eye" value="<?PHP if(isset($Text_eye)){echo $Text_eye;}?>">
          <!-- Detail -->
          <div class="form-group">
            <label class="col-sm-2 control-label">ชื่อเกร็ดความรู้ :<span class="text-muted">*</span></label>
            <div class="col-sm-10"><input type="text" name="Text_title" id="Text_title" class="form-control" value="<?PHP if(isset($Text_title)){echo $Text_title;}?>"></div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">โรคที่พบบ่อยในผู้สูงอายุ :<span class="text-muted">*</span></label>
            <div class="col-sm-10">
              <select class="form-control" id="text_type" name="text_type" >
                <option value="">-- เลือกโรค --</option>
                <?PHP if(count($listdis) != 0){ ?>
                  <?php foreach($listdis as $listdis): ?>
                      <?php if($Iddis == $listdis['dis_id']){ ?>
                        <option value="<?php echo $listdis['dis_id']; ?>" selected ><?php echo $listdis['dis_name']; ?></option>
                      <?php }else{ ?>
                        <option value="<?php echo $listdis['dis_id']; ?>"  ><?php echo $listdis['dis_name']; ?></option>
                      <?php } ?>
                  <?php endforeach; ?>
                <?PHP }?>
              </select>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">ภาพหน้าปก :</label>
            <div class="col-sm-10">
              <input type="file" name="File_img" id="File_img" class="form-control">
              <input type="hidden" name="File_img_old" id="File_img_old" value="<?PHP if (isset($File_img)) {echo $File_img;}?>">
              <?PHP if(isset($File_img)){?>
                <a href="<?=base_url("uploads/tip/".$File_img);?>" target="_blank">[แสดงไฟล์]</a>
              <?PHP }?>  
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <div class="col-sm-12">
              <textarea rows="25" cols="150" class="summernote" data-img="<?=site_url('manager/filemanager/summernote');?>" id="Text_detail" name="Text_detail"><?PHP if(isset($Text_detail)){echo $Text_detail;}?></textarea>
            </div>
          </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <div class="col-sm-6 col-sm-offset-5">
              <a href="<?=site_url('tip/index');?>"><button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button></a>
              
              <?PHP if(!empty($Id)){ ?>
                <button class="btn btn-w-m btn-primary" type="submit">อัพเดตข้อมูล</button>
              <? } else { ?>
                <button class="btn btn-w-m btn-primary" type="submit">เพิ่มข้อมูล</button>
              <? } ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- End contents for page -->
</div>
</div>
</div>
