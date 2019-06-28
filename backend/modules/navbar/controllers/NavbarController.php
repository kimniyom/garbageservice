<?php

namespace app\modules\navbar\controllers;

use Yii;
use app\modules\navbar\models\Navbar;
use app\modules\navbar\models\NavbarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NavbarController implements the CRUD actions for Navbar model.
 */
class NavbarController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all Navbar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sql = "select * from navbar";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        $data['nav'] = $rs;

        return $this->render('index',$data);
    }

    /**
     * Displays a single Navbar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Navbar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Navbar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Navbar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Navbar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Navbar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Navbar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Navbar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSave(){
        $navbar = Yii::$app->request->post('navbar');
        $submenu = Yii::$app->request->post('submenu');
        $columns = array(
            "navbar" => $navbar,
            "submenu" => $submenu
        );

        Yii::$app->db->createCommand()
            ->insert("navbar",$columns)
            ->execute();

            $sql = "select max(id) as id from navbar ";
            $rs = Yii::$app->db->createCommand($sql)->queryOne();
            if($submenu <= 0){
                $menu = $rs['id'];
            } else {
                $menu = 0;
            }

            return $menu;
    }

    public function actionFormnav($id){
        $sql = "select * from navbar where id = '$id'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        $data['detail'] = $rs;
        return $this->render("formnav",$data);
    }

    public function actionSavepage(){
        $id = Yii::$app->request->post('id');
        $detail = Yii::$app->request->post('detail');
        $columns = array(
            "detail" => $detail
        );

        Yii::$app->db->createCommand()
            ->update("navbar",$columns,"id ='$id'")
            ->execute();
    }

    public function actionFormsubmenu($id){
        $data['id'] = $id;
        return $this->render("formsubmenu",$data);
    }

    public function actionSavepagesubmenu(){
        $navbar = Yii::$app->request->post('navbar');
        $detail = Yii::$app->request->post('detail');
        $subnavbar = Yii::$app->request->post('subnavbar');
        $columns = array(
            "navbar" => $navbar,
            "detail" => $detail,
            "subnavbar" => $subnavbar
        );

        Yii::$app->db->createCommand()
            ->insert("subnavbar",$columns)
            ->execute();

    }

    public function actionViewsubmenu($id){
        $sql = "select * from subnavbar where id = '$id'";
        $data['model'] = Yii::$app->db->createCommand($sql)->queryOne();
        return $this->render("viewsubmenu",$data);
    }

    public function actionUpdatenavbar(){
        $id = Yii::$app->request->post('id');
        $navbar = Yii::$app->request->post('navbar');
        $columns = array("navbar" => $navbar);
        Yii::$app->db->createCommand()
            ->update("navbar",$columns,"id = '$id'")
            ->execute();
    }

    public function actionDeletenavbar(){
        $id = Yii::$app->request->post('id');
        Yii::$app->db->createCommand()
            ->delete("navbar","id = '$id'")
            ->execute();
    }
}
