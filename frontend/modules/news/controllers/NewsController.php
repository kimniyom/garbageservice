<?php

namespace app\modules\news\controllers;

use app\modules\news\models\News;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class NewsController extends Controller {
	//public $layout = "template";
	public $layout = '@app/views/layouts/template';
	public function actionIndex() {
		$model = new News();
		return $this->render('index', [
			'model' => $model::find()->where(['CATEGORY' => 1])->all(),
		]);
	}

	public function actionView($id) {
		$Model = new News();
		$result = $Model->getDetail($id);

		$newsAll = $Model::find()->where("CATEGORY = 1 and id != '$id'")
					->orderBy(['id' => SORT_DESC])
					->limit(3)
					->all();
		$gallery = $this->getGallery($id);
		return $this->render('view', [
			'datas' => $result,
			'news' => $newsAll,
			'gallery' => $gallery,
		]);
	}

	public function getGallery($id) {
		$sql = "select * from gallery where new_id = '$id'";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		return $result;
	}

	public function actionAlls($category = null) {
		$Model = new News();
		if (empty($category)) {
			$title = "ทั้งหมด";
		} else {
			$rs = $Model->getCategory($category);
			$title = $rs['name'];
		}
		$data['category'] = $title;
		$data['news'] = $Model->getNewsAll($category);
		return $this->render('all', $data);
	}

	public function actionAll($category = null) {
		$Model = new News();
		if (empty($category)) {
			$title = "ทั้งหมด";
			$query = News::find()->where(['ISSHOW' => 1]);
		} else {
			$rs = $Model->getCategory($category);
			$title = $rs['name'];
			$query = News::find()->where(['CATEGORY' => $category, 'ISSHOW' => 1]);
		}
		$data['category'] = $title;
		$count = $query->count();
		//$countQuery = clone $query;
		$data['pages'] = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
		$data['news'] = $query->offset($data['pages']->offset)
			->limit($data['pages']->limit)
			->all();

		return $this->render('all', $data);
	}

}
