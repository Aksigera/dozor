<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Challenge */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Challenges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'time',
            'text',
            'hint1',
            'is_hint1_active',
            'hint2',
            'is_hint2_active',
            'answer',
            'is_answer_activate',
        ],
    ]) ?>

</div>
