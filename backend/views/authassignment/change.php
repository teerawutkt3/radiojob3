<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */

$this->title = 'แก้ไขสิทธิ์การใช้งาน : ' . $model->user->fullname;
$this->params['breadcrumbs'][] = ['label' => 'จัดการสิทธิ์การใช้งาน', 'url' => ['/authassignment/index']];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="auth-assignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
