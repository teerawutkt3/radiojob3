<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Work */

$this->title = 'แก้ไข ';
$this->params['breadcrumbs'][] = ['label' => "id : ".$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'address' => $address,
    ]) ?>

</div>
