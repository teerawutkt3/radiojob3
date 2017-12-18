<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

	<div class="col-md-4">
	<?= $form->field($model, 'item_name')->dropDownList(
                       ArrayHelper::map(AuthItem::find()->all(), 'name', 'description')
        ) ?>
	</div><br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
