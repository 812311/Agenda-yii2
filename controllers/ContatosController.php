<?php

namespace app\controllers;

use Yii;
use app\models\Contatos;
use app\models\ContatosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Grupos;
use app\models\ManyGrupos;

/**
 * ContatosController implements the CRUD actions for Contatos model.
 */
class ContatosController extends Controller
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
    public function islogged(){
        if(Yii::$app->user->getIsGuest()){
            return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        }
    }
    /**
     * Lists all Contatos models.
     * @return mixed
     */
    public function actionIndex()
    {
        // if(Yii::$app->user->getIsGuest()){
        //     return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        // }
        islogged();
        $searchModel = new ContatosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contatos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // if(Yii::$app->user->getIsGuest()){
        //     return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        // }
        islogged();
        $model =$this->findModel($id);
        $nomegrupos=[];
        foreach ($model->manyGrupos as $manyG){
            $nomegrupos[]=$manyG->fkManygrupos['nome'];       
        }
        return $this->render('view', [
            'model' => $model,
            'nomeGrupos' => implode(' | ', $nomegrupos)
        ]);
    }

    /**
     * Creates a new Contatos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //  if(Yii::$app->user->getIsGuest()){
        //     return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        // }
        islogged();
        
        $model = new Contatos();
            //echo"<pre>";
            //var_dump($model->validate());
            //die($Grupos->id);
            //echo"<pre>";
           $model->fk_user=Yii::$app->user->id;
           
           $post=Yii::$app->request->post();

        if ($model->load($post)) {
            if($model->save()){
                if (!empty($post['Contatos']['fk_grupo'])){
                    foreach($post['Contatos']['fk_grupo'] as $grupo)
                    {
                        $manygrupos=new ManyGrupos();
                        $manygrupos->fk_contato=$model["id"];
                        $manygrupos->fk_manygrupos=$grupo;
                        $manygrupos->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } 
            

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Contatos model.
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
        $model->fk_user=Yii::$app->user->id;
        $post=Yii::$app->request->post();

        if ($model->load($post)) {
          if($model->save()){
              ManyGrupos::deleteAll(['fk_contato'=>$id]);
                if (!empty($post['Contatos']['fk_grupo'])){
                    foreach($post['Contatos']['fk_grupo'] as $grupo)
                    {
                        $manygrupos=new ManyGrupos();
                        $manygrupos->fk_contato=$model["id"];
                        $manygrupos->fk_manygrupos=$grupo;
                        $manygrupos->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contatos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         if(Yii::$app->user->getIsGuest()){
            return $this->redirect('/~philipe/YiiBasic/web/user-management/auth/login',302);
        }
        ManyGrupos::deleteAll(['fk_contato'=>$id]);
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Contatos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contatos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        
        if (($model = Contatos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
