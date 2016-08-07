# 阿里蜘蛛池 AliSpider ---安装说明
1、服务器支持windows2008、windows2012、linux各发行版
2、环境要求iis或apache,php5.6以上,mysql5以上版本
3、将所有域名泛解析到此服务器
4、将程序上传到服务器,打开浏览器地址栏中输入"http://你的服务器IP/adminer.php,在Username中输入root,Password中输入安装mysql时设置的密码,Database留空,点击Login按钮登录
5、登录后点击页面左侧"Import"链接,进入后点击右侧From server里面的Run file按钮,提示"OK"字样表示数据库安装成功
6、使用notepad++编辑器编辑admin/inc/data.php文件(千万不要用windows自带记事本编辑),把你的mysql数据库密码填上,然后上传到服务器对应目录中覆盖文件
7、在浏览器地址栏中输入你的授权域名,如"www.xxxx.com/admin",进入后台管理界面,通过默认用户名admin,默认密码123456登录,登录后请及时在系统设置--修改密码菜单中修改默认密码
8、请将购买的域名放入到左侧系统设置--域名管理中,将需要收入链接放入系统设置--外推链接中
9、在蜘蛛管理--蜘蛛设置中关闭不需要蜘蛛引擎
10、在系统设置--模板管理下载最新模板并开启