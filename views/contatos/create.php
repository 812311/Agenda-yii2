<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contatos */

$this->title = 'Create Contatos';
$this->params['breadcrumbs'][] = ['label' => 'Contatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contatos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
