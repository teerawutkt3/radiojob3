<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Joinwork;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JoinworkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Joinworks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joinwork-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Joinwork', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        /*     'id',
            'comment:ntext',
            'point', */
            [
                'attribute' => 'name_work',
                'value' => 'work.name_office'
            ],
            [
                'attribute' => 'name_user',
                'value' => 'user.fullname'
            ],
           // 'status',
            [
                'attribute' => 'status',
                'format'=>'html',
              /*   'filter'=>[ 0=>"รอการยืนยัน",1=>"อยู่ในการทำงาน",2=>"เสร็จสิ้น"  ], */
                'value' => function ($model){
                if ($model->status == Joinwork::STATUS_WAIT ) {
                    return '<span class="label label-warning">รอการยืนยัน</span>';
                }else if ($model->status == Joinwork::STATUS_ACTION){
                    return '<span class="label label-success">อยู่ในการทำงาน</span>';
                }else return  '<span class="label label-danger">เสร็จสิ้น</span>';
                
                
                }
                ],
            // 'join_created_at',
            // 'join_updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
