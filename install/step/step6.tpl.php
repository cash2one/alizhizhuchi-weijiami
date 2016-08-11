<?php include ALI_PATH.'install/step/header.tpl.php';?>
	<div class="body_box">
        <div class="main_box">
            <div class="hd">
            	<div class="bz a6"><div class="jj_bg"></div></div>
            </div>
            <div class="ct">
            	<div class="bg_t"></div>
                <div class="clr">
                    <div class="l"></div>
                    <div class="ct_box">
                     <div class="nr">
                  	<div id="installmessage" ><br/><br/><h1>恭喜您，安装成功！</h1><br/><span style="margin-right:8px;">*</span>为了您站点的安全，安装完成后请将网站根目录下的“install”文件夹删除。</div>
                     </div>
                    </div>
                </div>
                <div class="bg_b"></div>
            </div>
            <div class="btn_box"><a href="javascript:history.go(-1);" class="s_btn pre">上一步</a><a href="<?php echo $url?>admin" class="x_btn pre" id="finish">进入后台(<span id="djs"></span>)</a></div>
        </div>
    </div>
    <div id="hiddenop"></div>
    <script type="text/javascript">
        var k=6;
        var djs=setInterval(function(){
            document.getElementById("djs").innerHTML=k;
            if(k==0){
                clearInterval(djs);
                window.location.href="<?php echo $url?>admin";
            }
            k--;
        },1000)
    </script>
</body>
</html>
