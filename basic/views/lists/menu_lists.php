<?php use yii\widgets\LinkPager;?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">自定义菜单列表</a></h1>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">自定义菜单管理</span></div>
        </div>

        <div class="result-wrap">
        	<form action="">
				<?php foreach($con as $k=>$v){?>
				<p onclick='change(<?php echo $v['me_id']?>)'>主菜单:&nbsp;&nbsp;&nbsp;<span id="s<?php echo $v['me_id']?>"><?php echo $v['data']?></span>
                    <input type="text" value="<?php echo $v['data']?>" id="i<?php echo $v['me_id']?>" style="display:none;"
                                        onblur="update(<?php echo $v['me_id']?>)"/>
                    <a href="javascript:del(<?php echo $v['me_id']?>);">删除</a></p>
					<?php foreach($v['son'] as $key=>$val){?>
						<p onclick='change(<?php echo $val['me_id']?>)'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--------
                             <input type="text" value="<?php echo $val['data']?>" id="i<?php echo $val['me_id']?>" style="display:none;"
                                        onblur="update(<?php echo $val['me_id']?>)"/>
                            <span  id="s<?php echo $val['me_id']?>"><?php echo $val['data']?></span>
                            <a href="javascript:del(<?php echo $val['me_id']?>);">删除</a></p>
					<?php }?>
				<?php }?>
				
			</form>
        </div>
    </div>
    <!--             <td id="{$v.f_id}" onclick='change({$v.f_id})'>
                                    <input type="text" value="{$v.name}" id="i{$v.f_id}" style="display:none;"
                                        onblur="update({$v.f_id})"/>
                                    <span id="s{$v.f_id}">{$v.name}</span>
                            </td> -->
    <!--/main-->
</div>
</body>
</html>

<script src="jq.js"></script>
<script>
    function del(id)
    {
        // alert(id);
        $.get('index.php?r=lists/delmenu',{'id':id},function(msg){
                // alert(msg);
                if(msg!=0)
                {
                    window.location.reload();

                }
        },'json');
    }
function change(id)
{
    // alert(id);
  document.getElementById('i'+id).style.display='block';
  document.getElementById('s'+id).innerHTML='';
}
function update(id)
{ 
    // alert(id);
  var val =document.getElementById('i'+id).value;
  var xhr =new XMLHttpRequest();
  xhr.open('get','index.php?r=lists/save&val=' + val + '&id=' + id);
  xhr.send(null);
  xhr.onreadystatechange=function()
  {
    if(xhr.readyState==4)
    {
        // alert(xhr.responseText);
      if(xhr.responseText==1)
      {
        alert('成功');
        document.getElementById('i'+id).style.display='none';
        document.getElementById('s'+id).innerHTML = val;

      }
      else
      {
        alert('修改失败');
      }
    }
  }
}
</script>
