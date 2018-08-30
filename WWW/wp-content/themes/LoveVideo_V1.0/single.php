<?php get_template_part( 'header', get_post_format() ); ?>
<body id="play" class="widescreen">
<div id="page-sya">
  <div id="mini-header">
    <div class="mini-hd">
      <div class="logo">
        <?php $options = get_option('mfthemes_options'); $logo =  $options['logo'] ? $options['logo'] : get_bloginfo('template_url')."/assets/images/logo.png" ;?>
        <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a></div>
      <div class="mini-nav">
        <ul class="mn-list">
          <li class="menu-item first"><a title="首页" href="<?php bloginfo('siteurl'); ?>">首页</a></li>
          <?php
echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", 
wp_nav_menu(array('theme_location' => 'primary3', 'echo' => false)) ));
?>
        </ul>
      </div>
      <div class="mini-searchpanel" style="z-index: 20;">
        <form action="<?php bloginfo('siteurl'); ?>" method="get" target="_blank">
          <div class="hs">
            <div class="input-ys">
              <input type="text" value="" name="s" class="input" id="ugcSearchTxt" autocomplete="off">
              <script language="javascript">
                        jQuery(function($){
                            var static_ugc_kw_top = ''; 
                            $('#ugcSearchTxt').placehorder(static_ugc_kw_top.split(','), 5000);
                        });
                    </script> 
            </div>
            <input type="submit" value="搜索" class="button">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="bd">
    <div class="caption-wrap">
      <div class="caption">
        <h1 class="ptitle" is_over="0" play_num="0" itemprop="name"><?php echo trim(wp_title('',0)); ?></h1>
        <div class="zbx">
          <div class="crumb">
            <?php the_breadcrumb(); ?>
            <a class="ico-dibbling" title="正在播放"></a> </div>
          <span class="ptitle-cum">
          <?php the_tags(' ', '/ ', ''); ?>
          </span> </div>
        <div class="pps-download-sya">
          <?php mfthemes_player_menu_ad();?>
        </div>
      </div>
    </div>
    <div class="player-wrap">
      <div class="bx" id="p-players">
        <div class="bd">
          <div class="flash-player" id="a1">
            <?php 
				$video_embed = get_post_meta($post->ID,"video_url",true);
				if(!empty($video_embed)) {
			?>
            <script type="text/javascript">
	var flashvars={
		a:'<?php echo get_post_meta($post->ID,"video_url",true); ?>',
		};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always'};
	CKobject.embedSWF('<?php bloginfo('template_url');?>/player/player.swf','a1','ckplayer_a1','100%','480',flashvars,params);
  </script>
            <?php } ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                  <?php the_content('Read more...'); ?>
                <?php endwhile;endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="behavior-wrap">
      <div class="behavior">
        <div id="tool-bar" class="v-user-behavior">
          <ul class="behavior-list">
            <li class="bhv-item behavior-share"> <span class="share-t" data-tigger="share">分享到：</span>
              <div class="bdsharebuttonbox"> <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间">QQ空间</a> <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">新浪微博</a> <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博">腾讯微博</a> <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网">人人网</a> <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">微信</a> <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友">QQ好友</a> </div>
              <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script> 
            </li>
            <li class="bhv-item trans"><a href="#comments" class="ta"><span class="tai"><b class="ico-pinglun"></b></span><span class="tas">评论<item style="display:none;" itemprop="commentNum">0</item></span></a></li>
            <li data-tigger="data-info" class="bhv-item play-data-item">
              <div class="play-data"><span class="inbok">播放：<em class="fB">
                <?php the_views();?>
                </em>次</span></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="show-list">
      <div class="bx-syb pitch plug-tab" id="movie-set">
        <div class="hd">
          <ul class="tab-syb tab">
            <li class="tab-item drop-trigger select"> <span class="tb" curr_type="正在播放" i="0"><em class="t" title="正在播放">正在播放</em><b class="ico-sl ico-sl-arrow"></b></span> </li>
          </ul>
        </div>
        <div class="bd">
          <div class="tab-panel show-b">
            <div class="set-sort-sye scroll-plug-sya scroll-trigger-syb">
              <div class="scroll-wrap">
                <ul class="p-list120-68 p-list2">
                  <li class="p-item playing">
                    <div class="series-marks"> <a href="javascript:void(0);" class="thumb-outer" title="<?php echo trim(wp_title('',0)); ?>"> <img width="120" height="68" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=120&h=68" class="thumb" alt="<?php echo trim(wp_title('',0)); ?>"><span class="ico-play-sya"><b class="b">播放</b></span> <span class="status">播放中</span> <span class="status2"><?php echo get_post_meta($post->ID,"video_time",true); ?></span> </a> </div>
                  </li>
                  <li style="height:90px;width:768px;float:left;">
                    <?php mfthemes_player_button_ad();?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="main">
      <div class="right">
        <div class="bx-sya pitch">
          <div class="hd">
            <h2 class="h">电影：<a href="<?php the_permalink() ?>" target="_blank">
              <?php the_title(); ?>
              </a></h2>
          </div>
          <div class="bd">
            <ul class="vedio-info-list wt-list">
              <?php 
				$video_dir = get_post_meta($post->ID,"video_dir",true);
				if(!empty($video_dir)) {
			?>
              <li class="wt-item ">
                <div class="wt">导演：</div>
                <div class="wtc"> <item itemprop="director" itemscope="" itemtype="http://schema.org/Person"> <item><item itemprop="name"><?php echo get_post_meta($post->ID,"video_dir",true); ?></item></item> </item> </div>
              </li>
              <?php } ?>
              <?php 
				$video_star = get_post_meta($post->ID,"video_star",true);
				if(!empty($video_star)) {
			?>
              <li class="wt-item ">
                <div class="wt">主演：</div>
                <div class="wtc"> <item itemprop="actor" itemscope="" itemtype="http://schema.org/Person"> <item><item itemprop="name"><?php echo get_post_meta($post->ID,"video_star",true); ?></item></item> </item> </div>
              </li>
              <?php } ?>
              <?php 
				$video_type = get_post_meta($post->ID,"video_type",true);
				if(!empty($video_type)) {
			?>
              <li class="wt-item ">
                <div class="wt">类型：</div>
                <div class="wtc"><item itemprop="genre"><?php echo get_post_meta($post->ID,"video_type",true); ?></item>&nbsp;</div>
              </li>
              <?php } ?>
              <?php 
				$video_area = get_post_meta($post->ID,"video_area",true);
				if(!empty($video_area)) {
			?>
              <li class="wt-item">
                <div class="wt">地区：</div>
                <div class="wtc"><?php echo get_post_meta($post->ID,"video_area",true); ?></div>
              </li>
              <?php } ?>
              <?php 
				$video_issue = get_post_meta($post->ID,"video_issue",true);
				if(!empty($video_issue)) {
			?>
              <li class="wt-item">
                <div class="wt">发行：</div>
                <div class="wtc"><?php echo get_post_meta($post->ID,"video_issue",true); ?></div>
              </li>
              <?php } ?>
			  <?php 
				$video_issue = get_post_meta($post->ID,"video_about",true);
				if(!empty($video_issue)) {
			?>
              <li class="brief wt-item">
                <div class="wt">简介：</div>
                <div class="wtc">
                  <?php echo get_post_meta($post->ID,"video_about",true); ?>
                </div>
              </li>
			  <?php } ?>
            </ul>
          </div>
        </div>
        <div class="bx-sya pitch">
          <div class="hd">
            <h2 class="h">热播排行榜</h2>
          </div>
          <div class="bd">
            <?php $posts = get_posts( "category_name=yugao&tag=即将上线&numberposts=5" ); ?>
            <?php if( $posts ) : ?>
            <ul class="p-list-syb">
              <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
              <li class="p-item"> <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank" class="thumb-outer"><img alt="<?php the_title(); ?>" width="145" height="80" class="thumb" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=110&h=70"></a>
                <div class="p-info">
                  <div class="t"><a href="<?php the_permalink() ?>" target="_blank">
                    <?php the_title(); ?>
                    </a></div>
                  <div class="sub"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
                  <div class="sub">播放次数:
                    <?php the_views();?>
                  </div>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="left">
        <div class="bx-syc plug-tab pitch">
          <div class="hd">
            <ul class="tab-sye tab">
              <li class="tab-item select"><span class="ti">猜你喜欢</span></li>
            </ul>
          </div>
          <div class="bd">
            <ul class="major-list p-list tab-panel ">
              <?php foreach(get_the_category() as $category){$cat = $category->cat_ID;}
query_posts('cat=' . $cat . '&orderby=rand&showposts=4'); 
while (have_posts()) : the_post();$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');?>
              <li class="p-item"> <a class="thumb-outer" href="<?php the_permalink() ?>" target="_blank"> <img alt="" class="thumb" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"></a>
                <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank">
                  <?php the_title(); ?>
                  </a></div>
                <div class="des">播放次数：
                  <?php the_views();?>
                </div>
              </li>
              <?php endwhile; wp_reset_query(); ?>
            </ul>
          </div>
        </div>
		<?php mfthemes_content_ad();?>
        <div class="pitch" id="comments">
          <div class="sg-comment">
            <div class="articles">
              <?php comments_template(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div id="ft">
    <p>本网站服务于华人用户，受美国法律保护，请大陆网友自觉离开。本站不承担由于内容的合法性及健康性所引起的一切争议和法律责任。 <br>
      
	<?php $options = get_option('mfthemes_options');
			if( $options['footer']){?>
				<?php echo $options['footer'];?> Theme By <a href="http://www.baidu.com" title="互联网">Hello</a>
			<?php }else{?>
    <p> <?php copyrightDate() ?> <?php bloginfo('name'); ?> All Rights Reserved.</p> 
	<p> Powered <a href="http://www.baidu.com" title="互联网">Hello</a></p> 
	<?php }?>
  </div>
  <div class="side-tool" id="J_sideTool">
    <div class="handle return-top" style="display: block;"> <a href="#"><span class="ico ico-top"></span>返回顶部</a> </div>
  </div>
</div>
<?php $options = get_option('mfthemes_options');
	if( $options['analysis']){?>
	<div id="analysis" style="display:none"><?php echo $options['analysis'];?></div>
	<?php }?>
	<script type="text/javascript" src="https://js.users.51.la/19601381.js"></script>
</body>
</html>