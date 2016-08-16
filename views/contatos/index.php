<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Contatos;
use app\models\Grupos;
use app\models\ManyGrupos;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ContatosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contatos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contatos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nome',
            'telefone',
            
            
            //  [
            //      'label'=>'Grupos', 
            //      'value'=>$nomeGrupos
            //  ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    /*  'value' => function($model){
                            return implode(',' , ArrayHelper::map($model->fkmanygrupos, 'id', 'nome'));
                        } */
    ?>
</div>
