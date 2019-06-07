<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>แสดงข้อมูลสมาชิก</h2>
      <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li class="active"><strong>ข้อมูลสมาชิก</strong></li>
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
  <div class="col-sm-8"></div>
  <div class="col-sm-4">
    <div class="input-group">
      <input type="text" placeholder="Search" name="search-draw" id="search-draw" class="input-sm form-control">
      <span class="input-group-btn"><button type="button" id="btnsearch" class="btn btn-sm btn-primary"> ค้นหา!</button></span>
    </div>
  </div>
</div>

<!-- Table -->
<div class="table-responsive">
  <?PHP if(count($listdata) != 0){ ?>
    <table class="table table-striped table-hover dataTables-example" >
      <thead>
        <tr>
          <th style="width:10%;">รหัสสมาชิก</th>
          <th style="width:40%;">ชื่อ-นามสกุล</th>
          <th style="width:15%;">เบอร์โทรศัพท์</th>
          <th style="width:15%;">อีเมล์</th>
          <th style="width:15%;">โรคประจำตัว</th>
        </tr>
      </thead>
      <tbody>
        <?PHP foreach ($listdata as $key => $value) {
          $Id = $value['user_id'];
          $user_fname = $value['user_fname'];
          $user_lname = $value['user_lname'];
          $user_email = $value['user_email'];
          $dis_name = $value['dis_name'];
          $user_tel = $value['user_tel'];
          $lastedit_date = $value['lastedit_date'];
          $lastedit_name = $value['lastedit_name'];
        ?>
        <tr class="gradeX">
          <td><strong><?="T".str_pad($Id,5,"0",STR_PAD_LEFT);?></strong></td>
          <td class="project-title"><?=$user_fname; ?> <?=$user_lname; ?></td>
          <td class="project-title"><?=$user_tel; ?></td>
          <td class="project-title"><?=$user_email; ?></td>
          <td class="project-title"><?=$dis_name; ?></td>
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
