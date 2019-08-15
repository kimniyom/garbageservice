<?php

namespace app\modules\service\controllers;
use Yii;
use yii\web\Controller;
use app\modules\promise\models\Promise;
use app\modules\customer\models\Customers;
use app\modules\roundgarbage\models\Roundgarbage;
/**
 * Default controller for the `service` module
 */
class DefaultController extends Controller {
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex() {
		$data['promise'] = Promise::find()->where(['status' => '2'])->all();
		return $this->render('index',$data);
	}

	public function actionGetround(){
		$promiseId = Yii::$app->request->post('promiseid');
		$Promise = Promise::find()->where(['id' => $promiseId,'status' => '2'])->One();
		$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
		$RoundGarbage = Roundgarbage::find()->where(['promiseid' => $promiseId])->all();
		$str = "";
		$str .= "<b>ลูกค้า ".$Customer['company']."</b><br/>";
		foreach($RoundGarbage as $rs):
			if($rs['status'] == 0){
			$link = Yii::$app->urlManager->createUrl(['service/default/formsaveround','id' => $rs['id'],'promise' => $rs['promiseid'],'round' => $rs['round']]);
			$str .= "รอบที่ => ".$rs['round']." วันที่จัดเก็บ => ".$rs['datekeep']."  <a href='".$link."'><i class='fa fa-save'></i> บันทึกรายการ</a> "."<br/>";
			} else {
				$str .= "รอบที่ => ".$rs['round']." วันที่จัดเก็บ => ".$rs['datekeep']." <i class='fa fa-check'></i>"."<br/>";
			}
		endforeach;
		if($RoundGarbage){
			return $str;
		} else {
			return "ไม่มีรอบจัดเก็บ";
		}
		
	}

	public function actionFormsaveround($id,$promise,$round) {
		$Promise = Promise::find()->where(['id' => $promise,'status' => '2'])->One();
		$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
		$data['promise'] = $Promise;
		$data['customer'] = $Customer;
		$data['promiseid'] = $promise;
		$data['round'] = $round;
		$data['id'] = $id;
		return $this->render('formsaveround',$data);
	}

	public function actionSave(){
		$id = Yii::$app->request->post('id');
		$garbageover = Yii::$app->request->post('garbageover');
		$promiseid = Yii::$app->request->post('promiseid');
		$amount = Yii::$app->request->post('amount');

		//$Promise = Promise::find()->where(['id' => $promise,'status' => '2'])->One();
		
		$columns = array(
			"garbageover" => $garbageover,
			"keepby" => Yii::$app->user->id,
			"amount" => $amount,
			"status" => 1,
			"d_update" => date("Y-m-d H:i:s")
		);

		Yii::$app->db->createCommand()
			->update("roundgarbage",$columns,"id = '$id'")
			->execute();
	}

}
