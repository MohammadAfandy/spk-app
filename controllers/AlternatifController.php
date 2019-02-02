<?php

namespace app\controllers;

use Yii;
use app\models\Alternatif;
use app\models\AlternatifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Spk;
use yii\helpers\ArrayHelper;
/**
 * AlternatifController implements the CRUD actions for Alternatif model.
 */
class AlternatifController extends Controller
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
     * Lists all Alternatif models.
     * @param integer $id (id_spk)
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $searchModel = new AlternatifSearch();
        $dataProvider = $searchModel->search($id, Yii::$app->request->queryParams);

        $data_spk = Spk::find()->indexBy('id')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data_spk' => $data_spk,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Alternatif model.
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
     * Creates a new Alternatif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id (id_spk)
     * @return mixed
     */
    public function actionCreate($id)
    {
        if (!Spk::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = new Alternatif();

        $post_data = Yii::$app->request->post();

        if (!empty($post_data)) {
            $model->load($post_data);
            $model->id_spk = $id;
            
            if ($model->save()) {
                return $this->redirect(['index', 'id' => $id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    /**
     * Updates an existing Alternatif model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id (id_alternatif)
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_spk]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Alternatif model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Alternatif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alternatif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alternatif::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
