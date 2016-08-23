<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\Growl;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GruposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Grupos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nome',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    
    ?>
    <?php if(Yii::$app->session->hasFlash('info')): ?>

    <div class="success">
    <?php echo Yii::$app->session->getFlash('info'); ?>
    </div>

    <?php endif; ?>

    <!--<?= Yii::$app->session->getFlash('info'); ?>-->
</div>
