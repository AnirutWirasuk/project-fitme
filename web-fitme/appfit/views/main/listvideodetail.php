<?PHP 
    if(count($listMedia) != 0){
        foreach ($listMedia as $key => $value) {
            $med_title = $value['med_title'];
            $med_files = $value['med_files'];
            $lastedit_name = $value['lastedit_name'];
            $lastedit_date = $value['lastedit_date'];
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
                        <h2><?=$med_title;?></h2>
                    </div><!-- .entry-title end -->

                    <!-- Entry Meta
                    ============================================= -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> <?=date('d/m/Y', strtotime($lastedit_date));?></li>
                        <li><a href="#"><i class="icon-user"></i> <?=$lastedit_name;?></a></li>
                    </ul><!-- .entry-meta end -->

                    <!-- Entry Image
                    ============================================= -->
                    <div class="entry-image">
                    <iframe width="100%" height="auto" src="<?=$med_files?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div><!-- .entry-image end -->

                </div><!-- .entry end -->


            </div>

            </div><!-- .postcontent end -->
    </div>

</div>

</section><!-- #content end -->