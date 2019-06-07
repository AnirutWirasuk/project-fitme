<?php
  if (count($listseting) != 0) {
      foreach ($listseting as $key => $value) {
        $CompanyEN = $value['app_name'];
        $Company = $value['app_detail'];
        $Id = $value['app_id'];
        $Logo_img = $value['app_logo'];
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

    <title><?=$CompanyEN;?> | Login</title>

    <link rel="icon" href="<?=base_url('uploads/application/'.$Logo_img); ?>" type="image/x-icon"> 
    <link rel="shortcut icon" href="<?=base_url('uploads/application/'.$Logo_img); ?>" type="image/x-icon">

    <link href="<?=base_url('assets/inspinia/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/font-awesome/css/font-awesome.css');?>" rel="stylesheet">

    <link href="<?=base_url('assets/inspinia/css/animate.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/css/style.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/css/custom.css');?>" rel="stylesheet">

</head>

<body class="imglogin-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><?=$CompanyEN;?></h1>

            </div>
            <p><?=$Company;?></p>
            <form class="m-t" role="form" method="post" action="<?=site_url('administrator/authen');?>">
                <input type="hidden" name="formcrf" id="formcrf" value="<?=$formcrf;?>">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                </div>
                <?=$msg;?>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <!-- <a href="#"><small>Forgot password?</small></a> -->
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?=base_url('assets/inspinia/js/jquery-2.1.1.js');?>"></script>
    <script src="<?=base_url('assets/inspinia/js/bootstrap.min.js');?>"></script>

</body>
</html>

