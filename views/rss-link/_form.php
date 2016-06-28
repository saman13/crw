<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\rssLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rss-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rss_link')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'agency_id')->dropDownList($agency) ?>

    <?=  $form->field($model, 'category_id')->dropDownList($category) ?>

    <?=  $form->field($model, 'status')->dropDownList(['1'=>'active', '0'=>'deActive']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
