<!-- Content
============================================= -->
<section id="content">

<div class="content-wrap">

    <div class="container clearfix">
        <!-- Posts 
        ============================================= -->
		<div id="posts" class="post-grid grid-container post-masonry clearfix">
            <?PHP if(count($listMedia) != 0){?>
                <?PHP foreach ($listMedia as $key => $value) {?>
            <div class="entry clearfix">
                <div class="entry-image">
                    <a href="<?=site_url('main/listvideodetail/'.$value['med_id']);?>"><img class="image_fade" src="<?=base_url('uploads/media/'.$value['med_imgcover']);?>" alt=""></a>
                </div>
                <div class="entry-title">
                    <h2><a href="<?=site_url('main/listvideodetail/'.$value['med_id']);?>"><?=$value['med_title']?></a></h2>
                </div>
            </div>
                <?PHP }?>
            <?PHP }?>
        </div>
    </div>

</div>

</section><!-- #content end -->