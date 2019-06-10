<!-- Content
============================================= -->
<section id="content">

<div class="content-wrap">

    <div class="container clearfix">
        <!-- Posts 
        ============================================= -->
		<div id="posts" class="post-grid grid-container post-masonry clearfix">
            <?PHP if(count($listType) != 0){?>
                <?PHP foreach ($listType as $key => $value) {?>
            <div class="entry clearfix">
                <div class="entry-title">
                    <h2><a href="<?=site_url('main/listvideo/'.$cate_id."/".$value['type_id']);?>"><?=$value['type_title']?></a></h2>
                </div>
            </div>
                <?PHP }?>
            <?PHP }?>
        </div>
    </div>

</div>

</section><!-- #content end -->