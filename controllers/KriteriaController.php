<?php

namespace app\controllers;

use Yii;
use app\models\Kriteria;
use app\models\KriteriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Spk;
use app\models\Penilaian;
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
     * @param integer $id (id_spk)
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        if ($id != null && !Spk::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

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
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @param int $id (id_spk)
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        if ($id != null && !Spk::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = new Kriteria();

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            $model->id_spk = $id;
            
            if ($model->save()) {
                $this->resetBobot($model->id_spk);
                return $this->redirect(['index', 'id' => $model->id_spk]);
            }

        }

        return $this->renderAjax('modal/_create', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    /**
     * Deletes an existing Kriteria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id (id_kriteria)
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $id_spk = $model->id_spk;


        if ($model->delete()) {
            $this->resetBobot($id_spk);
            $this->deletePenilaian($model->id, $model->id_spk);
        }

        return $this->redirect(['index', 'id' => $id_spk]);
    }

     /**
     * Tambah Crips Untuk Setiap Kriteria.
     * @param integer $id (id_kriteria)
     * @return mixed
     */
    public function actionCrips($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);
        $post_data = Yii::$app->request->post();

        if ($post_data) {

            if (!empty($post_data['Crips'])) {
                $crips = [];
                foreach ($post_data['Crips'] as $key => $post_crips) {
                    $crips[trim($post_crips['nama_crips'])] = $post_crips['nilai_crips'];
                }

                if (!empty($crips)) {
                    $model->crips = json_encode(array_map('strval', $crips));
                    $model->save();
                }
            } else {
                $model->crips = '';
                $model->save();
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('modal/_crips', [
            'model' => $model,
            'id' => $id,
        ]);
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

                if (!empty($post['bobot']) && $post_data['jenis_bobot'] == SPK::BOBOT_PERSEN) {
                    $model->bobot = $post['bobot'] / 100;
                }
            
                $model->save();
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionResetBobot($id)
    {
        $this->resetBobot($id);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function resetBobot($id_spk)
    {
        $model = Kriteria::find()->where(['id_spk' => $id_spk])->all();

        if (!empty($model)) {
            foreach ($model as $key => $kriteria) {
                $kriteria->bobot = 0;
                $kriteria->save();
            }
            return true;
        }

        return false;
    }

    public function deletePenilaian($id_kriteria, $id_spk)
    {
        $penilaian = Penilaian::find()->where(['id_spk' => $id_spk])->all();

        if (!empty($penilaian)) {

            if (Kriteria::find()->where(['id_spk' => $id_spk])->all()) {
                foreach ($penilaian as $key => $pen) {

                    if (!empty($pen->penilaian)) {
                        $nilai = json_decode($pen->penilaian, true);

                        if (array_key_exists($id_kriteria, $nilai)) {
                            unset($nilai[$id_kriteria]);
                            $pen->penilaian = json_encode($nilai);
                            $pen->save();
                        }
                    }

                }
                return true;
            } else {
                foreach ($penilaian as $pen) {
                    $pen->delete();
                }
                return true;
            }
        }
        
        return false;
    }
}
