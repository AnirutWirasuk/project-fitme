<?PHP
  if(isset($listdata) && count($listdata) != 0){
    foreach ($listdata as $key => $value) {
      $Id = $value['ad_id'];
      $Text_fullName = $value['ad_fullname'];
      $Select_Positon = $value['position_id'];
      $Text_Address = $value['ad_address'];
      $Text_Tel = $value['ad_tel'];
      $Text_Email = $value['ad_email'];
    }
    $title = "Update";
    $actionUrl = site_url('administrator/update');
  }else{
    $Id = NULL;
    $Text_fullName = NULL;
    $Select_Positon = NULL;
    $Text_Address = NULL;
    $Text_Tel = NULL;
    $Text_Email = NULL;
    $title = "Create";
    $actionUrl = site_url('administrator/create');
  }
?>

<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?=$title;?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="<?=site_url('administrator/main');?>">Administrators</a>
            </li>
            <li class="active">
                <strong><?=$title;?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<!-- End breadcrumb for page -->

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
          <div class="ibox-content">
              <!-- Contents for page -->
              <form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formAdministrators" id="formAdministrators" class="form-horizontal" novalidate>
                <input type="hidden" name="crffilemanager" id="crffilemanager" value="<?=$crffilemanager;?>">
                <input type="hidden" name="Id" id="Id" value="<?=$Id?>">
                <div class="form-group"><label class="col-sm-2 control-label">Fullname<span class="text-muted">*</span></label>
                    <div class="col-sm-10"><input type="text" name="Text_fullName" id="Text_fullName" value="<?=$Text_fullName;?>" class="form-control"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <?PHP if(count($listposition) != 0){?>
                <div class="form-group"><label class="col-sm-2 control-label">Positon<span class="text-muted">*</span></label>
                    <div class="col-sm-10">
                      <select class="form-control m-b" name="Select_Positon">
                          <option value="">please select.</option>
                          <?PHP foreach ($listposition as $key => $value) {?>
                          <option value="<?=$value['position_id']?>" <?PHP if($Select_Positon == $value['position_id']){echo 'selected';} ?>><?=$value['position_name']?></option>
                          <?PHP }?>
                      </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?PHP }?>
                <div class="form-group"><label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10"><input type="text" name="Text_Address" id="Text_Address" class="form-control" value="<?=$Text_Address?>"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Tel</label>
                    <div class="col-sm-10"><input type="text" name="Text_Tel" id="Text_Tel" class="form-control" value="<?=$Text_Tel?>"></div>
                </div>
                <?PHP if(empty($Id)){?>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Email(username)<span class="text-muted">*</span></label>
                    <div class="col-sm-10"><input type="text" name="Text_Email" id="Text_Email" data-url="<?=site_url('administrator/checkemail');?>" class="form-control" value="<?=$Text_Email?>"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Password<span class="text-muted">*</span></label>
                    <div class="col-sm-10"><input type="password" name="Text_passWord" id="Text_passWord" class="form-control"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Confirm Password<span class="text-muted">*</span></label>
                    <div class="col-sm-10"><input type="password" name="Text_confirmPassword" id="Text_confirmPassword" class="form-control"></div>
                </div>
                <?PHP }?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white" type="submit">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </div>
              </form>
              <!-- End contents for page -->
          </div>
      </div>
    </div>
</div>
</div>
