<?PHP 
    if(count($listNews) != 0){
        foreach ($listNews as $key => $value) {
            $news_imgcover = $value['news_imgcover'];
            $news_title = $value['news_title'];
            $news_detail = $value['news_detail'];
            $news_createdate = $value['news_createdate'];
            $news_createname = $value['news_createname'];
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
                        <h2><?=$news_title;?></h2>
                    </div><!-- .entry-title end -->

                    <!-- Entry Meta
                    ============================================= -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> <?=date('d/m/Y', strtotime($news_createdate));?></li>
                        <li><a href="#"><i class="icon-user"></i> <?=$news_createname;?></a></li>
                    </ul><!-- .entry-meta end -->

                    <!-- Entry Image
                    ============================================= -->
                    <div class="entry-image">
                        <a href="#"><img src="<?=base_url('uploads/news/'.$news_imgcover);?>" alt="Blog Single"></a>
                    </div><!-- .entry-image end -->

                    <!-- Entry Content
                    ============================================= -->
                    <div class="entry-content notopmargin">
                        <p><?=$news_detail;?></p>
                    </div>
                </div><!-- .entry end -->


            </div>

            </div><!-- .postcontent end -->
    </div>

</div>

</section><!-- #content end -->