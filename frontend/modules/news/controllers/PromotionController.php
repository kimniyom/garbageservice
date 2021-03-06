<?php

namespace app\modules\news\controllers;

use Yii;
use yii\web\Controller;
use app\modules\news\models\News;

class PromotionController extends Controller
{
    public function actionIndex()
    {
        $model = new News();
        return $this->render('index',[
            'model'=>$model::find()->where(['CATEGORY' => 1])->all(),
        ]);
    }

    public function actionView($id) {
		$Model = new News();
		$result = $Model->getDetail($id);
		return $this->render('view', [
			'datas' => $result,
		]);
	}

}
