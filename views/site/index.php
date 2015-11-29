<?php

/* @var $this yii\web\View */
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var string $startTime время старта*/
/* @var string $levelTime время на уравне*/
/* @var string $nextActionTime время до след действия*/
/* @var $model app\models\Challenge */
// http://classic.dzzzr.ru/krasnodar/?section=faq&what=7
$model->answer = '';
?>
<div class='timer--countdown'><?= $nextActionTime ?></div>
<div></div>
<div>Задание <?=$model->id?> (получено <?= $startTime; ?>) найдено кодов: <?= $model->code_count; ?>
    из <?= $model->code_available; ?></div>
<div><?= $model->text; ?></div>
<? if ($model->is_hint1_active): ?>
    <div>Подсказака1:</div>
    <div><?= $model->hint1; ?></div>
<? endif; ?>
<? if ($model->is_hint2_active): ?>
    <div>Подсказака2:</div>
    <div><?= $model->hint2; ?></div>
<? endif; ?>
<div>Время на уравне: <?= $levelTime ?> (yf vjvtyn)</div>
<div>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'answer')->textInput(['class' => 'input'])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('отправить код', ['class' => 'btn_input']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
Ответ:
<div>
    <?if($model->is_answer_activate == 1):?>
        <img src="<?=$model->map_url?>">
    <?endif;?>
</div>
Лог игры:
<?= GridView::widget([
    'dataProvider' => new ActiveDataProvider([
        'query' => \app\models\Log::find()->where(['challenge_id' => $model->id])->orderBy('id DESC'),
    ]),
    'layout'=>"{items}",
    'columns' => [
        'time',
        'text',
        'answer',
    ],
]); ?>

