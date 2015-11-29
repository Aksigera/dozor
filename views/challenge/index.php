<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChallengeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Challenges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challenge-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Challenge', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'time',
            'text',
            'hint1',
            'is_hint1_active',
            // 'hint2',
            // 'is_hint2_active',
            // 'answer',
            // 'is_answer_activate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
