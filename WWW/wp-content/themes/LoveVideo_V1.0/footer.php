<div id="ft">  <div class="pps-brim">  	<div class="ft-inner">    <dl class="cooperation">     <dt class="dt">友情链接</dt>	      <dd class="dd"> 		 <?php wp_list_bookmarks('title_li=&categorize=0&limit=10'); ?>	  <a href="http://www.juhemulu.com" target="_blank">更多&gt;&gt;</a>	 </dd>    </dl>    <dl class="pps-news">     <dt class="dt">本站动态</dt>	  	 	     <?php $posts = get_posts( "category_name=news&numberposts=4" ); ?><?php if( $posts ) : ?><?php foreach( $posts as $post ) : setup_postdata( $post ); ?>						<dd class="dd"><a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a>	 </dd>	 						<?php endforeach; ?>						<?php endif; ?>	     </dl>	<dl class="pps-soft">		<dt class="dt">其他</dt>		<?php $posts = get_posts( "category_name=other&numberposts=4" ); ?><?php if( $posts ) : ?><?php foreach( $posts as $post ) : setup_postdata( $post ); ?>						<dd class="dd"><a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a>	 </dd>	 <?php endforeach; ?>						<?php endif; ?>	</dl>				<?php	$options = get_option('mfthemes_options');	if( $options['tsina']);?>	<dl class="pps-follow">		<dt class="dt">关注我们</dt>		<dd class="dd"><a href="<?php echo $options['tsina'];?>" target="_blank">新浪微博</a></dd>	</dl>   </div>  </div>		<div class="pps-ft">    <p class="menu"><?php 	$menuParameters = array(	    'theme_location'=>'primary2',		'container'	=> false,		'echo'	=> false,		'items_wrap' => '%3$s',		'depth'	=> 0,	    );	   echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );                    ?></p>    <p class="cert">	<?php $options = get_option('mfthemes_options');			if( $options['footer']){?>				<?php echo $options['footer'];?> 版权 By <a href="tencent://message/?uin=2039153757&Site=im.qq.com&Menu=yes">Function</a>			<?php }else{?>				<p>&copy; <?php echo date("Y");?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> All Rights Reserved! </p>							<?php }?></p>    <span class="pps-slogan">欢迎光临!</span>  </div></div><script type="text/javascript">require(['list/main'], function(){});</script><?php $options = get_option('mfthemes_options');	if( $options['analysis']){?>	<div id="analysis" style="display:none"><?php echo $options['analysis'];?></div>	<?php }?>		<script type="text/javascript" src="https://js.users.51.la/19601381.js"></script></body></html>