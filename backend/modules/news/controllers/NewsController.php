<?php

namespace app\modules\news\controllers;

use app\modules\news\models\News;
use app\modules\news\models\NewsSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public $enableCsrfValidation = false;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $Model = new News();
        $result = $Model->getDetail($id);
        return $this->render('view', [
                    'datas' => $result,
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
            $model->CREATEBY = Yii::$app->user->identity->id;
            $model->CREATEAT = date("Y-m-d H:i:s");
            $model->UPDATEAT = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->UPDATEBY = Yii::$app->user->identity->id;
            $model->UPDATEAT = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionGallery($id) {
        //$targetFolder = Yii::$app->request->baseUrl . '/uploads/news/gallery'; // Relative to the root
        $targetFolder = str_replace("backend/", "", Yii::$app->request->baseUrl . '/uploads/news/gallery');
        if (!empty($_FILES)) {

            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "img_" . $this->Randstrgen() . "." . $type;
            $targetFile = $targetPath . '/' . $Name;

            $fileTypes = array('jpg', 'jpeg', 'JPG', 'JPEG'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {

                //สั่งอัพเดท
                $columns = array(
                    "images" => $Name,
                    "new_id" => $id,
                );

                Yii::$app->db->createCommand()
                        ->insert("gallery", $columns)
                        ->execute();

                $width = 1600;
                $size = getimagesize($_FILES['Filedata']['tmp_name']);
                $height = round($width * $size[1] / $size[0]);

                $images_orig = imagecreatefromjpeg($tempFile);

                $photoX = imagesx($images_orig);
                $photoY = imagesy($images_orig);

                $images_fin = imagecreatetruecolor($width, $height);
                imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);

                imagejpeg($images_fin, "../uploads/news/gallery/" . $Name);

                imagedestroy($images_orig);
                imagedestroy($images_fin);

                $this->ThumbnailGallery($Name, 200, 200);
                $this->ThumbnailGallery($Name, 360, 360);
            }
        }
    }

    public function ThumbnailGallery($Name, $width, $height) {
        $targetFolder = str_replace("backend/", "", Yii::$app->request->baseUrl . '/uploads/news/gallery');
        Image::thumbnail('../uploads/news/gallery/' . $Name, $width, $height)
                ->save('../uploads/news/gallery/' . $width . '-' . $Name, ['quality' => 80]);
    }

    public function Randstrgen() {
        $len = 30;
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

    public function actionGetgallery() {
        $id = Yii::$app->request->post('new_id');
        $sql = "select * from gallery where new_id = '$id'";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $data['link'] = str_replace("backend/", "", Yii::$app->request->baseUrl . '/uploads/news/gallery');
        $data['gallery'] = $result;
        return $this->renderPartial('gallery', $data);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $sql = "select * from gallery where new_id = '$id'";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        //ลบรูป
        foreach ($result as $rs) {
            if (file_exists('../uploads/news/gallery/' . $rs['images'])) {
                unlink('../uploads/news/gallery/' . $rs['images']);
                unlink('../uploads/news/gallery/200-' . $rs['images']);
                unlink('../uploads/news/gallery/360-' . $rs['images']);
            }
        }

        Yii::$app->db->createCommand()
                ->delete("gallery", "new_id='$id'")
                ->execute();

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
