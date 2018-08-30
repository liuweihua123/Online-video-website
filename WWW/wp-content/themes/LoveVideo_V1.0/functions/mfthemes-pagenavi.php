<?php
/**
 * LoveVideo Actions
 * Hooks into actions in the theme.
 *
 *
 * @version 1.0
 * @author ¶«ÉÙ
 * @package LoveVideo
 * @copyright 2014 all rights reserved
 *
 */


/*
* Post pagenavi function
*/
function pagenavi($s = null) {
	if ( is_singular() ) return;
	global $wp_query,$paged;
	$p = 2;
	
	$max_page = $wp_query->max_num_pages;

	if ( empty( $paged ) ) $paged = 1;
	if ( $paged > 1 ) p_link( $paged - 1, __('prev page','LoveVideo'), __('prev page','LoveVideo') );
	if ( $paged > $p + 1 ) p_link( 1, __('prevest page','LoveVideo') );
	if ( $paged > $p + 2 ) echo '<a class="nb pn">...</a>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<a class='on pn' data-pre='4'>{$i}</a> " : p_link( $i );
	}
	if ( $paged < $max_page - $p - 1 ) echo '<a class="nb pn">...</a>';
	if ( $paged < $max_page - $p ) p_link( $max_page, __('lastest page','LoveVideo') );
	if ( $paged < $max_page ) p_link( $paged + 1,__('next page','LoveVideo'), __('next page','LoveVideo') );
}
function p_link( $i, $title = '', $linktype = '' ) {
	if ( $title == '' ) $title = __('is', 'LoveVideo').$i.__('page','LoveVideo');
	if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
	echo "<a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
}

/*
* Post pagenavi for author
*/
function author_pagenavi($authorID = "", $paged = 1, $format, $prePage = 10, $p=2) {
	if ( !is_author() ) return;
	$format_array = array();
	$args = array(
		'author' => $authorID,
		'post_type' =>'post',
		'numberposts' => -1
	);
	if( $format ){
		$format_array = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => 'post-format-'.$format
				)
			)
		);
		if( $format == 'standard') {
			$format_array = array(
				'tax_query' => array(
					array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array('post-format-aside', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
											'operator' => 'NOT IN'
					)
				)
			);
		}
	}
	$pos = get_posts( array_merge( $args, $format_array) );
	$cnt = count($pos);
	
	$max_page= ($cnt%$prePage==0 )? ($cnt/$prePage):(floor($cnt/$prePage)+1);
	
	if ( $paged > 1 ) ap_link( $paged - 1, __('prev page','LoveVideo'), __('prev page','LoveVideo') , $format, $authorID);
	if ( $paged > $p + 1 ) ap_link( 1, __('prevest page','LoveVideo') , "", $format, $authorID);
	if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current' data-pre='4'>{$i}</span> " : ap_link( $i ,"", "", $format, $authorID);
	}
	if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers more">...</span>';
	if ( $paged < $max_page - $p ) ap_link( $max_page, __('lastest page','LoveVideo') , "", $format, $authorID);
	if ( $paged < $max_page ) ap_link( $paged + 1,__('next page','LoveVideo'), __('next page','LoveVideo') , $format, $authorID);
}
function ap_link( $i, $title = '', $linktype = '', $format, $authorID){
	$ap_link = get_author_posts_url($authorID);
	$ap_link .= strpos($ap_link, "?author")!== false ? "&f=$format&pag=$i" : "?f=$format&pag=$i";
	if ( $title == '' ) $title = __('is', 'LoveVideo').$i.__('page','LoveVideo');
	if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
	echo "<a class='page-numbers' href='{$ap_link}' title='{$title}'>{$linktext}</a> ";
}



/*
* Post pagenavi for video and image
*/
function vi_pagenavi($f = null, $p=2) {
	global $wp_query,$paged;
	$p = 2;
	
	$prePage = get_option('posts_per_page');
	$args = array(
		'post_type' =>'post',
		'numberposts' => -1
	);

		$format_array = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => 'post-format-'. $f
				)
			)
		);
	
	$pos = get_posts( array_merge( $args, $format_array) );
	$cnt = count($pos);
	
	$max_page = ($cnt%$prePage==0 )? ($cnt/$prePage):(floor($cnt/$prePage)+1);

	
	if ( $paged > 1 ) vi_link( $paged - 1, __('prev page','LoveVideo'), __('prev page','LoveVideo'), $f );
	if ( $paged > $p + 1 ) vi_link( 1, __('prevest page','LoveVideo') , "", $f);
	if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current' data-pre='4'>{$i}</span> " : vi_link( $i ,"", "", $f);
	}
	if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers more">...</span>';
	if ( $paged < $max_page - $p ) vi_link( $max_page, __('lastest page','LoveVideo') , "", $f);
	if ( $paged < $max_page ) vi_link( $paged + 1,__('next page','LoveVideo'), __('next page','LoveVideo') , $f);
}
function vi_link( $i, $title = '', $linktype = '', $f){
	$vi_link = get_page_link_by_title($f);
	$vi_link .= strpos($vi_link, "?page_id=")!== false ? "&paged=$i" : "?paged=$i";
	if ( $title == '' ) $title = __('is', 'LoveVideo').$i.__('page','LoveVideo');
	if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
	echo "<a class='page-numbers' href='{$vi_link}' title='{$title}'>{$linktext}</a> ";
}

/*
* Post pagenavi for video and image
*/
function likes_pagenavi($authorID = "", $paged = 1, $cnt, $prePage = 10, $p=2) {
	if ( !is_author() ) return;
	
	$max_page= ($cnt%$prePage==0 )? ($cnt/$prePage):(floor($cnt/$prePage)+1);
	
	if ( $paged > 1 ) lk_link( $paged - 1, __('prev page','LoveVideo'), __('prev page','LoveVideo') , $authorID);
	if ( $paged > $p + 1 ) lk_link( 1, __('prevest page','LoveVideo') , "", $authorID);
	if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current' data-pre='4'>{$i}</span> " : lk_link( $i ,"", "", $authorID);
	}
	if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers more">...</span>';
	if ( $paged < $max_page - $p ) lk_link( $max_page, __('lastest page','LoveVideo') , "", $authorID);
	if ( $paged < $max_page ) lk_link( $paged + 1,__('next page','LoveVideo'), __('next page','LoveVideo') , $authorID);
}
function lk_link( $i, $title = '', $linktype = '', $authorID){
	$lk_link = get_author_posts_url($authorID);
	$lk_link .= strpos($lk_link, "?author")!== false ? "&ta=likes&pag=$i" : "?ta=likes&pag=$i";
	if ( $title == '' ) $title = __('is', 'LoveVideo').$i.__('page','LoveVideo');
	if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
	echo "<a class='page-numbers' href='{$lk_link}' title='{$title}'>{$linktext}</a> ";
}
?>