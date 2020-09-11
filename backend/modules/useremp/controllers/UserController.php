<?php

namespace app\modules\useremp\controllers;

use Yii;
use app\modules\useremp\models\User;
use app\modules\useremp\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    /**
     * {@inheritdoc}
     */
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $sql = "select u.*,p.*,d.department AS departmentname
                    from user u inner join profile p on u.id = p.user_id
                    INNER JOIN department d ON p.department = d.id
                    where status = 'A'";
        $data['users'] = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('index', $data);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        //$model = new User();
        $data['department'] = $this->getDepartment();
        return $this->render('create', $data);
    }

    function getDepartment() {
        return Yii::$app->db->createCommand("select * from department")->queryAll();
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $sql = "select u.*,p.*,d.department AS departmentname
                    from user u inner join profile p on u.id = p.user_id
                    INNER JOIN department d ON p.department = d.id
                    where u.id = '$id'";
        $data['model'] = Yii::$app->db->createCommand($sql)->queryOne();
        $data['department'] = $this->getDepartment();
        return $this->render('update', $data);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSave() {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $name = Yii::$app->request->post('name');
        $tel = Yii::$app->request->post('tel');
        $department = Yii::$app->request->post('department');
        $email = Yii::$app->request->post('email');
        $sql = "select IFNULL(count(*),0) as total from user where username = '$username' ";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        if ($rs['total'] > 0) {
            echo 1;
        } else {
            $columns = array(
                "email" => $email,
                "username" => $username,
                "password_hash" => password_hash($password, PASSWORD_DEFAULT),
                "status" => "A"
            );
            $rs = Yii::$app->db->createCommand()
                    ->insert("user", $columns)
                    ->execute();
            if ($rs) {
                $sqlNewId = "select max(id) as maxid from user";
                $userId = Yii::$app->db->createCommand($sqlNewId)->queryOne()['maxid'];
                $columnsProfile = array(
                    "name" => $name,
                    "tel" => $tel,
                    "department" => $department,
                    "user_id" => $userId
                );
                $result = Yii::$app->db->createCommand()
                        ->insert("profile", $columnsProfile)
                        ->execute();
                if ($result) {
                    echo 0;
                }
            }
        }
    }

}
