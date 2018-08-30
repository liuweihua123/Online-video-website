<?php
/**
 * LoveVideo aactions
 * Hooks into various aactions in the theme.
 *
 *
 * @version 1.0
 * @author 东少
 * @package LoveVideo
 * @copyright 2014 all rights reserved
 *
 */
/*
* Function for Author follow
*/

add_action('init', 'author_follow');
function author_follow(){
	if( isset($_POST['aaction']) ){
		if($_POST['aaction'] == 'author_follow'){
			$authorID = $_POST['author'];
			$userID = $_POST['user'];
			$follow = $_POST['follow'] && ($_POST['follow']==1);
			$unfollow = $_POST['unfollow'] && ($_POST['unfollow']==1);
			
			$author = get_userdata($authorID);
			$user = get_userdata($userID);
			
			$author_followers = $author->followers ? unserialize($author->followers) : array();
			$user_following = $user->following ? unserialize($user->following) : array();
			
			if($follow){
				if( !in_array($userID, $author_followers) ) array_push( $author_followers, $userID );
				if( !in_array($authorID, $user_following) ) array_push( $user_following, $authorID );
				mfthemes_follow_notify($userID,$authorID );
			}else if($unfollow){
				foreach($author_followers as $k=>$v){
					if($v == $userID){
					  unset($author_followers[$k]);
					  break;
					}
				}
				foreach($user_following as $k=>$v){
					if($v == $authorID){
					  unset($user_following[$k]);
					  break;
					}
				}
			}else{
				echo 'failure';
				die();		
			}
			
			update_user_meta($userID, 'following', serialize($user_following) );
			update_user_meta($authorID, 'followers', serialize($author_followers) );
		}else if($_POST['aaction'] == 'author_cover'){
			$userID = $_POST['user'];
			$user_cover = $_POST['cover'];
			update_user_meta($userID, 'cover', $user_cover );
		}else if($_POST['aaction'] == 'author_delete'){
			$id = $_POST['id'];
			wp_delete_post($id);
		}else{echo 'failure';die();}
		echo 'success';
		die();
	}else{return;}
}

$options = get_option('mfthemes_options');

// Add meta box
if( $options['mfthemes_link']) :
	add_action('admin_menu', 'mfthemes_link_box');
	add_action('save_post', 'save_mfthemes_link');
endif;
function mfthemes_link_box() {
	if(function_exists('add_meta_box')) {
		add_meta_box( 'Qe-meta-box', '链接地址', 'mfthemes_link', 'post', 'side', 'high' );
	}
}

function mfthemes_link() {
	global $post;

	$meta_val = get_post_meta($post->ID, 'mfthemes_link', true);

	
	$form =  '<div class="form-wrap"><div class="form-field">';
	
	$form .= "<textarea id='metavalue' name='mfthemes_link' rows='2' cols='25'>$meta_val</textarea>";
	
	$form .= '</div></div>';
	
	echo $form;
}

// Update mftheme_link 

function save_mfthemes_link($post_ID) {
	if(!current_user_can( 'edit_post', $post_ID)) return;
	if(isset($_POST['mfthemes_link'])) {
		delete_post_meta($post_ID, 'mfthemes_link');
		add_post_meta($post_ID, 'mfthemes_link', $_POST['mfthemes_link']);
	}

}

// Get mftheme_link value
function get_mfthemes_link($post_ID){
	$a = get_post_meta($post_ID, 'mfthemes_link', true);
	return $a ? $a : false;
}

?>