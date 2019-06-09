<!-- Content
============================================= -->
<section id="content">

<div class="content-wrap">

    <div class="container clearfix">
        <div class="row">
            <?PHP if(count($listAbout) != 0){?>
                <?PHP foreach ($listAbout as $key => $value) {?>
                <div class="col-md-6 bottommargin">

                    <div class="team team-list clearfix">
                        <div class="team-image">
                            <img src="<?=base_url('uploads/about/'.$value['ab_img']);?>" alt="">
                        </div>
                        <div class="team-desc">
                            <div class="team-title"><h4><?=$value['ab_fname']?> <?=$value['ab_lname']?></h4></div>
                            <div class="team-content">
                                <p>Tel:<?=$value['ab_tel']?></p>
                                <p>Email:<?=$value['ab_email']?></p>
                            </div>
                            <a href="<?=$value['ab_facebook']?>" class="social-icon si-rounded si-small si-facebook">
                                <i class="icon-facebook"></i>
                                <i class="icon-facebook"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <?PHP }?>
            <?PHP }?>
        </div>
    </div>

</div>

</section><!-- #content end -->