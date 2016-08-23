<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
    
    <?//===================POP UP Warning=========?>
    
    <?php if(Yii::$app->session->hasFlash('info')): ?>

    <script language="javascript">
    <?php echo 'alert("'.Yii::$app->session->getFlash('info').'")'; ?>
    </script>

    <?php endif; ?>

</div>
