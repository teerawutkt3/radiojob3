<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WorkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_office') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'belong') ?>

    <?= $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'benefits') ?>

    <?php // echo $form->field($model, 'money1') ?>

    <?php // echo $form->field($model, 'money2') ?>

    <?php // echo $form->field($model, 'time_begin') ?>

    <?php // echo $form->field($model, 'time_end') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'work_user_id') ?>

    <?php // echo $form->field($model, 'work_created_at') ?>

    <?php // echo $form->field($model, 'work_status') ?>

    <?php // echo $form->field($model, 'work_address_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
