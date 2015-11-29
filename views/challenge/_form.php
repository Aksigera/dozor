<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Challenge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="challenge-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hint1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_hint1_active')->textInput() ?>

    <?= $form->field($model, 'hint2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_hint2_active')->textInput() ?>

    <?= $form->field($model, 'answer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_answer_activate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
