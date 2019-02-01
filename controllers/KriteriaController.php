<?php

namespace app\controllers;

use Yii;
use app\models\Kriteria;
use app\models\KriteriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Spk;
/**
 * KriteriaController implements the CRUD actions for Kriteria model.
 */
class KriteriaController extends Controller
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
     * Lists all Kriteria models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $model = new Kriteria();

        $searchModel = new KriteriaSearch();
        $dataProvider = $searchModel->search($id, Yii::$app->request->queryParams);

        $data_spk = Spk::find()->indexBy('id')->all();

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data_spk' => $data_spk,
            'id' => $id,
        ]);
    }

    /**
     * Creates a new Kriteria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kriteria();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            
            if ($model->save()) {
                $this->actionResetBobot($model->id_spk);
                return $this->redirect(['index', 'id' => $model->id_spk]);
            }

        }
    }

    /**
     * Deletes an existing Kriteria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            $this->actionResetBobot($model->id_spk);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Kriteria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kriteria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kriteria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetKriteria()
    {
        $post_data = Yii::$app->request->post();

        if (!empty($post_data['Kriteria'])) {
            
            foreach ($post_data['Kriteria'] as $key => $post) {
                $model = $this->findModel($key);
                $model->attributes = $post;

                if (!empty($post['bobot'])) {
                    $model->bobot = $post['bobot'] / 100;
                }
            
                $model->save();
            }

        }

        return $this->redirect(['index', 'id' => $model->id_spk]);
    }

    public function actionResetBobot($id)
    {
        $model = Kriteria::find()->where(['id_spk' => $id])->all();

        if ($model) {
            foreach ($model as $key => $kriteria) {
                $kriteria->bobot = 0;
                $kriteria->save();
            }
        }

        return $this->redirect(['index', 'id' => $kriteria->id_spk]);
    }
}
