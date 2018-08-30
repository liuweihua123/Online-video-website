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
<div id="main"> 
  <div class="single-video">
    <ul class="horn-list-syb p-list">
      <?php $rand_post = get_posts('numberposts=5&orderby=rand');  foreach( $rand_post as $post ) : ?>
      <li class="p-item _stat_play_recommend" data-standard="ipd_not_play_rec" data-model="hotallvideo" data-channel-id="200518280" data-source-block="ipd_not_play_rec"> <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="thumb-outer"> <img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=140&h=200" alt="<?php the_title(); ?>" class="thumb">
        <div class="mask"> <span class="status"><?php echo get_post_meta($post->ID,"video_time",true); ?></span> <span class="bg"></span> </div>
        <span class="ico-play">播放</span> </a>
        <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
          <?php the_title(); ?>
          </a></div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="error-bx s-bx">
    <div class="bd">
      <div class="collr">
        <div class="coll"><b class="ico3 ico-error"></b></div>
        <div class="colr">
          <h2 class="tit">非常抱歉，我们未能找到您所访问的地址</h2>
          <p class="in"> 您可能遇到了以下问题:<br>
            <em class="x">*</em>该视频可能已经被删除。 <br>
            <em class="x">*</em>如果您是在地址栏输入或复制粘贴地址出现问题，请检查地址拼写是否正确。<br>
            <em class="x">*</em>您可以尝试点击刷新按钮，重新载入该页面。 </p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_template_part( 'footer', get_post_format() ); ?>
