<?php

/* @var $this yii\web\View */
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var string $startTime время старта */
/* @var string $levelTime время на уровне */
/* @var string $nextActionTime время до след действия */
/* @var $model app\models\Challenge */
// http://classic.dzzzr.ru/krasnodar/?section=faq&what=7
$model->answer = '';
?>
<div class="wrapper">
    <div class='timer--countdown'><?= $nextActionTime ?></div>
    <div class='timer--seconds'><?= $nextActionSeconds ?></div>
    <div class="clear"></div>

    <div></div>
    <div class="challenge__header">Задание <?= $model->id ?> (получено <?= $startTime; ?>) найдено кодов: <?= $model->code_count; ?>
        из <?= $model->code_available; ?></div>
    <div class="challenge__text"><?= $model->text; ?></div>
    <? if ($model->is_hint1_active): ?>
        <div class="hint__header">Подсказка 1:</div>
        <div class="hint__text"><?= $model->hint1; ?></div>
    <? endif; ?>
    <? if ($model->is_hint2_active): ?>
        <div class="hint__header">Подсказка 2:</div>
        <div class="hint__text"><?= $model->hint2; ?></div>
    <? endif; ?>
    <div class="timer--level">Время на уровне: <?= $levelTime ?> (на момент обновления страницы)</div>
    <div class='form--answer'>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'answer')->textInput(['class' => 'input'])->label('') ?>

        <div class="form-group">
            <?= Html::submitButton('отправить код', ['class' => 'button--submit']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="answer__header">Ответ:</div>
    <div>
        <? if ($model->is_answer_activate == 1): ?>
            <img src="<?= $model->map_url ?>">
        <? endif; ?>
    </div>
    <div class="log__header">Лог игры:</div>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => \app\models\Log::find()->where(['challenge_id' => $model->id])->orderBy('id DESC'),
        ]),
        'layout' => "{items}",
        'columns' => [
            'time',
            'text',
            'answer',
        ],
    ]); ?></div>

