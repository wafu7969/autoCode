<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:19:"template/\help.html";i:1538608883;s:64:"F:\5-myTool\CodeBuilder\public\tph2\template\default_layout.html";i:1538608883;s:58:"F:\5-myTool\CodeBuilder\public\tph2\template\leftmenu.html";i:1538608883;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>TPH 帮助</title>
  <meta name="keywords" content="ThinkphpHelper,Thinkphp5代码自动生成,Thinkphp5脚手架,快速原型工具" />
  <meta name="description" content="ThinkphpHelper,Thinkphp5代码自动生成工具,Thinkphp5脚手架,快速原型工具" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="sjj">
  <script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.js"></script> <!-- jQuery -->
  <!-- Stylesheets -->
  <link href="<?php echo TEMPLATE_PATH; ?>asset/style/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/font-awesome.css">
  <!-- jQuery UI -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/jquery-ui.css">
  <!-- Calendar -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/fullcalendar.css">
  <!-- prettyPhoto -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/prettyPhoto.css">
  <!-- Star rating -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/rateit.css">
  <!-- Date picker -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/bootstrap-datetimepicker.min.css">
  <!-- CLEditor -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/jquery.cleditor.css">
  <!-- Bootstrap toggle -->
  <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>asset/style/bootstrap-switch.css">
  <!-- Main stylesheet -->
  <link href="<?php echo TEMPLATE_PATH; ?>asset/style/style.css" rel="stylesheet">
  <!-- Widgets stylesheet -->
  <link href="<?php echo TEMPLATE_PATH; ?>asset/style/widgets.css" rel="stylesheet">

  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="<?php echo TEMPLATE_PATH; ?>asset/js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo MODULE_PATH; ?>/img/favicon/favicon.png">
  <script>
	$(document).ready(function(){
		$.post('<?php echo U(MODULE_NAME."/Index/checkVersion"); ?>',
			function(data){
				$('#version').html(data);
			}
		);
	});
  </script>
</head>

<body>
<!-- Header starts -->
  <header>
    <div class="container">
      <div class="row">

        <!-- Logo section -->
        <div class="col-md-4">
          <!-- Logo. <!-- Logo ends -->
          <div class="logo">
            <h1><a href="#">ThinkphpHelper V2.10<span class="bold"></span></a></h1>
            <p class="meta">代码生成工具　　　　<a href="https://github.com/zhuanqianfish/ThinkphpHelper" id="version"></a>
			如果觉得好用，请记得分享给你的好基友们！</p>
          </div>
          
        </div>

        <!-- Button section -->
        <div class="col-md-4">

        </div>

        <!-- Data section -->

        <div class="col-md-4">
          <div class="header-data">

            <!-- Traffic data -->
            <div class="hdata">
              <div class="mcol-left">
                <!-- Icon with red background -->
                <i class="icon-signal bred"></i>
              </div>
              <div class="mcol-right">
                <!-- Number of visitors -->
                <p><a href="https://github.com/zhuanqianfish/ThinkphpHelper">项目</a> <em>GitHub</em></p>
              </div>
              <div class="clearfix"></div>
            </div>

            <!-- Members data -->
            <div class="hdata">
              <div class="mcol-left">
                <!-- Icon with blue background -->
                <i class="icon-user bblue"></i>
              </div>
              <div class="mcol-right">
                <!-- Number of visitors -->
                <p><a href="http://zhuanqianfish.github.io/ThinkphpHelper/donation.html">捐赠</a> <em>donation</em></p>
              </div>
              <div class="clearfix"></div>
            </div>
      <!-- revenue data
        <div class="hdata">
          <div class="mcol-left">
            <i class="icon-money bgreen"></i>
          </div>
          <div class="mcol-right">
            <p><a href="#">赞助</a><em>support</em></p>
          </div>
          <div class="clearfix"></div>
        </div>
			-->
          </div>
        </div>

      </div>
    </div>
  </header>

<!-- Header ends -->

<!-- Main content starts -->

<div class="content">

  	<!-- Sidebar -->
    <div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">导航</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
      <!-- Main menu with font awesome icon -->
      
      <li class="has_sub "><a href="#" class="subdrop"><i class="icon-bar-chart"></i>项目配置</a>
        <ul>
          <li><a href="<?php echo APP_NAME; ?>/ProjectConfig/index">项目配置</a></li>
          <li><a href="<?php echo APP_NAME; ?>/ProjectConfig/formConfig">表单配置</a></li>
        </ul>
      </li>

      <li><a href="<?php echo APP_NAME; ?>/CreateLayout"><i class="icon-bar-chart"></i>公共文件生成</a></li>
      <li><a href="<?php echo APP_NAME; ?>/WedgitCode/menu"><i class="icon-bar-chart"></i>菜单生成</a></li>
      <li><a href="<?php echo APP_NAME; ?>/ViewCode"><i class="icon-tasks"></i>前台界面生成</a></li>      
      <li><a href="<?php echo APP_NAME; ?>/ControllerCode"><i class="icon-bar-chart"></i>控制器代码生成</a></li>
      <li class="has_sub "><a href="#"><i class="icon-table"></i>模型代码生成</a>
        <ul>
          <li><a href="<?php echo APP_NAME; ?>/ModelCode/index">简易模型代码生成</a></li>
          <li><a href="<?php echo APP_NAME; ?>/ModelCode/index2">手动模型代码生成</a></li>
        </ul>
      </li>
      <li><a href="<?php echo APP_NAME; ?>/Index/help"><i class="icon-calendar"></i>帮助</a></li>
    </ul>
</div>
    <!-- Sidebar ends -->
  	<!-- Main bar -->
		
<div class="mainbar" style="font-size: 16px;padding: 10px;">

    <p>
        新建一个项目，名字为test1，复制TPH2到项目的public目录下(网站访问的根目录)，<br/>这里是一个作为例子的项目使用的数据库结构
        （TPH并不限制你的数据库结构，但是请保证所有表都有一个id作为主键）<br/>
        <img src="<?php echo TEMPLATE_PATH; ?>asset/img/help/1.jpg" alt="">
    </p>


    <p>
        <br/>
    </p>
    <p>
        2.配置项目的数据库链接，修改application/database.php文件，使得项目能够正确连接数据库<br/>
        <img src="<?php echo TEMPLATE_PATH; ?>asset/img/help/2.jpg" alt="">
    </p>
    <p>
        <br/>
    </p>
    <p>
        3.浏览器访问 [域名]/TPH2&nbsp; 这时你应该能够看到TPH的欢迎界面了<br/>
        <img src="<?php echo TEMPLATE_PATH; ?>asset/img/help/3.jpg" alt="">
    </p>
    <p>
        <br/>
    </p>
    <p>
        4.生成公共文件<br/>
        <img src="<?php echo TEMPLATE_PATH; ?>asset/img/help/4.jpg" alt="">
    </p>
    <p>
        <br/>
    </p>
    <p>
        5.生成前台界面，依次选择你要生成的表单对应的数据表并点击“一键生成文件”<br/>
        <img src="<?php echo TEMPLATE_PATH; ?>asset/img/help/5.jpg" alt="" width="70%">
    </p>
    <p>
        <br/>
    </p>
    <p>
        6.选中要生成控制器对应的表，点击“直接生成文件”<br/>
        <img src="<?php echo TEMPLATE_PATH; ?>asset/img/help/6.jpg" alt="">
    </p>
    <p>
        <br/>
    </p>
    <p>
        7.使用“简易模型代码生成”，选中对应表，直接生成文件<br/>
        <img src="<?php echo TEMPLATE_PATH; ?>asset/img/help/7.jpg" alt="">
    </p>
    <p>
        <br/>
    </p>
    <p>
        8.访问对应页面<br/>
        <img src="<?php echo TEMPLATE_PATH; ?>asset/img/help/8.jpg" alt="">
    </p>
    <p>
        Enjoy it!<br/>
    </p>
</div>

  	
</div>
<!-- Content ends -->

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2014-2018 | <a href="http://weiyunstudio.com">WeiYunStudio.com</a> </p>
      </div>
    </div>
  </div>
</footer>

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>

<!-- JS -->

<script src="<?php echo TEMPLATE_PATH; ?>asset/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- jQuery Notification - Noty -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="<?php echo TEMPLATE_PATH; ?>asset/js/sparklines.js"></script> <!-- Sparklines -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/filter.js"></script> <!-- Filter for support page -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/custom.js"></script> <!-- Custom codes -->
<script src="<?php echo TEMPLATE_PATH; ?>asset/js/charts.js"></script> <!-- Charts & Graphs -->


</body>
</html>
