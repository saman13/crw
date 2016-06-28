<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rss Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rss-link-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rss Link', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'rss_link',
            'category_id',
            'agency_id',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
