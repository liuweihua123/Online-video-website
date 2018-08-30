<?php          
$options = array();      
$boxinfo = array('title' => '扩展选项', 'id'=>'ashubox', 'page'=>array('page','post'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'');         

$options[] = array(      
            "name" => "视频海报（也可直接输入图片链接）",      
            "desc" => "",      
            "id" => "video_poster", 
            "size"=>"34",			
            "std" => "",      
            "button_label"=>'上传图片',      
            "type" => "media"     
            ); 

$options[] = array(      
            "name" => "导演",      
            "desc" => "",      
            "id" => "video_dir", 
            "size"=>"40",			
            "std" => "",            
            "type" => "text"     
            );

$options[] = array(      
            "name" => "主演（多个请用逗号隔开）",      
            "desc" => "",      
            "id" => "video_star", 
            "size"=>"40",			
            "std" => "",            
            "type" => "text"     
            );

$options[] = array(      
            "name" => "类型（如：言情,动作,科幻等）",      
            "desc" => "",      
            "id" => "video_type", 
            "size"=>"40",			
            "std" => "",            
            "type" => "text"     
            );
			
$options[] = array(      
            "name" => "地区（电影发行地区）",      
            "desc" => "",      
            "id" => "video_area", 
            "size"=>"40",			
            "std" => "",            
            "type" => "text"     
            );
				
$options[] = array(      
            "name" => "发行时间（年份）",      
            "desc" => "",      
            "id" => "video_issue", 
            "size"=>"40",			
            "std" => "",            
            "type" => "text"     
            );
			
$options[] = array(      
            "name" => "视频链接（支持FLV/F4V/MP4,支持“优酷,土豆,56,酷6”播放页地址）",      
            "desc" => "",      
            "id" => "video_url", 
            "size"=>"40",			
            "std" => "",            
            "type" => "text"     
            );
			
$options[] = array(      
            "name" => "视频时长（如：90:35）",      
            "desc" => "",      
            "id" => "video_time",      
            "size"=>"40",      
            "std" => "",      
            "type" => "text"     
            ); 
			
$options[] = array(      
            "name" => "视频描述（一句话点评）",      
            "desc" => "",      
            "id" => "video_desc",      
            "size"=>"40",      
            "std" => "",      
            "type" => "text"     
            );   

$options[] = array(      
            "name" => "上映具体时间（预告里面用到）",      
            "desc" => "",      
            "id" => "video_date",      
            "size"=>"40",      
            "std" => "",      
            "type" => "text"     
            ); 
			
$options[] = array(      
            "name" => "视频清晰度/海报标签（默认流畅）",      
            "desc" => "",      
            "id" => "video_quality",      
            "std" => "",      
            "buttons" => array('流畅','蓝光','超清','臻高清','高清','普通','独播'),   
            "type" => "radio"     
            );                                                                                                    

$options[] = array(      
            "name" => "视频简介",      
            "desc" => "",      
            "id" => "video_about",      
            "size"=>"40",      
            "std" => "",      
            "type" => "textarea"     
            );     	
$new_box = new meta_box($options, $boxinfo);      
?>