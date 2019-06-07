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

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>System Administrator</title>
    <link rel="icon" href="<?=base_url('uploads/application/'.$Logo_img); ?>" type="image/x-icon"> 
    <link rel="shortcut icon" href="<?=base_url('uploads/application/'.$Logo_img); ?>" type="image/x-icon">
    
    <link href="<?=base_url('assets/inspinia/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/font-awesome/css/font-awesome.css');?>" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?=base_url('assets/inspinia/css/plugins/toastr/toastr.min.css');?>" rel="stylesheet">

    <!-- dataTables style -->
    <link href="<?=base_url('assets/inspinia/css/plugins/dataTables/datatables.min.css');?>" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="<?=base_url('assets/inspinia/css/plugins/sweetalert/sweetalert.css');?>" rel="stylesheet">

    <!-- datepicker -->
    <link href="<?=base_url('assets/inspinia/css/plugins/datapicker/datepicker3.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/css/plugins/clockpicker/clockpicker.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/css/plugins/daterangepicker/daterangepicker-bs3.css');?>" rel="stylesheet">



    <link href="<?=base_url('assets/inspinia/css/animate.css');?>" rel="stylesheet">
    <?PHP if(!empty($css)){echo $css;}?>
    <link href="<?=base_url('assets/inspinia/css/style.min.css');?>" rel="stylesheet">

    <script data-main="<?=base_url('assets/inspinia/js/app.js');?>" src="<?=base_url('assets/inspinia/js/require.js');?>"></script>
</head>

<body class="pace-done">

<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element" style="color: #FFFFFF;">
                    <img width="50%" src="<?=site_url('uploads/application/'.$Logo_img);?>"/>
                </div>
                <div class="logo-element">
                    <img width="50%" src="<?=site_url('uploads/application/'.$Logo_img);?>"/>
                </div>
            </li>
            <li><a href="<?=site_url('information/index');?>"><i class="fa fa-dashboard"></i> <span class="nav-label">หน้าหลัก</span></a></li>
            <li><a href="<?=site_url('news/index');?>"><i class="fa fa-newspaper-o"></i> <span class="nav-label">ข่าวสาร</span></a></li>
            <li><a href="<?=site_url('tip/index');?>"><i class="fa fa-book"></i> <span class="nav-label">เกร็ดความรู้</span></a></li>
            <li><a href="<?=site_url('disease/index');?>"><i class="fa fa-bullhorn"></i> <span class="nav-label">โรคที่พบบ่อยในผู้สูงอายุ</span></a></li>
            <li><a href="<?=site_url('category/index');?>"><i class="fa fa-bars"></i> <span class="nav-label">หมวดหมู่การกายภาพ</span></a></li>
            <li><a href="<?=site_url('type/index');?>"><i class="fa fa-tags"></i> <span class="nav-label">ประเภทผู้สูงอายุ</span></a></li>
            <li><a href="<?=site_url('media/index');?>"><i class="fa fa-video-camera"></i> <span class="nav-label">การทำกายภาพบำบัด</span></a></li>
            <li>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">ตั้งค่า</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <!-- <li><a href="<?=site_url('user/index');?>"><i class="fa fa-users"></i> <span class="nav-label">ข้อมูลสมาชิก</span></a></li> -->
                    <li><a href="<?=site_url('administrator/administrator/main');?>">ข้อมูลผู้ดูแลระบบ</a></li>
                    <li><a href="<?=site_url('about/index');?>">ข้อมูลผู้จัดทำ</a></li>
                    <li><a href="<?=site_url('administrator/settings/index');?>">ข้อมูล app</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>

<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <div class="m-r-sm text-muted welcome-message"><?=$this->encryption->decrypt($this->input->cookie('sysn'));?></div>
            </li>
            <li>
                <a href="<?=site_url('administrator/logout');?>" style="color: #e74c3c;">
                    <i class="fa fa-sign-out"></i> ออกจากระบบ
                </a>
            </li>
        </ul>

    </nav>
</div>
  <?= $contents ?>
<div class="footer" >
    <div>
        <strong> <?=$Text_Name?> </strong>&copy; 2018
    </div>
</div>

</div>
</div>



<!-- <script src="<?=base_url('assets/inspinia/js/lib/jquery-2.1.1.js');?>"></script>
<script src="<?=base_url('assets/inspinia/js/lib/bootstrap.min.js');?>"></script>
<script src="<?=base_url('assets/inspinia/js/lib/plugins/summernote/summernote.min.js');?>"></script>
<script>
    $(document).ready(function(){

        $('.summernote').summernote();

   });
</script> -->
<?PHP if(!empty($js)){echo $js;}?>

</body>

</html>
