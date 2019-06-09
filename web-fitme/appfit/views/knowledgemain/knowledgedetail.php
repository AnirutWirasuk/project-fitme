<?PHP 
    if(count($listKnowledge) != 0){
        foreach ($listKnowledge as $key => $value) {
            $tip_imgcover = $value['tip_imgcover'];
            $tip_title = $value['tip_title'];
            $tip_detail = $value['tip_detail'];
            $tip_createdate = $value['tip_createdate'];
            $tip_createname = $value['tip_createname'];
        }
    }
?>
<!-- Content
============================================= -->
<section id="content">

<div class="content-wrap">

    <div class="container clearfix">
       <!-- Post Content
		============================================= -->
		<div class="postcontent nobottommargin clearfix">

            <div class="single-post nobottommargin">

                <!-- Single Post
                ============================================= -->
                <div class="entry clearfix">

                    <!-- Entry Title
                    ============================================= -->
                    <div class="entry-title">
                        <h2><?=$tip_title;?></h2>
                    </div><!-- .entry-title end -->

                    <!-- Entry Meta
                    ============================================= -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> <?=date('d/m/Y', strtotime($tip_createdate));?></li>
                        <li><a href="#"><i class="icon-user"></i> <?=$tip_createname;?></a></li>
                    </ul><!-- .entry-meta end -->

                    <!-- Entry Image
                    ============================================= -->
                    <div class="entry-image">
                        <a href="#"><img src="<?=base_url('uploads/tip/'.$tip_imgcover);?>" alt="Blog Single"></a>
                    </div><!-- .entry-image end -->

                    <!-- Entry Content
                    ============================================= -->
                    <div class="entry-content notopmargin">
                        <p><?=$tip_detail;?></p>
                    </div>
                    <div>
                        <a href="<?=site_url('main/disdetail/'.$dis_id);?>" class="button button-rounded button-reveal button-large button-red tright"><i class="icon-angle-right"></i><span>กลับ</span></a>
                    </div>
                </div><!-- .entry end -->


            </div>

            </div><!-- .postcontent end -->
    </div>

</div>

</section><!-- #content end -->