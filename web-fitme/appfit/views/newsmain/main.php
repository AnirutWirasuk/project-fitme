<!-- Content
============================================= -->
<section id="content">

<div class="content-wrap">

    <div class="container clearfix">
        <!-- Posts 
        ============================================= -->
		<div id="posts" class="post-grid grid-container post-masonry clearfix">
            <?PHP if(count($listNews) != 0){?>
                <?PHP foreach ($listNews as $key => $value) {?>
            <div class="entry clearfix">
                <div class="entry-image">
                    <a href="<?=site_url('main/newsdetail/'.$value['news_id']);?>"><img class="image_fade" src="<?=base_url('uploads/news/'.$value['news_imgcover']);?>" alt=""></a>
                </div>
                <div class="entry-title">
                    <h2><a href="<?=site_url('main/newsdetail/'.$value['news_id']);?>"><?=$value['news_title']?></a></h2>
                </div>
                <div class="entry-content">
                    <p><?=character_limiter(strip_tags($value['news_detail']),50);?></p>
                </div>
            </div>
                <?PHP }?>
            <?PHP }?>
        </div>
    </div>

</div>

</section><!-- #content end -->