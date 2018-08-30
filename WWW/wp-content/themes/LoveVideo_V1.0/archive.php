<?php get_template_part( 'header', get_post_format() ); ?>
<body>
<div id="hd">
  <div class="pps-mini-header" >
    <div class="header-inner">
      <div class="pps-logo">
        <?php $options = get_option('mfthemes_options'); $logo =  $options['logo'] ? $options['logo'] : get_bloginfo('template_url')."/assets/images/logo.png" ;?>
        <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a></div>
      <div class="pps-mini-nav">
        <ul class="nav-list">
          <li class="nav-item"><a href="<?php bloginfo('siteurl'); ?>" class="na">首页</a></li>
          <li class="nav-item">
            <div class="drop-down-sya J_drop_down">
              <div class="drop-trigger"><a href="javascript:void(0);" class="na">全部<span class="ico-h-arrow-sya"></span></a></div>
              <div class="drop-panel">
                <ul class="dp-nav-list">
                  <?php
echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", 
wp_nav_menu(array('theme_location' => 'primary', 'echo' => false)) ));
?>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="pps-so">
        <div class="pps-so-panel">
          <form target="_blank" action="<?php bloginfo('siteurl'); ?>" method="get">
            <input type="text" class="input" value="" name="s" >
            <input type="submit" class="button" value="搜索">
          </form>
          <span class="ico-h-so"></span> </div>
        <div class="pps-so-suggest">
          <ul class="suggest-list">
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="bd">
  <div class="col-sye p-cols">
    <div class="p-col1">
      <div class="p-col1-1">
        <div class="bx-syc">
          <div class="hd">
            <h2 class="h">
              <?php if(is_category()){
						_e('category&#58;', 'LoveVideo');
					}else if(is_tag()){
						_e('tag&#58;', 'LoveVideo');
					}?>
              <span class="span">
              <?php single_cat_title(); ?>
              </span></h2>
            <span class="adorn-ashy adorn"></span> </div>
          <div class="bd">
            <div class="filter">
              <ul class="tab-sya">
                <li class="tab-sya-item select"> <a href="javascript:void(0);" class="tab-link">最近更新<span class="denote">▼</span></a> </li>
              </ul>
            </div>
            <div class="content">
              <ul class="p-list-syd">
                <?php 
  global $query_string;
  query_posts($query_string.'&showposts=20&caller_get_posts=1'); ?>
                <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post(); ?>
                <li class="p-item"> <a href="<?php the_permalink(); ?>" class="thumb-outer thumb-outer-sya" target="_blank"> <img width="148" height="216" alt="<?php the_title();?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216" />
                  <div class="mask"> <span class="status right"> <?php echo get_post_meta($post->ID,"video_time",true); ?> </span> <span class="bg"></span> </div>
                  <span class="ico-play-64"></span>
                  <div class="mask-sya"></div>
                  </a>
                  <div class="t"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" target="_blank">
                    <?php the_title();?>
                    </a></div>
                  <div class="sub">播放次数：
                    <?php the_views();?>
                  </div>
                </li>
                <?php endwhile; ?>
                <?php endif; ?>
              </ul>
              <div class="page-nav-sya">
                <?php pagenavi();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="p-col3">
      <div class="cate-dir">
        <div class="hd">
          <h5 class="t">分类检索</h5>
        </div>
        <div class="bd">
          <ul class="cate-dir-list">
            <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'primary', 'echo' => false)) )); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_template_part( 'footer', get_post_format() ); ?>
