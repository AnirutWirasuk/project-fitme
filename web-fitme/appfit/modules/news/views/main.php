<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>ข้อมูลข่าวสาร</h2>
      <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li class="active"><strong>ข่าวสาร</strong></li>
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
    <a href="<?=site_url('news/form');?>">
      <button style="margin-left: 10px;" class="btn btn-w-m btn-primary btn-sm pull-right">เพิ่มข่าวสาร</button>
    </a>
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
          <!-- <th style="width:10%;">รหัสข่าวสาร</th> -->
          <th style="width:40%;">ข่าวสาร</th>
          <th style="width:15%;">เพิ่มข้อมูลโดย</th>
          <th style="width:15%;">แก้ไขข้อมูลโดย</th>
          <th style="width:13%;">จัดการ</th>
          <th style="width:10%;"></th>
        </tr>
      </thead>
      <tbody>
        <?PHP foreach ($listdata as $key => $value) {
          $Id = $value['news_id'];
          $Text_title = $value['news_title'];
          $Text_detail = $value['news_detail'];
          $File_img = $value['news_imgcover'];
          $Text_eye = $value['news_show'];
          $news_createname = $value['news_createname'];
          $news_createdate = $value['news_createdate'];
          $lastedit_name = $value['lastedit_name'];
          $lastedit_date = $value['lastedit_date'];
        ?>
        <tr class="gradeX">
          <!-- <td><strong><?="N".str_pad($Id,5,"0",STR_PAD_LEFT);?></strong></td> -->
          <td class="project-title"><?=$Text_title; ?></td>
          <td class="center">
            <?=$news_createname;?><br />
            <small class="text-muted"><i class="fa fa-clock-o"></i> <?=date('d M Y h:i A', strtotime($news_createdate));?></small>
          </td>
          <td class="center">
            <?=$lastedit_name;?><br />
            <small class="text-muted"><i class="fa fa-clock-o"></i> <?=date('d M Y h:i A', strtotime($lastedit_date));?></small>
          </td>
          <td class="center">
            <div class="btn-group">
              <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">จัดการ <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="<?=site_url('news/form/'.$value['news_id']);?>"><i class="fa fa-pencil"></i> แก้ไข</a></li>
                  <li><a href="#" class="Btn-delete" data-url="<?=site_url('news/delete/'.$value['news_id']);?>"><i class="fa fa-trash"></i> ลบ</a></li>
                </ul>
            </div>
          </td>
          <td class="center">
            <?PHP if($Text_eye == 1){?>
              <span class="label label-primary">แสดง</span>
            <?PHP }else{ ?>
              <span class="label label-danger">ซ่อน</span>
            <?PHP }?>
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
