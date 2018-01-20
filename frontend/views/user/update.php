<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'แก้ไข : ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="user-update">

    <h1>แก้ไข : <?= (!$model->fullname?"":$model->fullname) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'address' => $address,
        'user_extention'=>$user_extention,
    ]) ?>

</div>
