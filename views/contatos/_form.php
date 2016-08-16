<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Grupos;

/* @var $this yii\web\View */
/* @var $model app\models\Contatos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contatos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone')->textInput() ?>

   <!-- <?= $form->field($model, 'fk_user')->textInput() ?> -->

    <?= Html::dropDownList('Contatos[fk_grupo]','',
        ArrayHelper::map( Grupos::findAll(['fk_grupouser'=>Yii::$app->user->id]),'id','nome'), 
        ['prompt'=>Yii::t('app','Selecionar grupo'), 'multiple' => 'multiple']) ?> 
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
