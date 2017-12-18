<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['placeholder'=>'เรื่อง']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 10,'placeholder'=>'รายละเอียด']) ?>

    <?php $form->field($model, 'user_id')->hiddenInput() ?>

    <?php $form->field($model, 'contact_created_at')->hiddenInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'ส่ง <span class="	glyphicon glyphicon-ok"></span>' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success ' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
