<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Joinwork */

$this->title = 'Create Joinwork';
$this->params['breadcrumbs'][] = ['label' => 'Joinworks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joinwork-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
