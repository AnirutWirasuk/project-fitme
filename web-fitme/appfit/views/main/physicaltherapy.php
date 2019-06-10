<!-- Content
============================================= -->
<section id="content">
<script language="JavaScript">
	function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}
</script>
<div class="content-wrap">

    <div class="container clearfix">
        <form action="" method="post" enctype="multipart/form-data" name="frmPhysicaltherapy" id="frmPhysicaltherapy" class="form-horizontal" novalidate>
            <input type="hidden" name="MM_From" id="MM_From" value="MM_From">
            <div class="form-group">
                <label class="col-sm-2 control-label">ค่าความดันตอนหัวใจบับตัว :<span class="text-muted">*</span></label>
                <div class="col-sm-4"><input type="number" pattern="{0-9}" name="top" id="top" class="form-control" value="" OnKeyPress="return chkNumber(this)"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ค่าความดันตอนหัวใจคลายตัว :<span class="text-muted">*</span></label>
                <div class="col-sm-4"><input type="number" pattern="{0-9}" name="low" id="low" class="form-control" value="" OnKeyPress="return chkNumber(this)"> </div>
            </div>
            <?PHP if(!empty($msg)){ ?>
            <div class="center" style="color: #C02942;">
            <?=$msg;?>
            </div>
            <?PHP }?>
            <div class="center">
                <button class="button button-rounded button-reveal button-large button-red tright" type="submit">ส่งข้อมูล</button>
            </div>
        </form>
    </div>

</div>

</section><!-- #content end -->