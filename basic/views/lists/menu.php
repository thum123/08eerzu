<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>自定义回复消息</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="http://www.jscss.me">管理员</a></li>
                <li><a href="http://www.jscss.me">修改密码</a></li>
                <li><a href="http://www.jscss.me">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="index.php?r=index/addwe"><i class="icon-font">&#xe008;</i>添加公众号</a></li>
                        <li><a href="index.php?r=lists/lists"><i class="icon-font">&#xe005;</i>公众号列表</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe006;</i>分类管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe012;</i>评论管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe052;</i>友情链接</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/think/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">系统设置</span></div>
        </div>
        <div class="result-wrap">
            <form action="index.php?r=lists/addmessage" method="post" id="myform" name="myform">
                <div class="config-items">
                    <div class="config-title">
                        <h1><i class="icon-font">&#xe00a;</i>自定义菜单设置&nbsp;&nbsp;<a href="index.php?r=lists/menu_lists&we_id=<?php echo $we_id?>">自定义菜单列表</a></h1>
                    </div>
                    <div class="result-content">
                        <input type="hidden" value="<?php echo $we_id?>" id="we_id">
                        <input type="hidden" value="1" id="num">
                        <input type="hidden" value="1" id="erji">
                        <input type="hidden" value="1" id="sanji">
                    <span  onclick="zhu2()">添加二级主菜单</span>
                    <span  onclick="zhu3()">添加三级主菜单</span>
                        <table id='a' width="100%" class="insert-tab">
                              <tr id="b">
                                  <td>1:</td><td><input type="text" id='zhu1'><span onclick="son()">添加子菜单</span></td>
                              </tr>
                              <!-- <tr>
                                  <td></td><td><input type="text"></td>
                              </tr> -->
                          
                        </table>    
                        
                    </div>
                    <span onclick="tijiao()">提交</span>
                </div>
            
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
<script src="jq.js"></script>
<script>
        function son()
        {
            var str = '<tr id="c"><td></td><td>--------<input name="sonname" type="text"></td></tr>';
            $("#a").append(str);
        }
        function zhu2()
        {   
            var nu = $("#num").val();
            var num = parseInt(nu);
            //获取二级菜单的添加册数
            var erji = parseInt($("#erji").val());
            if(num<3)
            {
                    if(erji ==1)
                    {
                        var er = erji + 1;
                        $("#erji").val(er);

                                    var n = num+1;
                                    $("#num").val(n);    
                                    var str = "<table id='2a' width='100%' class='insert-tab'><tr id='b'><td>2:</td><td><input type='text' id='zhu2'><span onclick='erson()'>添加子菜单</span></td></tr></table>";
                                     $(".result-content").append(str);   
                      
                    }
                    else
                    {
                        alert('您只能添加一次二级主菜单');
                    }
                               }
            else
            {
                alert('您只能添加三个主菜单');
            } 

        }
        function zhu3()
        {   
            var nu = $("#num").val();
            var num = parseInt(nu);
            // alert(num);
            var sanji = parseInt($("#sanji").val());
             if(num<3){
                    if(sanji ==1)
                    {
                        var san = sanji + 1;
                        $("#sanji").val(san);
                             
                                      var n = num+1;
                                    $("#num").val(n);                
                                var str = "<table id='3a' width='100%' class='insert-tab'><tr id='b'><td>3:</td><td><input type='text' id='zhu3'><span onclick='sanson()'>添加子菜单</span></td></tr></table>";
                                 $(".result-content").append(str);                
                        
                    }
                    else
                    {
                        alert('您只能添加一个三级主菜单');
                    }
            }
            else
            {
                alert('您只能添加三个主菜单');
            }  


        } 
        function erson()
        {
            var str = '<tr><td></td><td>--------<input name="2sonname" type="text"></td></tr>';
            $("#2a").append(str);
        } 
        function sanson()
        {
            var str = '<tr><td></td><td>--------<input name="3sonname" type="text"></td></tr>';
            $("#3a").append(str);
        }   
        function tijiao()
        {
                     //取得一级主菜单的子菜单
                    var info = document.getElementsByName('sonname');
                    // console.log(info);
                    // alert(info.length);
                    var arr = new Array();
                    for(var i=0; i<info.length; i++)
                    {
                            arr.push(info[i].value);
                    }

                    var str = arr.join(',');
                    // alert(str);
                    //取得二级主菜单的子菜单
                    var info2 = document.getElementsByName('2sonname');
                    // console.log(info2);
                    // alert(info.length);
                    var arr2 = new Array();
                    for(var i=0; i<info2.length; i++)
                    {
                            arr2.push(info2[i].value);
                    }
                    var str2 = arr2.join(',');
                    // alert(str2);
                    //取得三级主菜单的子菜单
                    var info3 = document.getElementsByName('3sonname');
                    // console.log(info3);
                    // alert(info.length);
                    var arr3 = new Array();
                    for(var i=0; i<info3.length; i++)
                    {
                            arr3.push(info3[i].value);
                    }
                    var str3 = arr3.join(',');
                    // alert(str3);
                    //获取一级主菜单名称
                    var zhu1name = $("#zhu1").val();
                    var zhu2name = $("#zhu2").val();
                    var zhu3name = $("#zhu3").val();
                    var we_id = $("#we_id").val();
                    //传值到后台进行入库
                    $.get('index.php?r=lists/addmenu',{'str':str,'str2':str2,'str3':str3,'zhu1name':zhu1name,'zhu2name':zhu2name,'zhu3name':zhu3name,'we_id':we_id},function(msg){
                            if(msg==1)
                            {
                                alert('添加成功');
                            }
                            else
                            {
                                alert('添加失败');
                            }
                            // alert(msg);
                    });
                    
        }


</script>