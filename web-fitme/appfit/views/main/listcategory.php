<!-- Content
============================================= -->
<section id="content">

<div class="content-wrap">

    <div class="container clearfix">
        <!-- Posts 
        ============================================= -->
		<div id="posts" class="post-grid grid-container post-masonry clearfix">
            <?PHP if(count($listCategory) != 0){?>
                <?PHP foreach ($listCategory as $key => $value) {?>
            <div class="entry clearfix">
                <div class="entry-image">
                    <a href="<?=site_url('main/listtype/'.$value['cate_id']);?>"><img class="image_fade" src="<?=base_url('uploads/category/'.$value['cate_imgover']);?>" alt=""></a>
                </div>
                <div class="entry-title">
                    <h2><a href="<?=site_url('main/listtype/'.$value['cate_id']);?>"><?=$value['cate_title']?></a></h2>
                </div>
            </div>
                <?PHP }?>
            <?PHP }?>
        </div>
    </div>

</div>

</section><!-- #content end -->