<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use function GuzzleHttp\Psr7\str;
use common\models\Work;
use yii\helpers\ArrayHelper;
use common\models\Belong;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประกาศทั้งหมด';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 5px 5px rgba(50,50,50,.4);
} 

</style>
<div class="work-index">
    <div class="panel panel-default">
              <div class="panel-body panel-body1 "><h3 class="text-center" ><img class="center" alt="" src="/img/logo.png" style="width:4%;  "> <?= Html::encode($this->title) ?></h3></div>
    </div>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="form-group  pull-right">
   		 <?= Html::a('<span class= "glyphicon glyphicon-file"></span> ประกาศ+', ['create'], ['title'=>'ประกาศงาน','class' => 'btn btn-info ']) ?>
   		 <?=Html::a(' <span class="glyphicon  glyphicon-inbox"></span> inbox '.($inbox==0?"":"+".$inbox),'/joinwork/inbox-of-radiologist',['class' => 'btn  btn-danger 	'])?> 
        <?=Html::a('<span class="	glyphicon glyphicon-th-list"></span> อยู่ในการทำงาน','/joinwork/accept-of-radiologist',['class' => 'btn  btn-success'])?> 
        <?=Html::a('<span class="	glyphicon glyphicon-list-alt"></span> รายชื่อผู้ร่วมงาน','/joinwork/success-of-radiologist',['class' => 'btn  btn-primary'])?>          		
    </div>


    <?php Pjax::begin(['enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?>   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'name_office',
       //     'description:ntext',
            [
                'attribute' => 'description',
                'format'=>'ntext',
                'value'=>function ($model){
                                     $str = $model->description ;
                                             if (strlen($str) > 63){
                                                 return (substr("$str", 0, 63)."...");
                                             }else return $model->description;
                }
            ],
//             [
//                 'attribute' => 'nameSearch',
//                 'value' => 'user.fname'
//             ],
//             [
//                 'attribute' => 'province_name',
//                 'value' => 'address.province_name'
//             ],
          //  'belong',
            [
                'attribute' => 'belong',
                'filter'=>ArrayHelper::map(Belong::find()->all(), 'name_belong', 'name_belong'),
            ],
//             [
//                 'attribute' => 'education',
//                 'filter'=>ArrayHelper::map(Work::find()->all(), 'education', 'education'),	
//             ],
           // 'number',
         
            // 'benefits:ntext',
         //    'money1',
             [
                 'attribute' =>'money1',
                 'value' => function ($model){
                    return  ($model->money1 ==null ? 'ไม่ได้ระบุ' : $model->money1);
                 }
             ],
             [
                 'attribute' =>'money2',
                 'value' => function ($model){
                 return  ($model->money2 ==null ? 'ไม่ได้ระบุ' : $model->money2);
                 }
                 ],
            // 'time_begin:time',
            // 'time_end:time',
            // 'tel',
            // 'work_user_id',

            [
                'attribute' =>'work_created_at',
                'format' => 'html',
                'value' => function($model, $key, $index, $widget) {
                return Yii::$app->formatter->asDatetime($model->work_created_at,"d MMM yyyy kk:mm");
                },
                'filter' => \wattanapong\datetime\DateTimePicker::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'work_created_at',
                        //'value' => $searchModel->created_at,
                        'value' => Yii::$app->formatter->asDatetime($searchModel->work_created_at,"d MMM yyyy kk:mm"),
                        'language' => 'th',
                        'dateFormat' => 'dd M yyyy',
                        'timeFormat' => 'h:m',
                        'options' => [
                            'autoclose' => true,
                            'class' => 'form-control',
                            'placeholder'=>'วันที่'
                        ],
                    ]
                    )
                    ], 
            // 'work_created_at',
             
             [
                 'attribute' => 'work_status',
                 'format'=>'html',
                 'filter'=>[ 1=>"รับสมัคร",0=>"ปิดรับสมัคร"  ],
                 'value' => function ($model){
                             if ($model->work_status == Work::STATUS_ACTIVE) {
                                return '<h4><span class="label label-success">รับสมัคร</span></h4>';
                             }else return '<h4><span class="label label-danger">ปิดรับสมัคร</span></h4>';
                 }
             ],
            // 'work_address_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model,$key) {
                    
                    return Html::a('<span class="glyphicon glyphicon-eye-open "> </span> ','/work/'.$model->id, [
                        'class'=>'btn btn-info',
                        'title'=>'ดูรายละเอียด'
                    ]);
                    },
                    'update' => function ($url, $model,$key) {
                            if ($model->work_status == Work::STATUS_ACTIVE){
                                return Html::a('<span class="glyphicon glyphicon-edit"> </span>','/work/update?id='.$model->id, [
                                    'class'=>'btn btn-warning',
                                    'title'=>'แก้ไข'
                                ]);
                            }else{
                                return Html::a('<span class="glyphicon glyphicon-edit"> </span>','/work/update?id='.$model->id, [
                                    'class'=>'btn btn-warning disabled',
                                    'title'=>'แก้ไข'
                                ]);
                                }

                    },
                    
                    
                    'delete' => function ($url, $model,$key) {
                        if ($model->work_status == Work::STATUS_ACTIVE){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'class'=>'btn btn-danger',
                                'data' => [
                                    'confirm' => 'ยืนยันการลบ',
                                    'method' => 'post',
                                ],
                            ]);
                            
                        }else {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'class'=>'btn btn-danger disabled',
                                'data' => [
                                    'confirm' => 'ยืนยันการลบ',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    },
                    
                    ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
