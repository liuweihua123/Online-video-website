<?php

add_action('admin_menu', 'mfthemes_admin_menu');
function mfthemes_admin_menu() {
	add_menu_page(__( 'theme option', 'LoveVideo' ), __( 'theme option', 'LoveVideo' ), 'edit_themes', basename(__FILE__), 'mfthemes_settings_page');
	add_action( 'admin_init', 'mfthemes_settings' );
}

add_action('admin_init', 'mfthemes_page_init');
function mfthemes_page_init(){
	if (isset($_GET['page']) && $_GET['page'] == 'mfthemes-admin.php') {
		//error_reporting(0);
		ob_start();
		ob_end_clean();
		$dir = get_bloginfo('template_directory');
		$ajax_url = home_url("/").'?ajax_src=';
		wp_enqueue_style('admincss', $dir . '/assets/styles/admin.css', false, '1.0.0', false);
		echo "<script type='text/javascript'>var ajax_url = \"$ajax_url\"; </script>";
		wp_enqueue_script('adminjs', $dir . '/assets/scripts/admin.js', false, '1.0.0', false);
	}
}

function mfthemes_settings() {
	register_setting( 'mfthemes-settings-group', 'mfthemes_options' );
}

function mfthemes_settings_page() {
	if ( isset($_REQUEST['settings-updated']) ) echo '<div id="message" class="updated fade"><p><strong>保存成功！</strong></p></div>';
	if( 'reset' == isset($_REQUEST['reset']) ) {
		delete_option('mfthemes_options');
		echo '<div id="message" class="updated fade"><p><strong>重置成功！</strong></p></div>';
	}
?>
<html xmlns:wb="http://open.weibo.com/wb">
	<div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div><h2><?php _e( 'theme option', 'LoveVideo' );?></h2><br>
		<form method="post" action="options.php">
			<?php settings_fields( 'mfthemes-settings-group' ); ?>
			<?php $options = get_option('mfthemes_options'); ?>
			<div id="set-nav">
				<ul>
					<li><a  class="current" href="#"><?php _e( 'Basic Settings', 'LoveVideo' );?></a></li>
					<li><a href="#"><?php _e( 'Appearances Settings', 'LoveVideo' );?></a></li>
					<li><a href="#"><?php _e( 'Filmstrip Settings', 'LoveVideo' );?></a></li>
					<li><a href="#"><?php _e( 'Advertisement Settings', 'LoveVideo' );?></a></li>
					<li><a href="#"><?php _e( 'Function Settings', 'LoveVideo' );?></a></li>
					<li><a href="#"><?php _e( 'Sns Settings', 'LoveVideo' );?></a></li>
					<li><a href="#"><?php _e( '主题说明' );?></a></li>
				</ul>
			</div>
			<div id="set-cont" class="clx">
				<ul>
					<li class="current">
						<div class="item item-1 clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[description]">网站描述</label></div>
							<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[description]"><?php echo $options['description']; ?></textarea></div>
							<div class="span span3"><small class="set-small">用简洁凝练的话对你的网站进行描述</small></div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[keywords]">网站关键词</label></div>
							<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[keywords]"><?php echo $options['keywords']; ?></textarea></div>
							<div class="span span3"><small class="set-small">多个关键词请用英文逗号隔开</small></div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[analysis]">网站统计</label></div>
							<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[analysis]"><?php echo $options['analysis']; ?></textarea></div>
							<div class="span span3"><small class="set-small">输入统计代码</small></div>
						</div>
					</li>
					<li>
						<div class="item item-1 clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[favicon]">自定义Favicon图标</label></div>
							<div class="span span2">
								<input type="text" class="set-favicon set-input" name="mfthemes_options[favicon]" value="<?php echo $options['favicon']; ?>" placeholder="Favicon图标地址" /><a href="#" class="button">上传Favicon图标</a>
							</div>
							<div class="span span3 span-preview"><img src="<?php echo $options['favicon']; ?>" alt="" /></div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[logo]">自定义Logo图片</label></div>
							<div class="span span2">
								<input type="text" class="set-logo set-input" name="mfthemes_options[logo]" value="<?php echo $options['logo']; ?>" placeholder="Logo图片地址" /><a href="#" class="button">上传Logo图片</a>
							</div>
							<div class="span span3 span-preview"><img src="<?php echo $options['logo']; ?>" alt="" /></div>
						</div>
					</li>
					<li>
						<?php $timthumb = get_bloginfo('template_url').'/timthumb.php';?>
						<div class="item item-1 clx">
							<div class="span span1"><label class="set-label">设置说明</label></div>
							<div class="span span2">
								<p><strong>提示1:</strong> 图片大小为固定的1440 * 390px</p>
								<p><strong>提示2:</strong> 图片地址必须上传, 如果没有, 即便填写了标题和链接也不会在前台显示</p>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片1</label></div>
							<div class="span span2">
								
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][0]" value="<?php echo $options['filmstrip']['title'][0]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][0]" value="<?php echo $options['filmstrip']['href'][0]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][0]" value="<?php echo $options['filmstrip']['src'][0]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][0] )) echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片2</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][1]" value="<?php echo $options['filmstrip']['title'][1]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][1]" value="<?php echo $options['filmstrip']['href'][1]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][1]" value="<?php echo $options['filmstrip']['src'][1]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][1] )) echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片3</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][2]" value="<?php echo $options['filmstrip']['title'][2]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][2]" value="<?php echo $options['filmstrip']['href'][2]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][2]" value="<?php echo $options['filmstrip']['src'][2]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][2] ))  echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片4</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][3]" value="<?php echo $options['filmstrip']['title'][3]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][3]" value="<?php echo $options['filmstrip']['href'][3]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][3]" value="<?php echo $options['filmstrip']['src'][3]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][3] ))  echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片5</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][4]" value="<?php echo $options['filmstrip']['title'][4]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][4]" value="<?php echo $options['filmstrip']['href'][4]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][4]" value="<?php echo $options['filmstrip']['src'][4]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][4] ))  echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片6</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][5]" value="<?php echo $options['filmstrip']['title'][5]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][5]" value="<?php echo $options['filmstrip']['href'][5]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][5]" value="<?php echo $options['filmstrip']['src'][5]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][5] ))  echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片7</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][6]" value="<?php echo $options['filmstrip']['title'][6]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][6]" value="<?php echo $options['filmstrip']['href'][6]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][6]" value="<?php echo $options['filmstrip']['src'][6]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][6] ))  echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片8</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][7]" value="<?php echo $options['filmstrip']['title'][7]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][7]" value="<?php echo $options['filmstrip']['href'][7]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][7]" value="<?php echo $options['filmstrip']['src'][7]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][7] ))  echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片9</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][8]" value="<?php echo $options['filmstrip']['title'][8]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][8]" value="<?php echo $options['filmstrip']['href'][8]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][8]" value="<?php echo $options['filmstrip']['src'][8]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][8] ))  echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">幻灯片10</label></div>
							<div class="span span2">
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][title][9]" value="<?php echo $options['filmstrip']['title'][9]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][href][9]" value="<?php echo $options['filmstrip']['href'][9]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip][src][9]" value="<?php echo $options['filmstrip']['src'][9]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip']['src'][9] ))  echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
					</li>
					<li>
						<div class="item item-1 clx">
							<div class="span span1"><label class="set-label">广告设置</label></div>
							<div class="span span2"><p><strong>提示:</strong>删除了首页广告设置, 首页广告可以在幻灯片处设置</p></div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[admain]">菜单栏图片广告</br>(267x48)</label></div>
							<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[admain]"><?php echo $options['admain']; ?></textarea></div>
							<div class="span span3"><small class="set-small">输入广告代码，不填写则不显示</small></div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[adpaihang]">首页排行榜幻灯广告</br>(250x100)</label></div>
							<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[adpaihang]"><?php echo $options['adpaihang']; ?></textarea></div>
							<div class="span span3"><small class="set-small">输入广告代码，不填写则不显示</small></div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">精彩专题1</label></div>
							<div class="span span2">
								
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][title][0]" value="<?php echo $options['filmstrip_zhuanti']['title'][0]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][href][0]" value="<?php echo $options['filmstrip_zhuanti']['href'][0]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][src][0]" value="<?php echo $options['filmstrip_zhuanti']['src'][0]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip_zhuanti']['src'][0] )) echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">精彩专题2</label></div>
							<div class="span span2">
								
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][title][1]" value="<?php echo $options['filmstrip_zhuanti']['title'][1]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][href][1]" value="<?php echo $options['filmstrip_zhuanti']['href'][1]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][src][1]" value="<?php echo $options['filmstrip_zhuanti']['src'][1]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip_zhuanti']['src'][1] )) echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label">精彩专题3</label></div>
							<div class="span span2">
								
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][title][2]" value="<?php echo $options['filmstrip_zhuanti']['title'][2]; ?>" placeholder="图片标题" /> 标题
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][href][2]" value="<?php echo $options['filmstrip_zhuanti']['href'][2]; ?>" placeholder="链接地址" /> 链接
								<input type="text" class="set-thumb set-input" name="mfthemes_options[filmstrip_zhuanti][src][2]" value="<?php echo $options['filmstrip_zhuanti']['src'][2]; ?>" placeholder="图片地址" /><a href="#" class="button">上传图片</a>
							</div>
							<div class="span span3">
								<?php if(($src0 = $options['filmstrip_zhuanti']['src'][2] )) echo '<img src="'.mfthemes_thumb($src0, 200, 87, 1).'" alt="" />';?>
							</div>
						</div>
						
						<div class="item clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[adplayer_menu]">播放页菜单广告</br>(320x60)</label></div>
							<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[adplayer_menu]"><?php echo $options['adplayer_menu']; ?></textarea></div>
							<div class="span span3"><small class="set-small">输入广告代码，不填写则不显示</small></div>
						</div>
						<div class="item clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[adplayer]">播放页播放器下方广告</br>（768x90）</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[adplayer]"><?php echo $options['adplayer']; ?></textarea></div>
								<div class="span span3"><small class="set-small">输入广告代码，不填写则不显示</small></div>
						</div>
						<div class="item clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[adcontent]">评论框上方广告</br>（640x90）</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[adcontent]"><?php echo $options['adcontent']; ?></textarea></div>
								<div class="span span3"><small class="set-small">输入广告代码，不填写则不显示</small></div>
						</div>
					</li>
					<li>
						<div class="item item-1 clx">
							<div class="span span1"><label class="set-label">jQuery库选择</label></div>
							<div class="span span2">
								<p class="set-p"><input type="radio" id="jQuery" name="mfthemes_options[jQuery]" value="1" <?php if($options['jQuery']==1) echo 'checked="checked"'; ?>/><label for="jQuery">调用Jquery官方库</label></p>
								<p class="set-p"><input type="radio" id="msdn" name="mfthemes_options[jQuery]" value="2" <?php if($options['jQuery']==2) echo 'checked="checked"'; ?>/><label for="msdn">调用微软msdn-jQuery库</label></p>
								<p class="set-p"><input type="radio" id="sina" name="mfthemes_options[jQuery]" value="3" <?php if($options['jQuery']==3) echo 'checked="checked"'; ?>/><label for="sina">调用新浪在线jQuery库</label></p>
								<p class="set-p"><input type="radio" id="self" name="mfthemes_options[jQuery]" value="0" <?php if($options['jQuery']==0 || $options['jQuery']=="") echo 'checked="checked"'; ?>/><label for="self">调用主题自带</label></p>
							</div>
							<div class="span span3 span3-jquery"><small class="set-small"><p class="set-p">1.jQuery官方提供;</p><p class="set-p">2.Microsoft CDN提供;</p><p class="set-p">3.新浪SAE提供;</p><p class="set-p">4.默认选择主题自带</p></small></div>
						</div>
						<div class="item clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[postid]">缩略图重命名</label></div>
							<div class="span span2 span2-notes"><input id="postid" type="checkbox" name="mfthemes_options[postid]" value="1" <?php if($options['postid']) echo 'checked="checked"'; ?>/><label for="postid">开启 缩略图重命名 功能</label></div>
							<div class="span span3"><small class="set-small">选中后 图片前会有文章id来防止重复</small></div>
						</div>						
						<div class="item clx">
							<div class="span span1"><label class="set-label" for="mfthemes_options[footer]">底部版权</label></div>
							<div class="span span2"><textarea type="textarea" class="set-textaera" name="mfthemes_options[footer]"><?php echo $options['footer']; ?></textarea>
							<p><strong>底部预览:</strong><br/><?php $options = get_option('mfthemes_options');
							if( $options['footer']){?>
								<?php echo $options['footer'];?>
							<?php }else{?>
								<p>&copy; <?php echo date("Y");?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> All Rights Reserved！</p>
								<p>Powered By WordPress, Theme By <a href="http://www.dz9.net/" title="多姿">多姿</a></p>
							<?php }?></p>
							</div>
							<div class="span span3"><small class="set-small">底部版权不填写,则不修改</small></div>
						</div>						
					</li>
					<li>
						<div class="item item-1 ">
						    <div class="set-sns clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[index_tsina]">新浪微博关注按钮</label></div>
								<div class="span span2"><input type="text" class="set-input" name="mfthemes_options[index_tsina]" value="<?php echo $options['index_tsina']; ?>" /></div>
								<div class="span span3"><small class="set-small">直接输入微博uid，最多支持3个，英文逗号隔开（仅在首页显示）</small></div>
							</div><div class="set-gap"></div>
							<div class="set-sns clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[rss]">RSS</label></div>
								<div class="span span2"><input type="text" class="set-input" name="mfthemes_options[rss]" value="<?php echo $options['rss']; ?>" /></div>
								<div class="span span3"><small class="set-small">RSS地址，不填写则使用Wordpress自带的rss地址</small></div>
							</div><div class="set-gap"></div>
							<div class="set-sns clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[tsina]">新浪微博</label></div>
								<div class="span span2"><input type="text" class="set-input" name="mfthemes_options[tsina]" value="<?php echo $options['tsina']; ?>" /></div>
								<div class="span span3"><small class="set-small">新浪微博个人页面</small></div>
							</div><div class="set-gap"></div>
							<div class="set-sns clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[tqq]">腾讯微博</label></div>
								<div class="span span2"><input type="text" class="set-input" name="mfthemes_options[tqq]" value="<?php echo $options['tqq']; ?>" /></div>
								<div class="span span3"><small class="set-small">腾讯微博个人页面</small></div>
							</div><div class="set-gap"></div>
							<div class="set-sns clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[renren]">人人网</label></div>
								<div class="span span2"><input type="text" class="set-input" name="mfthemes_options[renren]" value="<?php echo $options['renren']; ?>" /></div>
								<div class="span span3"><small class="set-small">人人网个人页面</small></div>
							</div><div class="set-gap"></div>
							<div class="set-sns clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[douban]">豆瓣网</label></div>
								<div class="span span2"><input type="text" class="set-input" name="mfthemes_options[douban]" value="<?php echo $options['douban']; ?>" /></div>
								<div class="span span3"><small class="set-small">豆瓣网个人页面</small></div>
							</div><div class="set-gap"></div>
							<div class="set-sns clx">
								<div class="span span1"><label class="set-label" for="mfthemes_options[kaixin]">开心网</label></div>
								<div class="span span2"><input type="text" class="set-input" name="mfthemes_options[kaixin]" value="<?php echo $options['kaixin']; ?>" /></div>
								<div class="span span3"><small class="set-small">开心网个人页面</small></div>
							</div>
						</div>						
					</li>
					<li>
					<div class="mfthemes_option_wrap">
						<div class="mfthemes_option_section">
							<h2><?php _e('主题说明','mfthemes') ?></h2>
						</div>
						<div class="mfthemes_helppage">
							<p>当前主题：<?php $theme_data = get_theme_data(ABSPATH . 'wp-content/themes/LoveVideo/style.css');echo $theme_data['Title']; ?></p>
							<p>主题版本：<?php echo $theme_data['Version']; ?></p>
							<p>主题作者：<a href="http://www.dz9.net/" target="_blank" title="东少" rel="external">东少</a></p>
							<p style="line-height:24px">此主题为免费主题，但是请你在使用的时候保留我们的版权信息。主题版权归作者东少所有，禁止任何未经授权的版权篡改。主题使用中有疑问可在群里(QQ群：139730095)发言或者联系QQ：932340056。<br/>
							如果你觉得此主题不错，请点击支付宝按钮捐助我：<a href="http://me.alipay.com/mtu2" target="_blank" title="捐助多姿"><img src="<?php bloginfo('template_directory') ?>/assets/images/alipay.png"></a>
							</p>
							<table>
							<tr>
							<td><p>关注我们：</p></td>
                            <td><wb:follow-button uid="3062076247" type="red_1" width="67" height="24" ></wb:follow-button></td>
							<td><iframe src="http://follow.v.t.qq.com/index.php?c=follow&a=quick&appkey=801486687&sign=7d1b37e2&v=2&name=mct-ds&style=5&t=1394698697897&f=1" frameborder="0" scrolling="auto" width="178" height="24" marginwidth="0" marginheight="0" allowtransparency="true"></iframe></td>
                            </tr>
                            </table>
						</div>
						<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
					</div>
					</li>
				</ul>
			</div>
			<div class="mfthemes_submit_form">
				<input type="submit" class="button-primary mfthemes_submit_form_btn" name="save" value="<?php _e('Save Changes') ?>"/>
			</div>
		</form>
	<form method="post">
		<div class="mfthemes_reset_form">
			<input type="submit" name="reset" value="<?php _e( 'Reset', 'LoveVideo' );?>" class="button-secondary mfthemes_reset_form_btn"/> 重置有风险，操作需谨慎！
			<input type="hidden" name="reset" value="reset" />
		</div>
	</form>
	</div>
	<?php wp_enqueue_media();?>
<?php } ?>