<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>การตั้งค่า</h2>
      <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li class="active"><strong>ข้อมูลผู้ดูแลระบบ</strong></li>
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
<div class="row">
  <div class="col-sm-6"></div>
  <div class="col-sm-6">
   
    <a href="<?=site_url('administrator/form');?>">
      <button style="margin-left: 10px;" class="btn btn-w-m btn-primary btn-sm pull-right">เพิ่มข้อมูล</button>
    </a>
    <div class="input-group">
      <input type="text" placeholder="Search" name="search-draw" id="search-draw" class="input-sm form-control">
      <span class="input-group-btn">
        <button type="button" id="btnsearch" class="btn btn-sm btn-primary"> ค้นหา!</button>
      </span>
    </div>
  </div>
</div>

<div class="table-responsive">
  <?PHP if(count($listdata) != 0){?>
    <table class="table table-striped table-hover dataTables-example" >
      <thead>
        <tr>
          <th style="width:10%;">ลำดับ</th>
          <th style="width:25%;">ชื่อ-นามสกุล</th>
          <th style="width:20%;">อีเมล์</th>
          <th style="width:15%;">แก้ไขข้อมูลโดย</th>
          <th style="width:15%;">ออนไลน์ล่าสุดเมื่อ</th>
          <th style="width:15%;">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?PHP foreach ($listdata as $key => $value) {?>
          <tr class="gradeX">
            <td><strong><?="A".str_pad($value['admin_id'],5,"0",STR_PAD_LEFT);?></strong></td>
            <td class="project-title"><?=$value['admin_fname']?>  <?=$value['admin_lname']?></td>
            <td><?=$value['admin_email']?></td>
            <td>
              <?=$value['lastedit_name'];?><br />
              <small class="text-muted"><i class="fa fa-clock-o"></i> <?=date('d/m/Y h:i A', strtotime($value['lastedit_date']));?></small>
            </td>
            <td class="center"><?PHP if($value['admin_lastlogin'] != "0000-00-00 00:00:00"){ ?><i class="fa fa-clock-o"></i> <?=date('d/m/Y h:i A', strtotime($value['admin_lastlogin']));?> <?PHP }else{?> - <?PHP }?></td>
            <td class="center">
              <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">จัดการ <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="<?=site_url('administrator/form/'.$value['admin_id']);?>"><i class="fa fa-pencil"></i> แก้ไขข้อมุล</a></li>
                  <li><a href="#" class="Btn-delete" data-url="<?=site_url('administrator/delete/'.$value['admin_id']);?>"><i class="fa fa-trash"></i> ลบข้อมูล</a></li>
                  <li><a href="<?=site_url('administrator/formpassword/'.$value['admin_id']);?>"><i class="fa fa-repeat"></i> เปลี่ยนรหัสผ่าน</a></li>
                </ul>
              </div>
            </td>
          </tr>
        <?PHP }?>
      </tbody>
    </table>
  <?PHP }?>
</div>
<!-- End contents for page -->
</div>
</div>
</div>
</div>
</div>
