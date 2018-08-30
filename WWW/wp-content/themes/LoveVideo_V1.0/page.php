<?php 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo trim(wp_title('',0)); ?>&#160;&#45;&#160;
<?php bloginfo('description'); ?>
</title>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<link href="<?php bloginfo('template_url');?>/assets/styles/news.css" type="text/css" rel="stylesheet" />
<link href="<?php bloginfo('template_url');?>/assets/styles/base.css" type="text/css" rel="stylesheet" />
<link href="<?php bloginfo('template_url');?>/assets/styles/comments.css" type="text/css" rel="stylesheet" />
<script src="<?php bloginfo('template_url');?>/assets/scripts/dz9.net.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/comments-ajax.js"></script>
</head>

<div id="header">
  <div id="topbar">
    <div class="topbar-inner">
      <div class="bd clx">
        <div id="logo">
          <?php $options = get_option('mfthemes_options'); $logo =  $options['logo'] ? $options['logo'] : get_bloginfo('template_url')."/assets/images/logo.png" ;?>
          <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a> </div>
        <?php wp_nav_menu(array( 'theme_location'=>'primary4','container_id' => 'nav')); ?>
        <div id="options">
          <ul>
            <?php if ( is_user_logged_in() ) {
								global $current_user;
								get_currentuserinfo(); 
								$avatar = get_avatar( $current_user->user_email, 80);
							?>
            <li class="more-active"> <a class="more-top" href="<?php echo get_author_posts_url($current_user->ID);?>"><?php echo get_avatar( $current_user->user_email, 20);echo $current_user->display_name;?></a>
              <div class="more-items">
                <?php if( current_user_can( 'manage_options' ) ) {?>
                <div class="more-gap"></div>
                <div class="more-link more-manage"><a href="<?php bloginfo('url'); ?>/wp-admin/"><span>
                  <?php _e('Manage Options', 'LoveVideo');?>
                  </span></a></div>
                <?php }?>
                <div class="more-gap"></div>
                <div class="more-link more-video"><a href="<?php bloginfo('url'); ?>/wp-admin/post-new.php">发布视频</a></div>
                <div class="more-link more-profile"><a href="<?php bloginfo('url'); ?>/wp-admin/profile.php"><span>
                  <?php _e('Edit my profile', 'LoveVideo');?>
                  </span></a></div>
                <div class="more-gap"></div>
                <div class="more-link more-logout"><a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>" title="<?php _e('logout', 'LoveVideo');?>">
                  <?php _e('logout', 'LoveVideo');?>
                  </a></div>
              </div>
            </li>
            <?php }else{?>
            <li class="more-topx more-login"><a href="<?php bloginfo('url'); ?>/wp-login.php" class="loginin" title="<?php _e("login in", "LoveVideo");?>">
              <?php _e("login in", "LoveVideo");?>
              </a></li>
            <li class="more-topx"><a href="<?php bloginfo('url'); ?>/wp-login.php?action=register" class="signup" title="<?php _e("sign up", "LoveVideo");?>">
              <?php _e("sign up", "LoveVideo");?>
              </a></li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
    <div id="topbar-shadow"></div>
  </div>
</div>
<div id="content">
<div class="bd clx">
  <div id="single" class="clx">
    <div class="main">
      <div class="main-content">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <div class="widgets-data">
          <?php 
				global $post;
				$options = get_option('mfthemes_options');
				$linkOn = $options['mfthemes_link'];
				$link = get_mfthemes_link($post->ID);
				$title = $options['mfthemes_link_title'];;
			?>
          <ul class="clx">
            <li class="widgets-views"><a>
              <?php if(function_exists('the_views')){$views = str_replace("views", "", the_views(0));?>
              <span class="post-views post-span">
              <?php _e("Views", "LoveVideo");?>
              </span><small><?php echo $views;?></small>
              <?php }?>
              </a></li>
            <li class="widgets-comments"><a href="#comments"><span class="post-comments">评论</span><small><?php echo $post->comment_count;?></small></a></li>
            <li class="widgets-likes">
              <?php if(function_exists('mflikes')) mflikes('button2');  ?>
            </li>
            <?php if($linkOn){?>
            <li class="widgets-links"><a href="<?php echo $link;?>"><span></span><small><?php echo $title;?></small></a></li>
            <?php }?>
          </ul>
        </div>
        <div class="post <?php echo get_post_format();?>">
          <div class="main-header">
            <h2 class="main-title">
              <?php the_title();?>
            </h2>
            <div class="main-meta clx"><span class="post-span">
              <?php the_time('Y-m-d  G:i'); ?>
              </span> <span class="post-category post-span">
              <?php the_category(' '); ?>
              </span>
              <div class="main-share"> <span class="share-title">
                <?php _e('Share to&#58;', "LoveVideo");?>
                </span>
                <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"> <a class="bds_tsina"></a> <a class="bds_tieba"></a> <a class="bds_qzone"></a> <a class="bds_tqq"></a> <a class="bds_renren"></a> <span class="bds_more">更多</span> <a class="shareCount"></a> </div>
                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=<?php echo $baiduuid;?>" ></script> 
                <script type="text/javascript" id="bdshell_js"></script> 
                <script type="text/javascript">document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)</script> 
              </div>
            </div>
          </div>
          <div class="main-body">
            <?php the_content();?>
          </div>
          <div class="main-footer">
            <div class="clx">
              <div class="main-tags">
                <?php the_tags('', '     ', ' ');?>
              </div>
            </div>
          </div>
          <div class="main-navi clx">
            <div class="pages-next">
              <div class="inner">
                <?php if (get_previous_post()) { previous_post_link('%link');  } ?>
              </div>
            </div>
            <div class="pages-prev">
              <div class="inner">
                <?php if (get_next_post()) { next_post_link('%link'); }?>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile;endif; ?>
        <div class="articles">
          <?php comments_template(); ?>
        </div>
      </div>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<div id="footer">
  <div class="bd clx">
    <?php $options = get_option('mfthemes_options');
			if( $options['footer']){?>
    <?php echo $options['footer'];?>By <a href="tencent://message/?uin=2039153757&Site=im.qq.com&Menu=yes" title="Function">Function</a>
    <?php }else{?>
    <p>&copy; <?php echo date("Y");?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
      <?php bloginfo('name'); ?>
      </a> All Rights Reserved! </p>
    <p>Powered By<a href="tencent://message/?uin=2039153757&Site=im.qq.com&Menu=yes" title="mufeng">Function</a></p>
    <?php }?>
	<?php $options = get_option('mfthemes_options');
	if( $options['analysis']){?>
	<div id="analysis" style="display:none"><?php echo $options['analysis'];?></div>
	<?php }?>
  </div>
</div>
