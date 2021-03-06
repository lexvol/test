<?php

namespace app\controllers;

use app\models\Dependency;
use app\models\Staff;
use app\models\StaffSearch;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Staff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Staff model.
     * @param int $id ID
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
     * Creates a new Staff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Staff();
        $model_dependency = new Dependency();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()
                && $post = $this->request->post('Dependency')['id_department']) {
                foreach ($post as $item) {
                    $model_dependency = new Dependency();
                    $model_dependency->id_department = $item;
                    $model_dependency->id_staff = $model->id;
                    $model_dependency->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
            return $this->render('create', [
                'model' => $model,
                'model_dependency' => $model_dependency,

            ]);

    }

    /**
     * Updates an existing Staff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_dependency = new Dependency();
        $selection = [];
        $department_list = Dependency::find()->where(['id_staff' => $id])->all();
        foreach ($department_list as $item){
            $selection[] = $item['id_department'];
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())
                && $post = $this->request->post('Dependency')['id_department']) {

                $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $model->save();
                        $new_entry = array_diff($post, $selection);
                        if ($new_entry) {
                            foreach ($new_entry as $item) {
                                $model_dependency = new Dependency();
                                $model_dependency->id_staff = $model->id;
                                $model_dependency->id_department = $item;
                                $model_dependency->save();
                            }
                        }
                        $old_entry = array_diff($selection, $post);
                        if ($old_entry) {
                            foreach ($old_entry as $item) {
                                $model_dependency = Dependency::find()
                                    ->where(['id_staff' => $model->id, 'id_department' => $item])
                                    ->one();
                                $model_dependency->delete();
                            }
                        }
                        $transaction->commit();
                    }
                    catch (Exception $e){
                        $transaction->rollBack();
                    }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'model_dependency' => $model_dependency,
            'selection' => $selection,
        ]);
    }

    /**
     * Deletes an existing Staff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('delete', '???????????????????? ????????????!');
        }
        catch (Exception $e) {
            Yii::$app->session->setFlash('not_delete', '?????????????????? ???? ????????????!');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Staff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Staff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
