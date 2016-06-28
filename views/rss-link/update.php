<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\rssLink */

$this->title = 'Update Rss Link: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rss Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rss-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'agency' => $agency
    ]) ?>

</div>
