<?php

namespace app\controllers;

use Yii;
use app\models\Penilaian;
use app\models\Kriteria;
use app\models\Spk;
use app\models\PenilaianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenilaianController implements the CRUD actions for Penilaian model.
 */
class PenilaianController extends Controller
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
     * Lists all Penilaian models.
     * @param integer $id (id_spk)
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        if ($id != null && !Spk::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $penilaian = Penilaian::find()->alias('p')->where(['p.id_spk' => $id])->joinWith(['alternatif'])->all();
        $kriteria = Kriteria::find()->where(['id_spk' => $id])->all();

        $nilai = [];

        foreach ($penilaian as $key => $pen) {
            $nilai[$pen->id] = json_decode($pen->penilaian, true);
        }

        $data_spk = Spk::find()->indexBy('id')->all();

        return $this->render('index', [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'nilai' => $nilai,
            'data_spk' => $data_spk,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Penilaian model.
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
     * Creates a new Penilaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id (id_spk)
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        if ($id != null && !Spk::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = new Penilaian();
        $alternatif = $model->cekAlternatif($id);
        $kriteria = Kriteria::find()->where(['id_spk' => $id])->all();

        $post_data = Yii::$app->request->post();

        if (!empty($post_data)) {
            $post_nilai = $this->cekPenilaianKriteria($post_data['Penilaian']['penilaian']);
            
            if ($post_nilai) {
                $model->load($post_data);
                $model->id_spk = $id;
                $model->penilaian = json_encode($post_nilai);                
                
                if ($model->save()) {
                    return $this->redirect(['index', 'id' => $id]);
                }
            } else {
                Yii::$app->session->setFlash('failed', "Penilaian Kriteria Tidak Boleh Kosong");
            }
        }

        return $this->render('create', [
            'model' => $model,
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'id' => $id,
        ]);
    }

    /**
     * Updates an existing Penilaian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id (id_penilaian)
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $alternatif = $model->cekAlternatif($id);
        $kriteria = Kriteria::find()->where(['id_spk' => $model->id_spk])->all();

        $nilai = json_decode($model->penilaian, true);

        $post_data = Yii::$app->request->post();

        if (!empty($post_data)) {
            $post_nilai = $this->cekPenilaianKriteria($post_data['Penilaian']['penilaian']);
            
            if ($post_nilai) {
                $model->load($post_data);
                $model->penilaian = json_encode($post_nilai);
            
                if ($model->save()) {
                    return $this->redirect(['index', 'id' => $model->id_spk]);
                }
            } else {
                Yii::$app->session->setFlash('failed', "Penilaian Kriteria Tidak Boleh Kosong");
            }
        }

        return $this->render('update', [
            'model' => $model,
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'nilai' => $nilai,
            'id' => $id,
        ]);
    }

    /**
     * Deletes an existing Penilaian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id (id_penilaian)
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_spk = $model->id_spk;
        $model->delete();

        return $this->redirect(['index', 'id' => $id_spk]);
    }

    /**
     * Finds the Penilaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penilaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penilaian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function cekPenilaianKriteria($penilaian)
    {
        foreach ($penilaian as $key => $pen) {
            if (empty($pen) || !is_numeric($pen)) {
                return false;
            }
        }

        return $penilaian;
    }
}
