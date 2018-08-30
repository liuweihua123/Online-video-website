//评论Ajax翻页
jQuery(document).ready(function($) {
$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');//pagination ajax
$('.commentlist .pagination a').live('click',function(e) {
    e.preventDefault();
    $.ajax({
      type: "GET",
      url: $(this).attr('href'),
      beforeSend: function() {
        $('.commentlist').remove();
        $('#loading-comments').slideDown();
      },
      dataType: "html",
      success: function(out) {
        result = $(out).find('.commentlist');
        $('#loading-comments').slideUp(550);
        $('#loading-comments').after(result.fadeIn(800));
        $('.commentlist');
        $(".reply").ajaxReply();
      }
    });
  });  
});
//@评论回复
jQuery(document).ready(function($){    
    $('.reply').click(function(){  
    var atname = $(this).parent().find('spans:first').text();
$("#comment").attr("value","@" + atname + "：").focus();
});
    $('.cancel-comment-reply a').click(function() { 
    $("#comment").attr("value",'');   
});   
}) 
jQuery.fn.ajaxReply = function(){$(this).click(
  function(){  
    var atname = $(this).parent().find('spans:first').text();
$("#comment").attr("value","@" + atname + "：").focus();
});
$('.cancel_comment_reply a').click(function() {
$("#comment").attr("value",'');
  });
};
$(".reply").ajaxReply();

//标题鼠标点击事件
jQuery(document).ready(function(){
jQuery('h2 a').click(function(){
    jQuery(this).text('文章信息装载中...');
    window.location = jQuery(this).attr('href');
    });
});

//新窗口打开
jQuery(document).ready(function(){
  jQuery("a[rel='external'],a[rel='external nofollow']").click(
  function(){window.open(this.href);return false})
});


