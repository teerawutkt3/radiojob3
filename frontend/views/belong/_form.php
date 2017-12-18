<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\alert\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\Belong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="belong-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_belong')->textInput(['maxlength' => true,'placeholder'=>'รัฐบาล - เอกชน ...']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php // echo Html::a('ยกเลิก', '/work/create',['class' =>'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
