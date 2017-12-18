<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'ส่งข้อความ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['placeholder'=>'เรื่อง','rows' => 15]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'ส่ง <span class="	glyphicon glyphicon-ok"></span>' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success ' : 'btn btn-primary']) ?>
   		<?=Html::a('ยกเลิก','/work/work-search-radiologist',['class'=>'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
