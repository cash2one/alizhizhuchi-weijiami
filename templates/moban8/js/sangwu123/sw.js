//getCookie方法,获取指定名称的cookie的值
function getCookie(objName){
    var arrStr = document.cookie.split("; ");
    for(var i = 0;i < arrStr.length;i ++){
     var temp = arrStr[i].split("=");
     if(temp[0] == objName){
        return unescape(temp[1]);
     }
    }
   }
 
//调用getCookie方法
var result=getCookie('background');
 
if(result==null || result == ""){
document.cookie="background=bg_lan;path=/"; 
document.cookie="fontFamily=fam_hei;path=/";
document.cookie="fontSize=fon_24;path=/";
}
UA = navigator.userAgent.toLowerCase();
url = window.location;
url = url.toString();
if((UA.indexOf('iphone') != -1 || UA.indexOf('mobile') != -1 || UA.indexOf('android') != -1 || UA.indexOf('ipad') != -1 || UA.indexOf('windows ce') != -1 || UA.indexOf('ipod') != -1) && UA.indexOf('ipod') == -1) 
{
if (url.match(/^http:\/\/www\.sangwu123\.com\/$/) || url.match(/^http:\/\/www\.sangwu123\.com$/)) { Go('http:\/\/m\.sangwu123\.com'); }
if (url.match(/\/Html\/\d+?\/\d+?\//)){id = url.match(/\/Html\/(\d+?)\/(\d+?)\//);Go('http://m.sangwu123.com/Html/'+id[1]+'/'+id[2]+'/1/');}
if (url.match(/\/Html\/\d+?\/\d+?\/\d+?\.html/)){id = url.match(/\/Html\/(\d+?)\/(\d+?)\/\d+?\.html/);Go('http://m.sangwu123.com/Html/'+id[1]+'/'+id[2]+'/'+id[3]+'.html');}
}
function Go(url) { window.location = url;}
( function() {
	var ua = navigator.userAgent.toLowerCase();
	var is = (ua.match(/\b(chrome|opera|safari|msie|firefox)\b/) || [ '',
			'mozilla' ])[1];
	var r = '(?:' + is + '|version)[\\/: ]([\\d.]+)';
	var v = (ua.match(new RegExp(r)) || [])[1];
	jQuery.browser.is = is;
	jQuery.browser.ver = v;
	jQuery.browser[is] = true;

})();

( function(jQuery) {

	/*
	 * 
	 * jQuery Plugin - Messager
	 * 
	 * Author: corrie Mail: corrie@sina.com Homepage: www.corrie.net.cn
	 * 
	 * Copyright (c) 2008 corrie.net.cn
	 * 
	 * @license http://www.gnu.org/licenses/gpl.html [GNU General Public
	 * License]
	 * 
	 * 
	 * 
	 * $Date: 2012-3-24
	 * 
	 * $Vesion: 1.5 @ how to use and example: Please Open index.html
	 * 
	 * $Fix: IE9 close
	 */

	this.version = '@1.5';
	this.layer = {
		'width' :200,
		'height' :100
	};
	this.title = '信息提示';
	this.time = 4000;
	this.anims = {
		'type' :'slide',
		'speed' :600
	};
	this.timer1 = null;
	this.inits = function(title, text) {

		if ($("#message").is("div")) {
			this.closer();
			//return;
		}
		$(document.body)
				.prepend(
						'<div id="message" style="width:'
								+ this.layer.width
								+ 'px;height:'
								+ this.layer.height
								+ 'px;position:absolute;display:none;background:#cfdef4;bottom:0;left:0; overflow:hidden;border:#b9c9ef 1px solid;z-index:100;"><div style="border:1px solid #fff;border-bottom:none;width:100%;height:25px;font-size:12px;overflow:hidden;color:#FF0000;"><span id="message_close" style="float:right;padding:5px 0 5px 0;width:16px;line-height:auto;color:red;font-size:12px;font-weight:bold;text-align:center;cursor:pointer;overflow:hidden;">×</span><div style="padding:5px 0 5px 5px;width:100px;line-height:18px;text-align:left;overflow:hidden;">'
								+ title
								+ '</div><div style="clear:both;"></div></div> <div style="padding-bottom:5px;border:1px solid #fff;border-top:none;width:100%;height:auto;font-size:12px;"><div id="message_content" style="margin:0 5px 0 5px;border:#b9c9ef 1px solid;padding:10px 0 10px 5px;font-size:12px;width:'
								+ (this.layer.width - 17)
								+ 'px;height:'
								+ (this.layer.height - 50)
								+ 'px;color:#FF0000;text-align:left;overflow:hidden;">'
								+ text + '</div></div></div>');

		$("#message_close").click( function() {
			setTimeout('this.closer()', 1);
		});
		$("#message").hover( function() {
			clearTimeout(timer1);
			timer1 = null;
		}, function() {
			if (time > 0)
				timer1 = setTimeout('this.closer()', time);
			});

		
		if(!($.browser.is == 'msie' && $.browser.ver == '6.0')) {
			$(window).scroll(
				function() {
					var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
					var bottomHeight =  "-"+scrollTop;
					$("#message").css("bottom", bottomHeight + "px");
				});
		}
	};
	this.show = function(title, text, time) {
		if ($("#message").is("div")) {
			//return;
		}
		if (title == 0 || !title)
			title = this.title;
		this.inits(title, text);
		if (time >= 0)
			this.time = time;
		switch (this.anims.type) {
		case 'slide':
			$("#message").slideDown(this.anims.speed);
			break;
		case 'fade':
			$("#message").fadeIn(this.anims.speed);
			break;
		case 'show':
			$("#message").show(this.anims.speed);
			break;
		default:
			$("#message").slideDown(this.anims.speed);
			break;
		}
		
		if(!($.browser.is == 'msie' && $.browser.ver == '6.0')) {
			scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
			var bottomHeight =  "-"+scrollTop;
			$("#message").css("bottom", bottomHeight + "px");
		}
		this.rmmessage(this.time);
	};

	this.lays = function(width, height) {

		if ($("#message").is("div")) {
			//return;
		}
		if (width != 0 && width)
			this.layer.width = width;
		if (height != 0 && height)
			this.layer.height = height;
	}

	this.anim = function(type, speed) {
		if ($("#message").is("div")) {
			//return;
		}
		if (type != 0 && type)
			this.anims.type = type;
		if (speed != 0 && speed) {
			switch (speed) {
			case 'slow':
				;
				break;
			case 'fast':
				this.anims.speed = 200;
				break;
			case 'normal':
				this.anims.speed = 400;
				break;
			default:
				this.anims.speed = speed;
			}
		}
	}

	this.rmmessage = function(time) {
		if (time > 0) {
			timer1 = setTimeout('this.closer()', time);
		}
	};
	this.closer = function() {
		switch (this.anims.type) {
		case 'slide':
			$("#message").slideUp(this.anims.speed);
			break;
		case 'fade':
			$("#message").fadeOut(this.anims.speed);
			break;
		case 'show':
			$("#message").hide(this.anims.speed);
			break;
		default:
			$("#message").slideUp(this.anims.speed);
			break;
		}
		;
		setTimeout('$("#message").remove();', this.anims.speed);
		this.original();
	}

	this.original = function() {
		this.layer = {
			'width' :200,
			'height' :100
		};
		this.title = '信息提示';
		this.time = 4000;
		this.anims = {
			'type' :'slide',
			'speed' :600
		};
	};
	jQuery.messager = this;
	return jQuery;
})(jQuery);

var jieqiUserId = 0;
var jieqiUserName = '';
var jieqiUserPassword = '';
var jieqiUserGroup = 0;
var jieqiNewMessage = 0;

if(document.cookie.indexOf('jieqiUserInfo') >= 0){
	
	var jieqiUserInfo = get_cookie_value('jieqiUserInfo');
	
	start = 0;
	offset = jieqiUserInfo.indexOf(',', start); 
	while(offset > 0){
		tmpval = jieqiUserInfo.substring(start, offset);
		tmpidx = tmpval.indexOf('=');
		if(tmpidx > 0){
           tmpname = tmpval.substring(0, tmpidx);
		   tmpval = tmpval.substring(tmpidx+1, tmpval.length);
		   if(tmpname == 'jieqiUserId') jieqiUserId = tmpval;
		   else if(tmpname == 'jieqiUserName_un') jieqiUserName = tmpval;
		   else if(tmpname == 'jieqiUserPassword') jieqiUserPassword = tmpval;
		   else if(tmpname == 'jieqiUserGroup') jieqiUserGroup = tmpval;
		   else if(tmpname == 'jieqiNewMessage') jieqiNewMessage = tmpval;
		}
		start = offset+1;
		if(offset < jieqiUserInfo.length){
		  offset = jieqiUserInfo.indexOf(',', start); 
		  if(offset == -1) offset =  jieqiUserInfo.length;
		}else{
          offset = -1;
		}
	}
}
function login() {
if(jieqiUserId != 0 && jieqiUserName != '' && (document.cookie.indexOf('PHPSESSID') != -1 || jieqiUserPassword != '')){
  document.write('<div class="user_info">');	
 document.write('欢迎您,<span class="name">'+jieqiUserName+'</span>&nbsp;&nbsp;<a href="/modules/article/bookcase.php" target="_top">我的书架</a>');
  if(jieqiNewMessage > 0){
	  document.write('&nbsp;<a href="/message.php?box=inbox" target="_top">您有短信</a>&nbsp;&nbsp;');
  }else{
	  document.write('&nbsp;<a href="/message.php?box=inbox" target="_top">查看短信</a>&nbsp;&nbsp;');
  }
  document.write('<a href="/userdetail.php" target="_top">查看资料</a>&nbsp;<span class="logout">[<a href="/logout.php" target="_self">退出登录</a>]</span>&nbsp;');
  document.write('</div>'); 
}else{
  var jumpurl="";
  if(location.href.indexOf("jumpurl") == -1){
    jumpurl=location.href;
  }
  document.write('<div class="user_login">');
  document.write('<form action="/login.php?do=submit&action=login&usecookie=2592000&jumpurl="+jumpurl+"&jumpreferer=1" method="post">');
  document.write('用户名 <input type="text" id="username" maxlength="20" size="10" value="" name="username">&nbsp;');
  document.write('密码 <input type="password" id="password" name="password" maxlength="30" size="10"><input type="hidden" name="action" value="login">');
  document.write('<input type="hidden" name="jumpurl" value="'+jumpurl+'" />');
  document.write(' <input type="checkbox" class="checkbox" name="usecookie" checked="checked" value="1" />');
  document.write('记录cookie&nbsp;');
  document.write('<input type="image" class="login" src="/images/login.gif" name="submit">&nbsp;');
  document.write('&nbsp;<a class="r" href="/register.php">注册</a> ┆<a class="r" href="/getpass.php">忘记密码</a>');
  document.write('</form>');
  document.write('</div>');
};
var url=window.location.href;
if(url!="http://www.sangwu123.com"){
document.writeln("<div class=\"right\"><a href=\"http://m.sangwu123.com\" style=\"color:#ff0000\" target=\"_blank\">手机桑舞网</a> <a href=\"/newmessage.php?tosys=1&title=意见建议&content=意见建议:\" target=_blank>联系管理</a> <a href=\"/help.php\" target=_blank>帮助中心</a> <a href=\"javascript:window.external.addFavorite(\'http://www.sangwu123.com\',\'桑舞小说网\')\">收藏本站</a> ");
}else{
document.writeln("<div class=\"right\"><a href=\"/newmessage.php?tosys=1&title=\"+book_name+\"-章节错误&content=错误章节为:\" target=_blank>报错</a> <a href=\"/help.php\" target=_blank>帮助中心</a> <a href=\"javascript:window.external.addFavorite(\'http://www.sangwu123.com\',\'桑舞小说网\')\">收藏本站</a> </div>");
}
document.write("<style></style>");
}
function get_cookie_value(Name) { 
  var search = Name + "=";
　var returnvalue = ""; 
　if (document.cookie.length > 0) { 
　  offset = document.cookie.indexOf(search) 
　　if (offset != -1) { 
　　  offset += search.length 
　　  end = document.cookie.indexOf(";", offset); 
　　  if (end == -1) 
　　  end = document.cookie.length; 
　　  returnvalue=unescape(document.cookie.substring(offset, end));
　　} 
　} 
　return returnvalue; 
}
//document.writeln("<script type=\"text\/javascript\" src=\"http:\/\/cbjs.baidu.com\/js\/m.js\"><\/script>");
function search2(){document.writeln("<div class=\"Search\">");
document.writeln("                        <div class=\"SearchBox\">");
document.writeln("                            <form name=\"form\" action=\"http://www.baidu.com/s\" target=\"_blank\">");
document.writeln("                                <span class=\"SearchLeft\">");
document.writeln("                                    <b></b>");
document.writeln("                                    <input type=\"text\" name=\"wd\" value=\"请输入书名或作者名\" onBlur=\"if(this.value==\'\') this.value=\'请输入书名或作者名\';\"");
document.writeln("                                    onFocus=\"if(this.value==\'请输入书名或作者名\') this.value=\'\';\" baiduSug=\"2\" />");
document.writeln("                                </span>");
document.writeln("                                <input name=\"ct\" type=\"hidden\" value=\"2097152\" />");
document.writeln("                                <input name=\"si\" type=\"hidden\" value=\"sangwu123.com\" />");
document.writeln("                                <input name=\"sts\" type=\"hidden\" value=\"sangwu123.com\" />");
document.writeln("                                <span class=\"SearchRight\">");
document.writeln("                                    <input type=\"submit\" value=\"搜索\" />");
document.writeln("                                </span>");
document.writeln("                            </form>");
document.writeln("                        </div>");
document.writeln("                    </div>");}

function search(){document.writeln("<div class=\"Search\">");
document.writeln("                        <div class=\"SearchBox\">");
document.writeln("                            <form name=\"articlesearch\" method=\"get\" action=\"/search.html\" target=\"_blank\">");
document.writeln("                                <span class=\"SearchLeft\">");
document.writeln("                                    <b></b>");
document.writeln("                                    <input type=\"text\" name=\"q\" value=\"请输入书名或作者名\" onBlur=\"if(this.value==\'\') this.value=\'请输入书名或作者名\';\"");
document.writeln("                                    onFocus=\"if(this.value==\'请输入书名或作者名\') this.value=\'\';\" baiduSug=\"2\" />");
document.writeln("                                </span>");
document.writeln("                                <span class=\"SearchRight\">");
document.writeln("                                    <input type=\"submit\" value=\"搜索\" />");
document.writeln("                                </span>");
document.writeln("                            </form>");
document.writeln("                        </div>");
document.writeln("                    </div>");}
//背景修改
function readtool(){
document.writeln("<div class=\"bgs\"><ul><li><input type=\"text\" class=\"textm\" id=\"screen\" value=\"滚屏\"><input type=\"hidden\" class=\"textm\" id=\"screen2\" value=\"0\"><span class=\"btn\" id=\"screen1\"></span></li><li class=\"select\"><p>0</p><p>1慢</p><p>2</p><p>3</p><p>4</p></li></ul>");
document.writeln("<ul><li><input type=\"text\" class=\"textm\" id=\"background\" value=\"背景\"  /><input type=\"hidden\" id=\"background2\" value=\"#FFFFFF\" /><span class=\"btn\" id=\"background1\"></span></li><li class=\"select\"><p class=\"bg_huang\">明黄</p><p class=\"bg_lan\">淡蓝</p><p class=\"bg_lv\">淡绿</p><p class=\"bg_fen\">红粉</p><p class=\"bg_bai\">白色</p><p class=\"bg_hui\">灰色</p><p class=\"bg_hei\">漆黑</p><p class=\"bg_cao\">草绿</p><p class=\"bg_cha\">茶色</p><p class=\"bg_yin\">银色</p><p class=\"bg_mi\">米色</p></li></ul>");
document.writeln("<ul><li><input type=\"text\" class=\"textm\" id=\"fontSize\" value=\"字号\" /><input type=\"hidden\" id=\"fontSize2\" value=\"16px\" /><span class=\"btn\" id=\"fontSize1\"></span></li><li class=\"select\"><p class=\"fon_14\">14px</p><p class=\"fon_18\">18px</p><p class=\"fon_20\">20px</p><p class=\"fon_24\">24px</p><p class=\"fon_30\">30px</p></li></ul>");
document.writeln("<ul><li><input type=\"text\" class=\"textm\" id=\"fontColor\" value=\"字色\" /><input type=\"hidden\" id=\"fontColor2\" value=\"z_mo\" /><span class=\"btn\" id=\"fontColor1\"></span></li><li class=\"select\"><p class=\"z_hei\">黑色</p><p class=\"z_red\">红色</p><p class=\"z_lan\">蓝色</p><p class=\"z_lv\">绿色</p><p class=\"z_hui\">灰色</p><p class=\"z_li\">栗色</p><p class=\"z_wu\">雾白</p><p class=\"z_zi\">暗紫</p><p class=\"z_he\">玫褐</p></li></ul>");
document.writeln("<ul><li><input type=\"text\" class=\"textm\" id=\"fontFamily\" value=\"字体\" /><input type=\"hidden\" id=\"fontFamily2\" value=\"fam_song\" /><span class=\"btn\" id=\"fontFamily1\"></span></li><li class=\"select\"><p class=\"fam_song\">宋体</p><p class=\"fam_hei\">黑体</p><p class=\"fam_kai\">楷体</p><p class=\"fam_qi\">启体</p><p class=\"fam_ya\">雅黑</p></li></ul><input type=\"button\" class=\"ud_but2\" onmousemove=\"this.className=\'ud_but22\'\" onmouseout=\"this.className=\'ud_but2\'\" value=\"保存\" id=\"saveButton\" /><input type=\"button\" class=\"ud_but1\" onmousemove=\"this.className=\'ud_but11\'\" onmouseout=\"this.className=\'ud_but1\'\"  value=\"恢复\" id=\"recoveryButton\" /></div>");
}

var date = new Date();
var timestamp = Date.parse(new Date());
date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));

//jq cookie插件
jQuery.cookie = function(name, value, options) {  
			if (typeof value != 'undefined') { // name and value given, set cookie
				options = options || {};  
				if (value === null) {  
					value = '';  
					options.expires = -1;  
				}  
				var expires = '';  
				if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {  
					var date;  
					if (typeof options.expires == 'number') {  
						date = new Date();  
						date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));  
					} else {  
						date = options.expires;  
					}  
					expires = '; expires=' + date.toUTCString();  
				}  
				var path = options.path ? '; path=' + (options.path) : '';  
				var domain = options.domain ? '; domain=' + (options.domain) : '';  
				var secure = options.secure ? '; secure' : '';  
				document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');  
			} else {  
				var cookieValue = null;  
				if (document.cookie && document.cookie != '') {  
					var cookies = document.cookie.split(';');  
					for (var i = 0; i < cookies.length; i++) {  
						var cookie = jQuery.trim(cookies[i]);  
						if (cookie.substring(0, name.length + 1) == (name + '=')) {  
							cookieValue = decodeURIComponent(cookie.substring(name.length + 1));  
							break;  
						}  
					}  
				}  
				return cookieValue;  
			}  
		};



$(function(){	
	//滚屏
	$('#screen').click(function (){
		var selected = $('#screen').parent().parent().children(".select") ;
		selected.show() ;

	});
	$('#screen1').click(function (){
		var selected = $('#screen').parent().parent().children(".select") ;
		selected.show() ;

	});

	$('#screen').parent().parent().children('.select').children('p').each(function(){
		$(this).click(function(){

			$('#screen').val($(this).html()) ;
			$('#screen').parent().parent().children('.select').hide() ;
		 	var val = $('#screen').val() ;
			$.cookie('screen', val , { path: '/',expires: date});
			autoScroll.start() ;

		});
	});
	//滚屏 end
	/*颜色*/

	//背景色改变
	$('#background').click(function (){
		var selected = $('#background').parent().parent().children(".select") ;
		selected.show() ;

	});
	$('#background1').click(function (){
		var selected = $('#background1').parent().parent().children(".select") ;
		selected.show() ;

	});
	$('.select').parent().each(function (){
		$(this).mouseover(function (){

			$(this).children(".select").show() ;
		}) ;
	});

	$('.select').parent().each(function (){
		$(this).mouseout(function (){
			$(this).children(".select").hide() ;
		}) ;
	});



	$('#background').parent().parent().children('.select').children('p').each(function(){
		$(this).click(function(){
			$('#background').val($(this).html()) ;
			$('#background').parent().parent().children('.select').hide() ;

			$(".readmain").removeClass($('#background2').val());
		 	$("body").removeClass($('#background2').val());
			$("body").attr('style' , '') ;
			$(".readmain").attr('style' , '') ;
			$('#background2').val($(this).attr('class')) ;

			$(".main").addClass($(this).attr('class'));
		 	$("body").addClass($(this).attr('class'));
		});
	});

	//背景色改变 end

	//文字大小
	$('#fontSize').click(function (){
		var selected = $('#fontSize').parent().parent().children(".select") ;
		selected.show() ;

	});
	$('#fontSize1').click(function (){
		var selected = $('#fontSize1').parent().parent().children(".select") ;
		selected.show() ;

	});

	$('#fontSize').parent().parent().children('.select').children('p').each(function(){
		$(this).click(function(){
			$('#fontSize').val($(this).html()) ;
			$('#fontSize').parent().parent().children('.select').hide() ;

			$(".centent").removeClass($('#fontSize2').val());
			$('#fontSize2').val($(this).attr('class')) ;
			$(".centent").addClass($(this).attr('class'));

		});
	});
	//文字大小 end


	//字体
	$('#fontFamily').click(function (){
		var selected = $('#fontFamily').parent().parent().children(".select") ;
		selected.show() ;

	});
	$('#fontFamily1').click(function (){
		var selected = $('#fontFamily1').parent().parent().children(".select") ;
		selected.show() ;

	});

	$('#fontFamily').parent().parent().children('.select').children('p').each(function(){
		$(this).click(function(){
			$('#fontFamily').val($(this).html()) ;
			$('#fontFamily').parent().parent().children('.select').hide() ;

			$(".centent").removeClass($('#fontFamily2').val());
			$('#fontFamily2').val($(this).attr('class')) ;
			$(".centent").addClass($(this).attr('class'));

		});
	});
	//字体 end

	//文字颜色改变
	$('#fontColor').click(function (){
		var selected = $('#fontColor').parent().parent().children(".select") ;
		selected.show() ;

	});
	$('#fontColor1').click(function (){
		var selected = $('#fontColor1').parent().parent().children(".select") ;
		selected.show() ;

	});

	$('#fontColor').parent().parent().children('.select').children('p').each(function(){
		$(this).click(function(){
			$('#fontColor').val($(this).html()) ;
			$('#fontColor').parent().parent().children('.select').hide() ;
			$(".centent").removeClass($('#fontColor2').val());
			$('#fontColor2').val($(this).attr('class')) ;
			$(".centent").addClass($(this).attr('class'));

		});
	});

	//文字颜色改变 end
	//保存按钮 , 恢复按钮
	$("#saveButton").click(function (){
		$.cookie('screen', $('#screen').val(), { path: '/',expires: date});
		$.cookie('background', $('#background2').val() , { path: '/',expires: date});
		$.cookie('fontSize', $('#fontSize2').val() , { path: '/',expires: date});
		$.cookie('fontColor', $('#fontColor2').val() , { path: '/',expires: date});
		$.cookie('fontFamily', $('#fontFamily2').val() , { path: '/',expires: date});
		alert('保存成功') ;
	}) ;
	$("#recoveryButton").click(function (){
		$('body').removeClass($.cookie('background')) ;
		$('body').removeClass($('#background2').val()) ;
		$('.ydleft').removeClass($('#background2').val()) ;
		$('.ydleft').removeClass($.cookie('background')) ;
		$('body').attr('style' , 'background:#FFF') ;
		$('.ydleft').attr('style' , 'background:#FFF') ;	
		$('.centent').removeClass($('#background2').val()) ;
		$('.centent').removeClass($('#fontSize2').val()) ;
		$('.centent').removeClass($.cookie('fontSize')) ;
		$('.centent').removeClass($('#fontColor2').val())
		$('.centent').removeClass($.cookie('fontColor')) ;
		$('.centent').removeClass($('#fontFamily2').val()) ;
		$('.centent').removeClass($.cookie('fontFamily')) ;

		$.cookie('background', '' , { path: '/',expires: date});
		$.cookie('fontSize', '' , { path: '/',expires: date});
		$.cookie('fontColor', '' , { path: '/',expires: date});
		$.cookie('fontFamily', '' , { path: '/',expires: date});
		$('#screen').val('滚屏') ;
		$('#background').val('背景') ;
		$('#fontColor').val('字色') ;
		$('#fontFamily').val('字体') ;
		$('#fontSize').val('字号') ;

	}) ;
	//保存按钮 , 恢复按钮 end

	var autoScroll = (function() {
			var top;
			var timer;
			var actualTop;
			function startTimer() {
				timer = setInterval(scroll, 40);
				try {
					if (document.selection) {
						document.selection.empty();
					} else {
						var selection = document.getSelection();
						selection.removeAllRanges();
					}
				} catch(e) {}
			}
			function scroll() {
				top = document.documentElement.scrollTop || document.body.scrollTop;
				if($.cookie('screen')!=null){
					top = top+parseInt($.cookie('screen'));
				}
				
				window.scroll(0, top);
				actualTop = document.documentElement.scrollTop || document.body.scrollTop;
				if (top != actualTop) {
					stopTimer();
				}
			}
			function stopTimer() {
				clearInterval(timer);
			}
			return {
				start: startTimer,
				stop: stopTimer
			};
		})();
		jQuery(document).dblclick(autoScroll.start);
		jQuery(document).mousedown(autoScroll.stop);


});

//阅读cook样式
function readCookStyle(){
	//滚屏
	if($.cookie('screen')!=null&&$.cookie('screen')!=''){
		$('#screen').val($.cookie('screen')) ;

	}else{
		$('#screen').val('滚屏') ;
	}

	//滚屏 end

	//文字大小
	if($.cookie('fontSize')!=null&&$.cookie('fontSize')!=''){

		$(".centent").addClass($.cookie('fontSize'));
		size=$.cookie('fontSize').replace('fon_',"");
		size += 'px' ;
		$('#fontSize').val(size) ;
		$('#fontSize2').val($.cookie('fontSize')) ;
	}

	//文字大小 end

	//背景
	if($.cookie('background')!=null&&$.cookie('background')!=''){
		var bg_val = '背景' ;
		if($.cookie('background')=='bg_lan') bg_val = '淡蓝' ;
		if($.cookie('background')=='bg_huang') bg_val = '明黄' ;
		if($.cookie('background')=='bg_lv') bg_val = '淡绿' ;
		if($.cookie('background')=='bg_fen') bg_val = '红粉' ;
		if($.cookie('background')=='bg_bai') bg_val = '白色' ;
		if($.cookie('background')=='bg_hui') bg_val = '灰色' ;
		if($.cookie('background')=='bg_hei') bg_val = '漆黑' ;
		if($.cookie('background')=='bg_cao') bg_val = '草绿' ;
		if($.cookie('background')=='bg_cha') bg_val = '茶色' ;
		if($.cookie('background')=='bg_yin') bg_val = '银色' ;
		if($.cookie('background')=='bg_mi') bg_val = '米色' ;
		
		$('#background2').val($.cookie('background')) ;
		$('#background').val(bg_val) ;

		$("body").addClass($.cookie('background'));
		$(".main").addClass($.cookie('background'));
		$(".main").addClass($.cookie('background'));
	}
	//背景 end

	//文字颜色
	if($.cookie('fontColor')!=null&&$.cookie('fontColor')!=''){
		var zt_val = '字色' ;
		if($.cookie('fontColor')=='z_hei') zt_val = '黑色' ;
		if($.cookie('fontColor')=='z_red') zt_val = '红色' ;
		if($.cookie('fontColor')=='z_lan') zt_val = '蓝色' ;
		if($.cookie('fontColor')=='z_lv') zt_val = '绿色' ;
		if($.cookie('fontColor')=='z_hui') zt_val = '灰色' ;
		if($.cookie('fontColor')=='z_li') zt_val = '栗色' ;
		if($.cookie('fontColor')=='z_wu') zt_val = '雾白' ;
		if($.cookie('fontColor')=='z_zi') zt_val = '暗紫' ;
		if($.cookie('fontColor')=='z_he') zt_val = '玫褐' ;

		$('#fontColor2').val($.cookie('fontColor')) ;
		$('#fontColor').val(zt_val) ;
		$(".centent").addClass($.cookie('fontColor'));
	}
	//文字颜色 end

	//字体
	if($.cookie('fontFamily')!=null&&$.cookie('fontFamily')!=''){

		var fa_val = '字体' ;
		if($.cookie('fontFamily')=='fam_song') fa_val = '宋体' ;
		if($.cookie('fontFamily')=='fam_hei') fa_val = '黑体' ;
		if($.cookie('fontFamily')=='fam_kai') fa_val = '楷体' ;
		if($.cookie('fontFamily')=='fam_qi') fa_val = '启体' ;
		if($.cookie('fontFamily')=='fam_ya') fa_val = '雅黑' ;

		$('#fontFamily2').val($.cookie('fontFamily')) ;
		$('#fontFamily').val(fa_val) ;
		$(".centent").addClass($.cookie('fontFamily'));
	}
	//字体 end
}
document.onkeyup = function(e){
e = e ? e : window.event;
actualCode = e.keyCode ? e.keyCode : e.charCode;
if(actualCode == 37) {
window.location = preview_page;
}
if(actualCode == 39) {
window.location = next_page;
}
if(actualCode == 13) {
window.location = index_page;
}
}
//jilu

function jilu(){
	var CI = document.cookie.match(new RegExp("(^| )BLR=([^;]*)(;|$)"));
	if(CI!=null)
	{
		CI = unescape(CI[2]);
		LR = CI.split("#");
		if(LR[0]!=null && LR[1]!=null && LR[2]!=null && LR[3]!=null)
		{
			document.write('<div class="jilu_l pngFix">您上次已阅读到<a href="http://www.sangwu123.com/Html/'+LR[0]+'/" target="_blank" class="sm">《'+LR[2]+'》</a>的 <a href="http://www.sangwu123.com/Html/'+LR[0]+'/'+LR[1]+'.htm" target="_blank" class="zj">'+LR[3]+'</a>!</div>');
		}
		else
		{
			document.write('<div class="jilu_l pngFix">您近期没有阅读，超级精彩的新内容等着您来阅读。</div>');
		}
	}
		else
	{
		document.write('<div class="jilu_l pngFix">您近期没有阅读，超级精彩的新内容等着您来阅读。</div>');
	}document.write('<div class="jilu_2 pngFix"><a href="/modules/article/" target="_blank">小说书库</a></div>');

}
function setCookies(cookieName,cookieValue, expirehours)
{
  var today = new Date();
  var expire = new Date();
  expire.setTime(today.getTime() + 3600000 * 356 * 24);
  document.cookie = cookieName+'='+escape(cookieValue)+ ';path=/;expires='+expire.toGMTString();
}

function LAST_READ_SET(bid, tid, booktitle, texttitle)
{
	if(texttitle=="") {
		texttitle = '首页';
	}
	var LRRead = bid+"#"+tid+"#"+booktitle+"#"+texttitle;
	setCookies("BLR", LRRead);
}
function footer() {
    document.writeln("<p>本站所有小说为转载作品，所有章节均由网友上传，转载至本站只是为了宣传本书让更多读者欣赏。<\/p>");
    document.writeln("<p>Copyright &copy; 2014 桑舞小说网 All Rights Reserved.<\/p>");
    document.writeln("<p>苏ICP备14007602号<\/p>");
    //document.writeln("<script charset=\"gbk\" src=\"http://www.baidu.com/js/opensug.js\"></script>");
    document.writeln("<script charset=\"gbk\" src=\"http://p.tanx.com/ex?i=mm_26955695_9636841_32214074\"></script>");
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F5567495dad4850ad72a6cc97dccd9d20' type='text/javascript'%3E%3C/script%3E"));
document.writeln("<script>");
document.writeln("(function(){");
document.writeln("    var bp = document.createElement(\'script\');");
document.writeln("    bp.src = \'//push.zhanzhang.baidu.com/push.js\';");
document.writeln("    var s = document.getElementsByTagName(\"script\")[0];");
document.writeln("    s.parentNode.insertBefore(bp, s);");
document.writeln("})();");
document.writeln("</script>");
}
function showpop(url) {
	$.get(url, function(data){
		$.messager.lays(260, 120);
		$.messager.anim('fade', 1000);
		$.messager.show("提示信息", data ,5000);
	});
}
var ar = ['00:00','12:00'];
function checkTime(ar) {
    var d = new Date();
    var current = d.getHours() * 60 + d.getMinutes();
    var ar_begin = ar[0].split(':');
    var ar_end = ar[1].split(':');
    var b = parseInt(ar_begin[0]) * 60 + parseInt(ar_begin[1]);
    var e = parseInt(ar_end[0]) * 60 + parseInt(ar_end[1]);
    if(current >= b && current <= e) document.write("<a href=\"/modules/article/txtarticle.php?id="+book_id+"\">TXT下载[-50积分]</a>")
else document.write("TXT下载的开放时间为00:00-12:00");
    }
function down(){ checkTime(ar);
}
function index_1(){document.writeln("<script type=\"text/javascript\">");
document.writeln("    google_ad_client = \"ca-pub-0986426559120959\";");
document.writeln("    google_ad_slot = \"5482498239\";");
document.writeln("    google_ad_width = 970;");
document.writeln("    google_ad_height = 90;");
document.writeln("</script>");
document.writeln("<!-- 970x90 -->");
document.writeln("<script type=\"text/javascript\"");
document.writeln("src=\"//pagead2.googlesyndication.com/pagead/show_ads.js\">");
document.writeln("</script>");}
function index_2(){document.writeln("<script type=\"text/javascript\">");
document.writeln("    google_ad_client = \"ca-pub-0986426559120959\";");
document.writeln("    google_ad_slot = \"5482498239\";");
document.writeln("    google_ad_width = 970;");
document.writeln("    google_ad_height = 90;");
document.writeln("</script>");
document.writeln("<!-- 970x90 -->");
document.writeln("<script type=\"text/javascript\"");
document.writeln("src=\"//pagead2.googlesyndication.com/pagead/show_ads.js\">");
document.writeln("</script>");}
function chapter_1(){document.writeln("<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>");
document.writeln("<!-- 970x90 -->");
document.writeln("<ins class=\"adsbygoogle\"");
document.writeln("     style=\"display:inline-block;width:970px;height:90px\"");
document.writeln("     data-ad-client=\"ca-pub-0986426559120959\"");
document.writeln("     data-ad-slot=\"5482498239\"></ins>");
document.writeln("<script>");
document.writeln("(adsbygoogle = window.adsbygoogle || []).push({});");
document.writeln("</script>");}
function chapter_2(){document.writeln("<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>");
document.writeln("<!-- 970x90 -->");
document.writeln("<ins class=\"adsbygoogle\"");
document.writeln("     style=\"display:inline-block;width:970px;height:90px\"");
document.writeln("     data-ad-client=\"ca-pub-0986426559120959\"");
document.writeln("     data-ad-slot=\"5482498239\"></ins>");
document.writeln("<script>");
document.writeln("(adsbygoogle = window.adsbygoogle || []).push({});");
document.writeln("</script>");
document.writeln("<a class=\"go_top\" title=\"返回顶部\" href=\"javascript:scroll(0,0);\"></a>");
document.writeln("<a class=\"go_btm\" title=\"直达底部\" href=\"javascript:scrollTo(0,99999);\"></a>");}
function style_2(){document.writeln("<script type=\"text/javascript\">");
document.writeln("    google_ad_client = \"ca-pub-0986426559120959\";");
document.writeln("    google_ad_slot = \"9668093434\";");
document.writeln("    google_ad_width = 336;");
document.writeln("    google_ad_height = 280;");
document.writeln("</script>");
document.writeln("<!-- 336x280 -->");
document.writeln("<script type=\"text/javascript\"");
document.writeln("src=\"//pagead2.googlesyndication.com/pagead/show_ads.js\">");
document.writeln("</script>");}
function style_1(){document.writeln("<script charset=\"gbk\" src=\"http://p.tanx.com/ex?i=mm_26955695_9636841_47118946\"></script>");}
function style_3(){document.writeln("<script charset=\"gbk\" src=\"http://p.tanx.com/ex?i=mm_26955695_9636841_47138118\"></script>");}
function style_4(){readCookStyle();chapter_1();}
function style_5(){document.writeln("<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>");
document.writeln("<!-- 970x90 -->");
document.writeln("<ins class=\"adsbygoogle\"");
document.writeln("     style=\"display:inline-block;width:970px;height:90px\"");
document.writeln("     data-ad-client=\"ca-pub-0986426559120959\"");
document.writeln("     data-ad-slot=\"5482498239\"></ins>");
document.writeln("<script>");
document.writeln("(adsbygoogle = window.adsbygoogle || []).push({});");
document.writeln("</script>");
document.writeln("<a class=\"go_top\" title=\"返回顶部\" href=\"javascript:scroll(0,0);\"></a>");
document.writeln("<a class=\"go_btm\" title=\"直达底部\" href=\"javascript:scrollTo(0,99999);\"></a>");
}

function gg(){/*document.write('<div style="border: 1px solid #E4E4E4;width:960px;color:red;line-height:25px;margin:5px auto;padding:0px;font-size:20px;">1.近期我们对搜索进行的优化，如有问题请发站内信！<br>2.即日起原网址原www.sangwu.net更换为www.sangwu123.com，请各位会员使用新地址访问本站,帐号书架保持不变。</div>');*/
}