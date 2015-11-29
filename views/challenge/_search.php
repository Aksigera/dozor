<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChallengeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="challenge-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'time') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'hint1') ?>

    <?= $form->field($model, 'is_hint1_active') ?>

    <?php // echo $form->field($model, 'hint2') ?>

    <?php // echo $form->field($model, 'is_hint2_active') ?>

    <?php // echo $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'is_answer_activate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
