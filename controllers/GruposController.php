<?php

namespace app\controllers;

use Yii;
use app\models\Grupos;
use app\models\GruposSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ManyGrupos;
use app\controllers\SiteController;

/**
 * GruposController implements the CRUD actions for Grupos model.
 */
class GruposController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Grupos models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->getIsGuest()){
            return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        }
        //$sitecontroller= new SiteController();
        //$sitecontroller->actionLogin();
        $searchModel = new GruposSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    /**
     * Displays a single Grupos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         if(Yii::$app->user->getIsGuest()){
            return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Grupos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if(Yii::$app->user->getIsGuest()){
            return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        }
        $model = new Grupos();
        
        $post=Yii::$app->request->post();

        if ($model->load($post) ) {
            
            $model->fk_grupouser=Yii::$app->user->id;
            if ($model->save()) return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Grupos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         if(Yii::$app->user->getIsGuest()){
            return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Grupos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         if(Yii::$app->user->getIsGuest()){
            return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        }
        // $contato = new ManyGrupos;
        // $contato = $contato->find("fk_grupo = :fk_grupo", array(":fk_grupo" => $id));
        
        // if(!isset($contato))
             $this->findModel($id)->delete();
    
        return $this->redirect(['index']);
    }

    /**
     * Finds the Grupos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Grupos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Grupos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
