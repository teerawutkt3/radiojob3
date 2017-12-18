<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Belong */

$this->title = 'Update Belong: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Belongs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="belong-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
