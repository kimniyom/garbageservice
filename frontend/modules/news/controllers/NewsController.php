<?php

namespace app\modules\news\controllers;

use Yii;
use yii\web\Controller;
use app\modules\news\models\News;

class NewsController extends Controller
{
    //public $layout = "template";
    public $layout = '@app/views/layouts/template';
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
        $newsAll = $Model::find()->where(['CATEGORY' => 1])->all();
        $gallery = $this->getGallery($id);
		return $this->render('view', [
			'datas' => $result,
            'news' => $newsAll,
            'gallery' => $gallery
		]);
	}

    public function getGallery($id){
        $sql = "select * from gallery where new_id = '$id'";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }
}
