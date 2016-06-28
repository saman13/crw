<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\rssLink */

$this->title = 'Create Rss Link';
$this->params['breadcrumbs'][] = ['label' => 'Rss Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rss-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'agency' => $agency
    ]) ?>

</div>
