// JavaScript Document
$(document).ready(function () {	
	//列表切换效果。
	$('.table_box dt li').mouseover(function(e) {
		dds=$(this).parent().parent().parent().children().filter("dd");
		dts=$(this).parent().children();
		cid=dts.index($(this));
		dts.removeClass('cur_dt');
		dds.removeClass('cur_dd');
		$(this).addClass('cur_dt');
		dds.eq(cid).addClass('cur_dd');
    });
	
	//图片轮播效果
	img_flash=$('.img_flash');
	
	img_flash_ogj=new Array();
	img_flash.each(function(index, element) {
		$(element).attr('cidx',0);
		img_flash_ogj[element.id]=setTimeout("run_img_flash('"+element.id+"')",5000);
		$('.img_flash_'+element.id+' li').mouseover(function(){
			if_id=$(this).parent().attr('class').replace('img_flash_','')
			idx=$(this).parent().children().index(this);
			run_img_flash(if_id,-1,idx);
		})
    });	
	
	//滚动
	ctd_tid=setTimeout("tdFlash(1)",5000);
	$('.m4 .prev').click(function(){tdFlash(ctd+1)})
	$('.m4 .next').click(function(){tdFlash(ctd-1)})
	
})

ctd=0;
ctd_tid=null;
function tdFlash(next_td){
	if($('.tds').attr('running') != 1){
		$('.tds').clearQueue();
		clearTimeout(ctd_tid);
		tds=$('.tds td');
		if(next_td>tds.length/2 && ctd<next_td){
			$('.tds').css('left',-tds.eq(0).position().left);
			next_td=1;
		}
		if(next_td<0){
			$('.tds').css('left',-tds.eq(tds.length/2).position().left);
			next_td=tds.length/2-1;
		}
		os=tds.eq(next_td).position();
		$('.tds').attr('running',1);
		$('.tds').animate({left:-os.left},500,function(){
			ctd=next_td;
			ctd_tid=setTimeout("tdFlash("+(ctd+1)+")",5000);
			$(this).attr('running',0);
		})
	}
}

function run_img_flash(id){
	el=$('#'+id);
	if(el.attr('runing')!=1){
		oidx=Number(el.attr('cidx'))
		tagid=(typeof(arguments[2])=='number')?arguments[2]:((typeof(arguments[1])=='number')?oidx+Number(arguments[1]):oidx+1);
		num=el.children().length;
		tagid=(tagid>=num)?0:((tagid<0)?num-1:tagid);
		lis=el.children();
		clearTimeout(img_flash_ogj[id]);
		lis.stop();
		el.attr('runing',1)
		lis.eq(oidx).fadeOut('fast')
		lis.eq(tagid).fadeIn('fast',function(){
			$(this).parent().attr('runing',0);
		});
		el.attr('cidx',tagid);
		btnlis=$('.img_flash_'+id).children();
		if(btnlis){
			btnlis.eq(oidx).removeClass('cur');
			btnlis.eq(tagid).addClass('cur');
		}
		img_flash_ogj[id]=setTimeout("run_img_flash('"+id+"')",5000);
	}
}