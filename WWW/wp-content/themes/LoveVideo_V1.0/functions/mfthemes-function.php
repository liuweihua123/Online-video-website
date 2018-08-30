<?php
/**
 * Theme functions file
 *
 *
 * @package LoveVideo
 * @author 东少
 */

define( "THEME_NAME", "LoveVideo" );
load_theme_textdomain( THEME_NAME, TEMPLATEPATH."/languages" );
add_action( "widgets_init", "mfthemes_widgets" );
get_template_part( "functions/mfthemes-plugin" );
get_template_part( "functions/mfthemes-mail" );
get_template_part( "functions/mfthemes-author" );
get_template_part( "functions/mfthemes-meta" );
get_template_part( "functions/mfthemes-header" );
get_template_part( "functions/mfthemes-widget" );
get_template_part( "functions/mfthemes-pagenavi" );
if ( !is_admin( ) )
{
		get_template_part( "functions/mfthemes-login" );
		get_template_part( "functions/forms/login/login-form" );
		get_template_part( "functions/forms/login/login-process" );
		get_template_part( "functions/forms/register/register-form" );
		get_template_part( "functions/forms/register/register-process" );
		get_template_part( "functions/forms/forgot-password/forgot-password-form" );
}
else
{
		get_template_part( "functions/mfthemes-admin" );
}
add_custom_background( );
add_theme_support( "automatic-feed-links" );
if ( function_exists( "register_nav_menus" ) )
{
		register_nav_menus( array( "primary" => "首页/列表页菜单" ) );
		register_nav_menus( array( "primary2" => "页脚菜单" ) );
		register_nav_menus( array( "primary3" => "播放页菜单" ) );
		register_nav_menus( array( "primary4" => "新闻页菜单" ) );
}
add_action( "wp_enqueue_scripts", "mfthemes_stylesheet" );
add_action( "wp_head", "mfthemes_styleplus" );
add_action( "wp_enqueue_scripts", "mfthemes_script" );
add_filter( "the_content", "video_thumbnail_filter" );
add_filter( "wp_nav_menu_objects", lovephoto_menu );
add_filter( "the_content", "embed_opaque" );
add_action( "init", "mfthemes_admin_redirect" );
if ( !function_exists( "mb_strimwidth" ) )
{
		function mb_strimwidth( $str, $start, $width, $trimmarker )
		{
				$output = preg_replace( "/^(?:[\\x00-\\x7F]|[\\xC0-\\xFF][\\x80-\\xBF]+){0,".$start."}((?:[\\x00-\\x7F]|[\\xC0-\\xFF][\\x80-\\xBF]+){0,".$width."}).*/s", "\\1", $str );
				return $output.$trimmarker;
		}
}
add_filter( "user_contactmethods", "hide_profile_fields", 10, 1 );
add_filter( "user_contactmethods", "mfthemes_profile_fields", 10, 1 );
add_action( "save_post", "clear_zal_cache" );
add_filter( "show_admin_bar", "__return_false" );
add_filter( "media_view_strings", "cor_media_view_strings" );
if ( current_user_can( "contributor" ) && !current_user_can( "upload_files" ) )
{
		add_action( "admin_init", "allow_contributor_uploads" );
}
add_filter( "media_upload_tabs", "remove_medialibrary_tab" );
if ( !is_admin( ) )
{
		add_filter( "get_avatar", "add_title_to_avatar", 10, 2 );
}

function mfthemes_widgets( )
{
		register_sidebar( array(
				"name" => "sidebar1",
				"description" => __( "sidebar1", "LoveVideo" ),
				"before_widget" => "<div id=\"%1\$s\" class=\"widgets %2\$s\">",
				"after_widget" => "</div>",
				"before_title" => "<h3>",
				"after_title" => "</h3>"
		) );
		register_sidebar( array(
				"name" => "sidebar1fixed",
				"description" => __( "sidebar1fixed", "LoveVideo" ),
				"before_widget" => "<div id=\"%1\$s\" class=\"widgets %2\$s\">",
				"after_widget" => "</div>",
				"before_title" => "<h3>",
				"after_title" => "</h3>"
		) );
		register_sidebar( array(
				"name" => "sidebar2",
				"description" => __( "sidebar2", "LoveVideo" ),
				"before_widget" => "<div id=\"%1\$s\" class=\"widgets %2\$s\">",
				"after_widget" => "</div>",
				"before_title" => "<h3>",
				"after_title" => "</h3>"
		) );
		register_sidebar( array(
				"name" => "sidebar2fixed",
				"description" => __( "sidebar2fixed", "LoveVideo" ),
				"before_widget" => "<div id=\"%1\$s\" class=\"widgets %2\$s\">",
				"after_widget" => "</div>",
				"before_title" => "<h3>",
				"after_title" => "</h3>"
		) );
}

function mfthemes_stylesheet( )
{
		global $pagenow;
		$dir = get_template_directory_uri( )."/lib/load-styles.php";
		if ( is_author( ) )
		{
				wp_enqueue_style( "author", stripcslashes( $dir."?c=1&load=base,author,style" ), array( ), "2.0.0", "screen" );
		}
		else if ( is_home( ) || is_search( ) || is_archive( ) || is_page( "views" ) || is_page( "video" ) || is_page( "image" ) )
		{
				$options = get_option( "mfthemes_options" );
				$layout = $options['layout'] != "" ? $options['layout'] : 0;
				echo "<script type='text/javascript'>var layout=";
				echo $layout;
				echo ";</script>";
				wp_enqueue_style( "index", stripcslashes( $dir."?c=1&load=base,index,style" ), array( ), "2.0.0", "screen" );
		}
		else if ( $pagenow == "wp-login.php" )
		{
				wp_enqueue_style( "login", stripcslashes( $dir."?c=1&load=base,login,style" ), array( ), "2.0.0", "screen" );
		}
		else if ( is_page( "submit" ) || is_page( "editor" ) )
		{
				wp_enqueue_style( "submit", stripcslashes( $dir."?c=1&load=base,submit,style" ), array( ), "2.0.0", "screen" );
		}
		else if ( is_page( "profile" ) )
		{
				wp_enqueue_style( "profile", stripcslashes( $dir."?c=1&load=base,profile,style" ), array( ), "2.0.0", "screen" );
				wp_enqueue_style( "thickbox" );
		}
		else if ( is_page( "welcome" ) )
		{
				wp_enqueue_style( "welcome", stripcslashes( $dir."?c=1&load=base,welcome,style" ), array( ), "2.0.0", "screen" );
		}
}

function mfthemes_styleplus( )
{
		$options = get_option( "mfthemes_options" );
		$fixed = $options['fixed'];
		$imgMid = $options['imgmid'];
		$style = "";
		if ( $fixed )
		{
				$style .= "#header{position:fixed;top:0;left:0;width:100%;z-index:99;}#content-shadow{position:fixed;top:57px;left:0;width:100%;z-index:99}#content{padding-top:100px}#header.fixed,#content-shadow.fixed{z-index:0;}";
		}
		if ( $imgMid )
		{
				$style .= ".single .main-body img{display:block;/*margin:0 auto 10px auto;*/zoom:1}";
		}
		echo "<style type='text/css'>";
		echo $style;
		echo "</style>";
}

function mfthemes_script( )
{
		global $pagenow;
		$options = get_option( "mfthemes_options" );
		$jquery = 0 < $options['jQuery'] ? "" : "jquery,";
		$dir = get_template_directory_uri( )."/lib/load-scripts.php";
		$code = "http://code.jquery.com/jquery-1.8.3.min.js";
		$msdn = "http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js";
		$sina = "http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js";
		wp_dequeue_script( "jquery" );
		if ( $options['jQuery'] == 1 )
		{
				wp_enqueue_script( "jq", $code, array( ), "1.8.3", FALSE );
		}
		else if ( $options['jQuery'] == 2 )
		{
				wp_enqueue_script( "jq", $msdn, array( ), "1.8.3", FALSE );
		}
		else if ( $options['jQuery'] == 3 )
		{
				wp_enqueue_script( "jq", $sina, array( ), "1.8.3", FALSE );
		}
		if ( is_author( ) )
		{
				wp_enqueue_script( "author", stripcslashes( $dir."?c=1&load=".$jquery."base,author" ), array( ), "2.0.0", FALSE );
		}
		else if ( is_home( ) || is_search( ) || is_archive( ) || is_page( "views" ) || is_page( "video" ) || is_page( "image" ) )
		{
				wp_enqueue_script( "index", stripcslashes( $dir."?c=1&load=".$jquery."base,index" ), array( ), "2.0.0", FALSE );
		}
		else if ( $pagenow == "wp-login.php" )
		{
				wp_enqueue_script( "login", stripcslashes( $dir."?c=1&load=".$jquery."base,login" ), array( ), "2.0.0", FALSE );
		}
		else if ( is_page( "submit" ) || is_page( "editor" ) )
		{
				wp_enqueue_script( "admin-bar" );
				wp_enqueue_script( "submit", stripcslashes( $dir."?c=1&load=".$jquery."base,submit" ), array( ), "2.0.0", FALSE );
		}
		else if ( is_page( "profile" ) )
		{
				echo "<script type=\"text/javascript\">var timthumb_url = \"".get_bloginfo( "template_url" )."/timthumb.php?src=\",admin_url = \"".admin_url( )."\"</script>";
				wp_enqueue_script( "profile", stripcslashes( $dir."?c=1&load=".$jquery."base,profile" ), array( ), "2.0.0", FALSE );
				wp_enqueue_script( "media-upload" );
				wp_enqueue_script( "thickbox" );
		}
		else if ( is_page( "welcome" ) )
		{
				wp_enqueue_script( "welcome", stripcslashes( $dir."?c=1&load=".$jquery."base,welcome" ), array( ), "2.0.0", FALSE );
		}
		else if ( is_single( ) )
		{
				echo "<script type=\"text/javascript\">var ajax_url = \"".get_bloginfo( "template_url" )."\"</script>";
				$x = $options['phzoom'] ? "base,phzoom,singlephzoom,comments-ajax" : "base,single,comments-ajax";
				wp_enqueue_script( "single", stripcslashes( $dir."?c=1&load=".$jquery.$x ), array( ), "2.0.0", FALSE );
		}
		else
		{
				wp_enqueue_script( "single", stripcslashes( $dir."?c=1&load=".$jquery."base" ), array( ), "2.0.3", FALSE );
		}
}

function video_thumbnail_filter($c) {
global $is_phone;
if( is_single() ){
$s = array('/\<img.+?class="youku-pic".+?src=".+?".*?\/>/is'=>'');
foreach($s as $p =>$r){
$c = preg_replace($p,$r,$c);
}
if(!$is_phone){
$options = get_option('mfthemes_options');
if($options["phzoom"]) $c = preg_replace('/\<img.+?src="(.+?)".*?\/>/is','<a href="$1">$0</a>',$c);
$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$c,$matches ,PREG_SET_ORDER);
$cnt = count( $matches );
if($cnt>1){
for($i=1;$i<$cnt;$i++){
$img0 = $matches[$i][0];
$post_gray = get_bloginfo("template_url").'/assets/images/grey.jpg';
$replace = "src='$post_gray' data-original=";
$img = str_replace("src=",$replace,$img0);
$c = str_replace($img0,$img,$c);
}
}
}
}else if( is_feed() ){
global $post;
$link = get_permalink($post->ID);
$title = $post->post_title ?$post->post_title : get_bloginfo('name');
ob_start();
ob_end_clean();
$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$post->post_content,$matches ,PREG_SET_ORDER);
$cnt = count( $matches );
if($cnt>0){
$c = '<a title="'.$title.'" href="'.$link.'"><img src="'.$matches[0][1].'" alt="'.$title.'" /></a>'
.mb_strimwidth(strip_tags( $post->post_content ),0,200,"....");
}
}
return $c;
}
add_filter( 'the_content','video_thumbnail_filter');

function time_since( $older_date, $comment_date = FALSE, $return = FALSE )
{
		$chunks = array( 2592000, 86400, 3600, 60, 1 );
		$newer_date = time( );
		$since = abs( $newer_date - $older_date );
		if ( $since < 2592000 )
		{
				$i = 0;
				$j = count( $chunks );
				for ( ;	$i < $j;	++$i	)
				{
						$seconds = $chunks[$i];
						switch ( $i )
						{
						case 0 :
								$name = __( "Month", "LoveVideo" );
								break;
						case 1 :
								$name = __( "Day", "LoveVideo" );
								break;
						case 2 :
								$name = __( "Hour", "LoveVideo" );
								break;
						case 3 :
								$name = __( "Minute", "LoveVideo" );
								break;
						case 4 :
								$name = __( "Second", "LoveVideo" );
						}
						if ( !( ( $count = floor( $since / $seconds ) ) != 0 ) )
						{
								continue;
						}
						break;
				}
				$output = $count.$name.__( "ago", "LoveVideo" );
		}
		else
		{
				$output = $comment_date ? the_time( "Y-m-j G:i" ) : the_time( "Y/m/j" );
		}
		if ( $return )
		{
				return $output;
		}
		echo $output;
}

function lovephoto_comment( $comment, $args, $depth )
{
		$GLOBALS['GLOBALS']['comment'] = $comment;
		echo "   <li ";
		comment_class( );
		echo " id=\"li-comment-";
		comment_id( );
		echo "\">\r\n\t\t<div id=\"comment-";
		comment_id( );
		echo "\" class=\"comment-body clx\">\r\n\t\t\t<div class=\"comment-author\">";
		echo get_avatar( $comment->comment_author_email, $size = "50" );
		echo "</div>\r\n\t\t\t<div class=\"comment-content\">\r\n\t\t\t\t<div class=\"comment-meta\">\r\n\t\t\t\t\t<span class=\"comment-name\">";
		printf( __( "%s" ), get_comment_author_link( ) );
		echo "</span>\r\n\t\t\t\t\t<span class=\"comment-date\">&#160;&#8722;&#160;";
		time_since( abs( strtotime( $comment->comment_date_gmt."GMT" ) ), TRUE );
		echo "</span>\r\n\t\t\t\t\t<span class=\"comment-reply\">";
		comment_reply_link( array_merge( $args, array(
				"depth" => $depth,
				"max_depth" => $args['max_depth'],
				"reply_text" => __( "Reply", "LoveVideo" )
		) ) );
		echo "</span>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"comment-entry\">";
		comment_text( );
		echo " </div>\r\n\t\t\t</div>\r\n\t\t</div>\r\n";
}
add_filter('wp_nav_menu_objects',lovephoto_menu);
function lovephoto_menu($items) {
foreach ($items as $item) {
if (hasSub($item->ID,$items)) {
$item->classes[] = 'menu-parent-item';
}
}
return $items;
};
function hasSub($menu_item_id,$items) {
foreach ($items as $item) {
if ($item->menu_item_parent &&$item->menu_item_parent==$menu_item_id) {
return true;
}
}
return false;
};

function embed_opaque( $c )
{
		$s = array( "/<embed(.+?)src=\"(.+?)\"(.+?)\"/i" => "<embed\$1src=\"\$2\" wmode=\"opaque\" \$3" );
		foreach ( $s as $p => $r )
		{
				$c = preg_replace( $p, $r, $c );
		}
		return $c;
}

function get_page_link_by_title( $title = "" )
{
		if ( $title )
		{
				$page = get_page_by_title( $title );
				$page_id = $page->ID;
				return get_page_link( $page_id );
		}
		return FALSE;
}

function mfthemes_admin_redirect( )
{
		if ( is_admin( ) && !current_user_can( "manage_options" ) )
		{
				global $pagenow;
				$link = get_page_link_by_title( "accounts" );
				if ( $pagenow == "index.php" || $pagenow == "profile.php" || $pagenow == "edit.php" || $pagenow == "post-new.php" || $pagenow == "edit-comments.php" || $pagenow == "tools.php" )
				{
						wp_redirect( $link );
						exit( );
				}
		}
}

function hide_profile_fields( $contactmethods )
{
		unset( $contactmethods['aim'] );
		unset( $contactmethods['jabber'] );
		unset( $contactmethods['yim'] );
		return $contactmethods;
}

function mfthemes_profile_fields( $contactmethods )
{
		$contactmethods['cover'] = __( "cover", "LoveVideo" );
		$contactmethods['following'] = __( "following", "LoveVideo" );
		$contactmethods['followers'] = __( "followers", "LoveVideo" );
		$contactmethods['likes'] = __( "likes", "LoveVideo" );
		$contactmethods['mfavatar'] = __( "mfavatar", "LoveVideo" );
		return $contactmethods;
}

function mfthemes_archives_list( )
{
		if ( !( $output = get_option( "mfthemes_archives_list" ) ) )
		{
				$output = "<div id=\"archives\">";
				$the_query = new WP_Query( "posts_per_page=-1" );
				$year = 0;
				$mon = 0;
				$day = 0;
				while ( $the_query->have_posts( ) )
				{
						$the_query->the_post( );
						$year_tmp = get_the_time( "Y" );
						$mon_tmp = get_the_time( "m" );
						$day_tmp = get_the_time( "d" );
						$y = $year;
						$m = $mon;
						$d = $day;
						++$i;
						if ( $day != $day_tmp && 0 < $day )
						{
								$output .= "</ul>";
						}
						if ( $year != $year_tmp )
						{
								$year = $year_tmp;
						}
						if ( $mon != $mon_tmp )
						{
								$mon = $mon_tmp;
						}
						if ( $day != $day_tmp )
						{
								$day = $day_tmp;
								$output .= "<ul><span class='al_day'>".$year."-{$mon}-{$day}</span>";
						}
						$format = get_post_format( );
						$span = $format == "video" ? "<span class=\"play\"></span>" : "";
						$output .= "<li><a href=\"".get_permalink( )."\" title=\"".get_the_title( )."\">".post_sidebar_thumbnail( 70, FALSE, TRUE ).$span."</a></li>";
				}
				wp_reset_postdata( );
				$output .= "</div>";
				update_option( "mfthemes_archives_list", $output );
		}
		echo $output;
}

function clear_zal_cache( )
{
		update_option( "mfthemes_archives_list", "" );
}

function cor_media_view_strings( $strings )
{
		unset( $strings['insertFromUrlTitle'] );
		return $strings;
}

function allow_contributor_uploads( )
{
		$contributor = get_role( "contributor" );
		$contributor->add_cap( "upload_files" );
}

function remove_medialibrary_tab( $tabs )
{
		if ( !current_user_can( "update_core" ) )
		{
				unset( $tabs['library'] );
				return $tabs;
		}
}

function mfthemes_postid_avatar( )
{
		global $post;
		$post = get_post( $post->ID );
		$post_author_id = $post->post_author;
		$post_author = get_user_by( "id", $post_author_id );
		$accounts_link = get_author_posts_url( $post_author_id );
		$avatar = get_avatar( $post_author_id, 40 );
		echo "<div class='author-avatar'><a href='";
		echo $accounts_link;
		echo "' target='_blank'>";
		echo $avatar;
		echo "</a></div>";
}

function mfthemes_editor_link( )
{
		global $post;
		$postid = $post->ID;
		$format = get_post_format( $postid );
		$url = get_page_link_by_title( "editor" );
		$url .= -1 < strpos( $url, "?page_id" ) ? "&postid=".$postid."&new={$format}" : "?postid=".$postid."&new={$format}";
		echo "\t\t<div class=\"post-action\"><a href=\"#\" class=\"post-delete\" data-id=\"";
		echo $postid;
		echo "\">";
		_e( "Delete", "LoveVideo" );
		echo "</a><a href=\"";
		echo $url;
		echo "\">";
		_e( "Editor", "LoveVideo" );
		echo "</a></div>\r\n\t";
}

function mfthemes_userid_avatar( $post_author_id = NULL, $w = 30 )
{
		if ( $post_author_id )
		{
				$post_author = get_user_by( "id", $post_author_id );
				$accounts_link = get_author_posts_url( $post_author_id );
				$avatar = get_avatar( $post_author_id, $w );
				return "<a class='likes-avatar' href='".$accounts_link."' target='_blank'>{$avatar}<span></span></a>";
		}
		return FALSE;
}

function add_title_to_avatar($avatar,$id_or_email){
if(is_array($id_or_email) ||is_object($id_or_email) ){
return $avatar;
}else if(is_numeric($id_or_email)){
$user = get_userdata($id_or_email);
$user = get_user_by('email',$id_or_email);
}else{
return $avatar;
}
$src = $user ?( $user->mfavatar ?$user->mfavatar : false) : false;
if($user){
if($src){
$output = preg_match('/height=\'(.*?)\'/',$avatar,$matches);
$w = $matches[1];
$src = mfthemes_avatar_thumb($src,$w,$user->user_nicename);
$avatar = "<img src='$src' class='avatar avatar-$w' width='$w' height='$w' />";
}else{
$output = preg_match('/height=\'(.*?)\'/',$avatar,$matches);
$w = $matches[1];
$src = mfthemes_thumb(get_bloginfo('template_url')."/assets/images/default.jpg",$w,$w,1);
$avatar = "<img src='$src' class='avatar avatar-$w' width='$w' height='$w' />";
}
}
return $avatar;
}
if (!is_admin()) :
add_filter('get_avatar','add_title_to_avatar',10,2);
endif;

function jifen( $userId = NULL, $echo = TRUE )
{
		$jifen = 0;
		if ( $userId )
		{
				$posts_num = 0;
				$comts_num = 0;
				$likes_num = 0;
				$posts = get_posts( "post_type=post&posts_per_page=-1&author=".$userId );
				foreach ( $posts as $post )
				{
						$comts_num += $post->comment_count;
						$likes_num += count( unserialize( $post->mflikes_uid ) );
				}
				$jifen = $posts_num * 0.3 + $comts_num * 0.3 + $likes_num * 0.4;
		}
		echo $jifen;
}