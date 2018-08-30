<?php
/**
 * Theme functions file
 *
 *
 * @package LoveVideo
 * @author 东少
 */
require( dirname(__FILE__) . '/functions/metaboxclass.php' );
require( dirname(__FILE__) . '/functions/metabox.php' );
// Theme-specific files
require( dirname(__FILE__) . '/functions/mfthemes-function.php' );

//开启友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );


//楼层/回复/头像缓存
function gsky_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
global $commentcount,$wpdb, $post;
     if(!$commentcount) { //初始化楼层计数器
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);//获取主评论总数量
          $page = get_query_var('cpage');//获取当前评论列表页码
          $cpp=get_option('comments_per_page');//获取每页评论显示数量
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;//如果评论只有1页或者是最后一页，初始值为主评论总数
         } else {
             $commentcount = $cpp * $page + 1;
         }
     }
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php $add_below = 'div-comment'; ?>
		<div class="comment-author vcard">
			<?php $f = md5(strtolower($comment->comment_author_email)); ?>
			<?php $avas = get_option('sky_avatarurl'); ?>
			<div class="avatars"><img src='http://gravatar.duoshuo.com/avatar/<?php echo $f ?>?s=42&d=&r=G' alt='' class='avatar' /></div>
                <?php { echo ''; } ?>
					<div class="floor">
					<span style="color:yellowgreen;"><?php
 if(!$parent_id = $comment->comment_parent){
   switch ($commentcount){
     default:printf('#%1$s　', --$commentcount);
   }
 }
 ?></span>
<?php get_author_class($comment->comment_author_email,$comment->user_id)?>　
 <span class="datetime"><?php comment_date('Y-m-d H:i') ?><?php edit_comment_link('[编辑]','&nbsp;','&nbsp;'); ?></span>
<span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '回复TA', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
         </div><spans><?php comment_author_link() ?></spans><?php comment_links_title($comment->comment_author_email); ?><?php if(user_can($comment->user_id, 1)){echo "<a title='官方人员' class='vip'></a>";}; ?>:</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<span style="color:#C00; font-style:inherit">由于你是第一次评论，所以需要审核一下下，已加入审核列队...</span>
			<br />			
		<?php endif; ?>
		<?php comment_text() ?>
        
		<div class="clear"></div>
		
  </div>
<?php
}
function gsky_end_comment() {
		echo '</li>';
}
//HTTP响应拆分漏洞   
$redirect = trim(str_replace("\r","",str_replace("\r\n","",strip_tags(str_replace("'","",str_replace("\n", "", str_replace(" ","",str_replace("\t","",trim($redirect))))),""))));

//获取当前网页的完整URL
function curPageURL(){
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on"){$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80"){$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];}
    else{$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];}
    return $pageURL;}
//获取访客VIP样式
function get_author_class($comment_author_email,$user_id){
global $wpdb;
$author_count = count($wpdb->get_results(
"SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
/*如果不需要管理员显示VIP标签，就把下面一行的“//”去掉*/
//$adminEmail = get_option('admin_email');if($comment_author_email ==$adminEmail) return;
if($author_count>=5 && $author_count<10)
echo '<a class="vip1" title="LV.1"></a>';
else if($author_count>=10 && $author_count<50) 
echo '<a class="vip2" title="LV.2"></a>';
else if($author_count>=50 && $author_count<200)
echo '<a class="vip3" title="LV.3"></a>'; 
else if($author_count>=200 && $author_count<400) 
echo '<a class="vip4" title="LV.4"></a>'; 
else if($author_count>=400 &&$author_count<650) 
echo '<a class="vip5" title="LV.5 闪亮登场"></a>'; 
else if($author_count>=650 && $author_count<1000) 
echo '<a class="vip6" title="LV.6 管理员一样的存在"></a>'; 
else if($author_count>=1000) 
echo '<a class="vip7" title="神一样的人物 V1000+"></a>'; 
}
//认证用户
function comment_links_title($email = ''){
$links=array(
'1'=>'x@mtu2.com',
'2'=>'932340056qq.com',
); //添加你想要设置个性图片的评论者Email，格式参考我写的
if(in_array($email,$links))
echo '<a class="vp" title="认证用户"></a>';
}
//垃圾评论拦截
class anti_spam {
  function anti_spam() {
if ( !current_user_can('level_0') ) {
  add_action('template_redirect', array($this, 'w_tb'), 1);
  add_action('init', array($this, 'gate'), 1);
  add_action('preprocess_comment', array($this, 'sink'), 1);
    }
  }
  function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
    }
  }
  function gate() {
    if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
      $_POST['comment'] = $_POST['w'];
    } else {
      $request = $_SERVER['REQUEST_URI'];
      $referer = isset($_SERVER['HTTP_REFERER'])         ? $_SERVER['HTTP_REFERER']         : '隐瞒';
      $IP      = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] . ' (透过代理)' : $_SERVER["REMOTE_ADDR"];
      $way     = isset($_POST['w'])                      ? '手动操作'                       : '未经评论表格';
      $spamcom = isset($_POST['comment'])                ? $_POST['comment']                : null;
      $_POST['spam_confirmed'] = "请求: ". $request. "\n来路: ". $referer. "\nIP: ". $IP. "\n方式: ". $way. "\n內容: ". $spamcom. "\n -- 已备案 --";
    }
  }
  function sink( $comment ) {
    if ( !empty($_POST['spam_confirmed']) ) {
      if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
      //方法一: 直接挡掉, 將 die(); 前面两斜线刪除即可.
      die();
      //方法二: 标记为 spam, 留在资料库检查是否误判.
      //add_filter('pre_comment_approved', create_function('', 'return "spam";'));
      //$comment['comment_content'] = "[ 防火墙提示：此条评论疑似Spam! ]\n". $_POST['spam_confirmed'];
    }
    return $comment;
	  }
	}
	$anti_spam = new anti_spam();
//屏蔽纯英文留言
function scp_comment_post( $incoming_comment ) {
$pattern = '/[一-龥]/u';
if(!preg_match($pattern, $incoming_comment['comment_content'])) {
		exit('<head><meta charset="UTF-8" /></head><p><br><span style="color:#C00;">提交失败：</span>抱歉，程序检测到您可能为Spam，本次提交失败！<br><span style="color:#2AE">解决方案：</span>请输入中文（Chinese）再次尝试！</p><br>');
//die();//直接挡掉，无提示
}
return( $incoming_comment );
}
add_filter('preprocess_comment', 'scp_comment_post');
//修改评论表情默认路径
function theme_smilies_src ($img_src, $img, $siteurl){
return get_bloginfo('template_directory').'/assets/images/smilies/'.$img;
}
add_filter('smilies_src','theme_smilies_src',1,10); 
//阻止站内文章互相Pingback 
function theme_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);   
}
add_action('pre_ping','theme_noself_ping');

//附件重命名
function new_filename($filename) {
$info = pathinfo($filename);
$ext = empty($info['extension']) ? '' : '.' . $info['extension'];
$name = basename($filename, $ext);
return substr(md5($name), 0, 15) . $ext;
}

add_filter('sanitize_file_name', 'new_filename', 10);

//breadcrumb面包屑导航
function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		echo '首页';
		echo "</a> &gt; ";
		if (is_category() || is_single()) {
			the_category(' & ');
			if (is_single()) {
				echo " &gt; ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
}
//版权时间
function copyrightDate() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
		SELECT 
			YEAR(min(post_date_gmt)) AS firstdate, 
			YEAR(max(post_date_gmt)) AS lastdate 
		FROM 
			$wpdb->posts
		WHERE post_status = 'publish'
	");
	if($copyright_dates) {
		$date = date('Y-m-d');
		$date = explode('-', $date);
		$copyright = "Copyright &copy; " . $copyright_dates[0]->firstdate;
		if($copyright_dates[0]->firstdate != $date[0]) {
			$copyright .= '-' . $date[0];
		}
		echo $copyright;
	}
}
//去头部信息
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'index_rel_link' ); // Removes the index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Removes the prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Removes the start link
remove_action(  'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'feed_links', 2 );//文章和评论feed
remove_action( 'wp_head', 'feed_links_extra', 3 ); //分类等feed