<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Joinwork */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Joinworks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joinwork-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'comment:ntext',
            'point',
            'work_id',
            'user_id',
            'status',
            'join_created_at',
            'join_updated_at',
        ],
    ]) ?>

</div>
