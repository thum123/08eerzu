<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;
use app\models\Account;
class ListsController extends Controller
{
	//公众号列表
	public function actionLists()
	{
		session_start();
		$session = Yii::$app->session;
		$uid = $session['id'];
		$query = Account::find()->where(['uid' => $uid]);
		$pagination = new Pagination([
		'defaultPageSize' => 8,                    //每页的条数
		'totalCount' => $query->count(),
		]);

		$countries = $query
		->offset($pagination->offset)
		    ->limit($pagination->limit)
		    ->all();

		return $this->renderAjax('lists', [               //要遍历的页面
		'countries' => $countries,                  //遍历的数据 
		'pagination' => $pagination,                //分页下面的样式
		]);
	}
	//自定义回复消息
	public function actionMessage()
	{
		$we_id = $_GET['we_id'];
		// echo $we_id;die;
		return $this->renderAjax('message',['we_id'=>$we_id]);
	}
	//添加自定义回复消息
	public function actionAddmessage()
	{
		$connection = \Yii::$app->db;
		$data['we_id'] = $_POST['we_id'];
		$we_id = $data['we_id'];
		$data['keywords'] = $_POST['keywords'];
		$data['backwords'] = $_POST['backwords'];
		$res = $connection->createCommand()->insert('message',$data)->execute();
		if($res)
		{
			echo "<script>alert('添加成功')</script>";
			header("refresh:0;url=index.php?r=lists/message&we_id=$we_id");die;
		}
		else
		{
			echo "<script>alert('添加失败')</script>";
			header("refresh:0;url=index.php?r=lists/message&we_id=$we_id");die;
		}
	}
	//自定义回复消息列表
	public function actionMelists()
	{
		$db = \Yii::$app->db;
		$we_id = $_GET['we_id'];
		$sql = "select * from message where we_id = '$we_id'";
		$command = $db->createCommand($sql)->queryAll();
		// var_dump($command);die;
		// $posts = $command
		// var_dump($posts);die;
		return $this->renderAjax('message_list',['data'=>$command]);

	}
	//添加菜单栏表单
	public function actionMenu()
	{
		$we_id = $_GET['we_id'];
		return $this->renderAjax('menu',['we_id'=>$we_id]);
	}
	//开始添加菜单栏
	public function actionAddmenu()
	{
		$connection = \Yii::$app->db;
		$we_id = $_GET['we_id'];
		$str = $_GET['str'];
		$str2 = $_GET['str2'];
		$str3 = $_GET['str3'];
		// echo $str3;die;
		// var_dump($data);die;
		$zhu1name = isset($_GET['zhu1name'])?$_GET['zhu1name']:"";
		$zhu2name = isset($_GET['zhu2name'])?$_GET['zhu2name']:"";
		$zhu3name = isset($_GET['zhu3name'])?$_GET['zhu3name']:"";
		$arr = explode(',', $str);
		$arr2 = explode(',', $str2);
		$arr3 = explode(',', $str3);
		// var_dump($arr2);
		// var_dump($arr3);die();
		// var_dump($arr);die;
		//先把父级菜单进行入库
		if(!empty($zhu1name)){
			$zhu1 = "insert into menu values (null,'$zhu1name','123','0','0','$we_id')";
			$command=$connection->createCommand($zhu1);
			$command->execute();
			$zhi1_id = $connection->getLastInsertID();

		}
		if(!empty($zhu2name))
		{
			$zhu2 = "insert into menu values (null,'$zhu2name','123','0','1','$we_id')";
			$command=$connection->createCommand($zhu2);
			$command->execute();
			$zhi2_id = $connection->getLastInsertID();
		}
		if(!empty($zhu3name))
		{
			$zhu3 = "insert into menu values (null,'$zhu3name','123','0','2','$we_id')";
			$command=$connection->createCommand($zhu3);
			$command->execute();
			$zhi3_id = $connection->getLastInsertID();
		}
		// var_dump($arr);die;
		//天机第一个
		if(!empty($arr[0]))
		{
			foreach($arr as $k=>$v)
			{
				// echo $v;
				$sql = "insert into menu values (null,'$v','123','$zhi1_id','0','$we_id')";
				// echo $sql;
				$command1=$connection->createCommand($sql);
				$res = $command1->execute();
				// echo $command1;die;
				// var_dump($res);die;
			}
		}

		///添加第二个
		if(!empty($arr2[0]))
		{
			foreach($arr2 as $k=>$v)
			{
				// echo $v;
				$sql2 = "insert into menu values (null,'$v','123','$zhi2_id','1','$we_id')";
				$command2=$connection->createCommand($sql2);
				$command2->execute();
			}
		}
		// die;
		//添加第三个
		if(!empty($arr3[0]))
		{
			foreach($arr3 as $k=>$v)
			{
				$sql3 = "insert into menu values (null,'$v','123','$zhi3_id','2','$we_id')";
				$command3=$connection->createCommand($sql3);
				$command3->execute();
			}
		}

		if($command1 || $command2 || $command3)
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
		// echo $menu;
	}

	//自定义菜单列表显示
	public function actionMenu_lists()
	{
		// echo 123;die;
		$connection = \Yii::$app->db;
		$we_id = $_GET['we_id'];
		$sql1 = "select * from menu where we_id = '$we_id'";
		$command = $connection->createCommand($sql1);
		$data = $command->queryAll();
		// var_dump($data);
		$con = array();
		foreach($data as $k=>$v)
		{
		    if($v['type']==0&&$v['f_id']==0)
		    {
		        $con[0] = $v;
		    }
		    elseif($v['type']==1&&$v['f_id']==0)
		    {
		        $con[1] = $v;
		    }
		    elseif($v['type']==2&&$v['f_id']==0)
		    {
		        $con[2] = $v;
		    }
		}
		// var_dump($con);die;
		foreach($con as $k=>$v)
		{
		    // $me_id = $v[' me_id'];
		    // echo $v['me_id'];
		     $sqls = "select * from menu where f_id = '$v[me_id]' and type = '$v[type]'";
		    //echo $sqls;die;
		    $con[$k]['son'] =  $connection->createCommand($sqls) -> queryAll();

		}

		return $this->renderAjax('menu_lists',['con'=>$con]);
	}


}
