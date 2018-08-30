<?php get_template_part( 'header', get_post_format() ); ?>
<body >
<div id="hd">
  <div class="pps-header">
    <div class="header-inner">
      <div class="pps-logo">
        <?php $options = get_option('mfthemes_options'); $logo =  $options['logo'] ? $options['logo'] : get_bloginfo('template_url')."/assets/images/logo.png" ;?>
        <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a></div>
      <div class="pps-so">
        <div class="pps-so-panel">
          <form target="_blank" action="<?php bloginfo('siteurl'); ?>" method="get">
            <input type="text" id="tsText" class="input" name="s" value="" onblur="if(this.value==&#39;&#39;){this.value=defaultValue};this.className=&#39;input&#39;" onfocus="if(this.value==defaultValue){this.value=&#39;&#39;};this.className=&#39;input input_fouse&#39;" autocomplete="off">
            <input type="submit" class="button" value="搜索" >
          </form>
          <span class="ico-h-so"></span> </div>
        <div class="pps-so-suggest">
          <ul class="suggest-list">
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="pps-nav">
    <div class="nav-inner">
      <div class="nav-main">
        <ul class="nav-list">
          <li class="nav-item nav-index"><a href="<?php bloginfo('siteurl'); ?>" >首页</a></li>
          <li class="nav-item">
            <?php 
	$menuParameters = array(
	    'theme_location'=>'primary',
		'container'	=> false,
		'echo'	=> false,
		'items_wrap' => '%3$s',
		'depth'	=> 0,
	    );
	   echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
                    ?>
          </li>
        </ul>
      </div>
      <div class="pps-download-sya">
        <div class="ddl"> <a> <em class="pps-pic">
          <?php mfthemes_main_ad();?>
          </em> </a> </div>
      </div>
    </div>
  </div>
</div>
<?php mfthemes_before_content();?>
<div class="ge"></div>
<div id="bd"> 
  <!--col-sya-->
  <div class="col-sya p-cols">
    <div class="p-col1">
      <div class="p-col1-1">
        <div class="bx pitch">
          <div class="hd">
            <h2 id="强档热播" class="h">推荐影片</h2>
            <span class="adorn-blue adorn"></span></div>
          <div class="bd" >
            <ul class="p-list">
              <?php
$sticky = get_option('sticky_posts');
rsort( $sticky );
$sticky = array_slice( $sticky, 0, 10);
query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) );
if (have_posts()) :
while (have_posts()) : the_post();
?>
              <li class="p-item"> <a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>" rel="bookmark" class="thumb-outer"> <img alt="<?php the_title(); ?>" width="148" height="216" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216" class="thumb"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"> <b class="ico-video-quality"></b> </span> </a>
                <div class="t"><a href="<?php the_permalink(); ?>" target="_blank">
                  <?php the_title(); ?>
                  </a></div>
                <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
              </li>
              <?php endwhile; endif; ?>
            </ul>
          </div>
        </div>
        <div class="bx pitch">
          <div class="hd">
            <h2 id="新片速递" class="h">最新上传</h2>
            <span class="adorn-blue adorn"></span></div>
          <div class="bd">
            <div class="tab"> <a href="javascript:void(0)" class="tab-item select">国产</a>/<a href="javascript:void(0)" class="tab-item">欧美</a>/<a href="javascript:void(0)" class="tab-item">日韩</a>/<a href="javascript:void(0)" class="tab-item"></a> </div>
            <div class="tab-panel">
              <?php $posts = get_posts( "category_name=huayu&numberposts=5" ); ?>
              <?php if( $posts ) : ?>
              <ul class="p-list">
                <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
                <li class="p-item"> <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>" class="thumb-outer"> <img width="148" height="216" class="thumb" alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"><b class="ico-video-quality"></b></span> </a>
                  <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                    </a></div>
                  <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
                </li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
            <div class="tab-panel hide">
              <?php $posts = get_posts( "category_name=oumei&numberposts=5" ); ?>
              <?php if( $posts ) : ?>
              <ul class="p-list">
                <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
                <li class="p-item"> <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>" class="thumb-outer"> <img width="148" height="216" class="thumb" alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"><b class="ico-video-quality"></b></span> </a>
                  <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                    </a></div>
                  <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
                </li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
            <div class="tab-panel hide">
              <?php $posts = get_posts( "category_name=rihan&numberposts=5" ); ?>
              <?php if( $posts ) : ?>
              <ul class="p-list">
                <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
                <li class="p-item"> <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>" class="thumb-outer"> <img width="148" height="216" class="thumb" alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"><b class="ico-video-quality"></b></span> </a>
                  <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                    </a></div>
                  <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
                </li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
            <div class="tab-panel hide">
              <?php $posts = get_posts( "category_name=yugao&numberposts=5" ); ?>
              <?php if( $posts ) : ?>
              <ul class="p-list">
                <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
                <li class="p-item"> <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>" class="thumb-outer"> <img width="148" height="216" class="thumb" alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"><b class="ico-video-quality"></b></span> </a>
                  <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                    </a></div>
                  <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
                </li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="bx pitch">
          <div class="hd">
            <h2 id="华语电影" class="h">国产自拍</h2>
            <span class="adorn-blue adorn"></span></div>
          <div class="bd">
            <?php $posts = get_posts( "category_name=huayu&tag=推荐&numberposts=5" ); ?>
            <?php if( $posts ) : ?>
            <ul class="p-list">
              <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
              <li class="p-item"> <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>" class="thumb-outer"> <img width="148" height="216" class="thumb" alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"><b class="ico-video-quality"></b></span> </a>
                <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                  </a></div>
                <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php
    $category_id = get_cat_ID( '华语' );
    $category_link = get_category_link( $category_id );
?>
            <div class="act"><a href="<?php echo esc_url( $category_link ); ?>" class="more" target="_blank">更多<em>&gt;&gt;</em></a></div>
          </div>
        </div>
        <div class="bx pitch">
          <div class="hd">
            <h2 id="欧美电影" class="h">欧美情色</h2>
            <span class="adorn-blue adorn"></span></div>
          <div class="bd">
            <?php $posts = get_posts( "category_name=oumei&tag=推荐&numberposts=5" ); ?>
            <?php if( $posts ) : ?>
            <ul class="p-list">
              <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
              <li class="p-item"> <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>" class="thumb-outer"> <img width="148" height="216" class="thumb" alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"><b class="ico-video-quality"></b></span> </a>
                <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                  </a></div>
                <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php
    $category_id = get_cat_ID( '欧美' );
    $category_link = get_category_link( $category_id );
?>
            <div class="act"><a href="<?php echo esc_url( $category_link ); ?>" class="more" target="_blank">更多<em>&gt;&gt;</em></a></div>
          </div>
        </div>
        <div class="bx pitch">
          <div class="hd">
            <h2 id="日韩电影" class="h">亚洲情色</h2>
            <span class="adorn-blue adorn"></span></div>
          <div class="bd">
            <?php $posts = get_posts( "category_name=rihan&tag=推荐&numberposts=5" ); ?>
            <?php if( $posts ) : ?>
            <ul class="p-list">
              <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
              <li class="p-item"> <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>" class="thumb-outer"> <img width="148" height="216" class="thumb" alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"><b class="ico-video-quality"></b></span> </a>
                <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                  </a></div>
                <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php
    $category_id = get_cat_ID( '日韩' );
    $category_link = get_category_link( $category_id );
?>
            <div class="act"><a href="<?php echo esc_url( $category_link ); ?>" class="more" target="_blank">更多<em>&gt;&gt;</em></a></div>
          </div>
        </div>
        <div class="bx">
          <div class="hd">
            <h2 id="经典回顾" class="h">宅男精品</h2>
            <span class="adorn-blue adorn"></span></div>
          <div class="bd">
            <?php $posts = get_posts( "category_name=jingdian&tag=推荐&numberposts=5" ); ?>
            <?php if( $posts ) : ?>
            <ul class="p-list">
              <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
              <li class="p-item"> <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>" class="thumb-outer"> <img width="148" height="216" class="thumb" alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=148&h=216"> <span class="video-quality video-quality<?php echo get_post_meta($post->ID,"video_quality",true); ?>"><b class="ico-video-quality"></b></span> </a>
                <div class="t"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                  <?php the_title(); ?>
                  </a></div>
                <div class="des"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php
    $category_id = get_cat_ID( '经典' );
    $category_link = get_category_link( $category_id );
?>
            <div class="act"><a href="<?php echo esc_url( $category_link ); ?>" class="more" target="_blank">更多<em>&gt;&gt;</em></a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="p-col3">
      <div class="retrieve bx-sya pitch">
        <div class="bd">
          <ul class="retrieve-list">
            <li> <span class="rt">类型：</span> <a href="?tag=国产/" title="国产">国产</a> <a href="?tag=欧美色情/" title="欧美色情">欧美色情</a> <a href="?tag=亚洲情色/" title="亚洲情色">亚洲情色</a> <a href="?tag=高清AV/" title="高清AV">高清AV</a> <a href="?tag=变态另类/" title="变态另类">变态另类</a> <a href="?tag=偷拍自拍/" title="偷拍自拍">偷拍自拍</a>  </li>
           
            
          </ul>
          <div class="mini-seacher">
            <form action="<?php bloginfo('siteurl'); ?>" method="get" target="_blank">
              <input class="input fl" name="s" type="text">
              <input class="button fl" type="submit" value="">
            </form>
          </div>
          
        </div>
      </div>
      <div class="rank bx-sya pitch">
        <div class="hd">
          <h2 class="h">用户观看排行</h2>
          <span class="ico-rank ico"></span></div>
        <div class="bd">
          <table>
            <tr>
              <td class="ph"></td>
              <td><ol class="rank-list tab-panel">
                  <?php if (function_exists('get_most_viewed')): ?>
                  <ul>
                    <?php get_most_viewed('post',10,20); ?>
                  </ul>
                  <?php endif; ?>
                </ol></td>
            </tr>
          </table>
          <div class="textwidget">
            <div id="sslider">
              <div id="sslider-wrap">
                <div id="sslider-main">
                  <?php mfthemes_paihang_ad();?>
                </div>
              </div>
              <span id="sslider-prev">&lt;</span><span id="sslider-next">&gt;</span> </div>
            <script>
jQuery(function ($) {
var sslider=$("#sslider-wrap"), n=0, l=$("a",sslider).length;
function go() {if(n<0)n=l-1;if(n>l-1)n=0;sslider.stop().animate({"scrollLeft":n*250});};
$("#sslider-next").click(function(){go(n++);});
$("#sslider-prev").click(function(){go(n--);});
var timer = setInterval(function(){$("#sslider-next").trigger("click")},5e3);
sslider.hover(function(){clearInterval(timer)},function(){timer=setInterval(function(){$("#sslider-next").trigger("click")},5e3)})
});
</script></div>
        </div>
      </div>
      <div class="bx-sya pitch">
        <div class="hd">
          <h2 class="h">即将上线</h2>
        </div>
        <div class="bd">
          <?php $posts = get_posts( "category_name=yugao&tag=即将上线&numberposts=5" ); ?>
          <?php if( $posts ) : ?>
          <ul class="p-list-syb">
            <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
            <li class="p-item"> <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank" class="thumb-outer"><img alt="<?php the_title(); ?>" width="110" height="70" class="thumb" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo get_post_meta($post->ID,"video_poster",true); ?>&w=110&h=70"></a>
              <div class="p-info">
                <div class="t"><a href="<?php the_permalink() ?>" target="_blank">
                  <?php the_title(); ?>
                  </a></div>
                <div class="sub"><?php echo get_post_meta($post->ID,"video_desc",true); ?></div>
                <div class="sub"><?php echo get_post_meta($post->ID,"video_date",true); ?></div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
      </div>
      <?php mfthemes_zhuanti_content();?>
      <div class="bx-sya pitch attention">
        <div class="hd">
          <h2 class="h">关注我们</h2>
        </div>
        <div class="bd">
          <div class="attention-bd">
            <?php
	$options = get_option('mfthemes_options');
	if( $options['index_tsina']);
?>
            <wb:bulkfollow uids="<?php echo $options['index_tsina'];?>" type="0" width="292" border="0" count="3" color="FFFFFF,fbf9f9,000000,000000" titlebar="n" info="n" verified="n">
              <iframe src="http://widget.weibo.com/relationship/bulkfollow.php?uids=<?php echo $options['index_tsina'];?>&amp;sense=0&amp;verified=0&amp;count=3&amp;width=292&amp;height=489&amp;color=FFFFFF,fbf9f9,000000,000000&amp;nick=0&amp;language=zh_cn&amp;showtitle=0&amp;showinfo=0&amp;wide=0&amp;refer=http%3A%2F%2Fwww.dz9.net%2Fmovie%2F" width="292" height="489" frameborder="0" scrolling="no" marginheight="0"></iframe>
            </wb:bulkfollow>
          </div>
        </div>
      </div>
      <div class="bx-sya">
        <div class="hd">
          <h2 class="h">手机扫一扫</h2>
        </div>
        <div class="bd">
          <ul class="load-app-list">
            <li class="p-item"> 
              <script>
thisURL = document.URL;
strwrite = "<img src='http://qr.liantu.com/api.php?m=5&text=" + thisURL + "' width='246' height='246' alt='二维码' class='img'/>";
document.write( strwrite );
</script> 
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_template_part( 'footer', get_post_format() ); ?>
