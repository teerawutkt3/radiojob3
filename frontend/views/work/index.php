<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use function GuzzleHttp\Psr7\str;
use common\models\Work;
use yii\helpers\ArrayHelper;
use common\models\Belong;
use kartik\alert\Alert;

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
    
    <?php
        if (isset($alert)){
            $data = Work::findOne($work_id);
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-danger',
                ],
                'body' => '<h3>เป็นเวลา 5 เดือนที่ประกาศของคุณไม่มีผู้สมัคร ต้องการลบหรือไม่ </h3>
                <a href="delete?id='.$data->id.'" data-confirm="ยืนยันการลบ" data-method="post"  class="btn btn-warning "> <span class="	glyphicon glyphicon-trash"></span> ตกลง</a>   
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"> <span class="	glyphicon glyphicon-list-alt"></span> ดูรายละเอียด</button>
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class=" text-danger modal-title"><p class="text-danger">ประกาศนานเกิน 5 เดือน ที่ไม่มีผู้สมัคร</p></h4>
                      </div>
                      <div class="modal-body">
                         <div class="row text-danger" >
                                										<div class="col-md-1"></div>
                                										<div class="col-md-10">
                                                                      		<h4 class="text-center"><span class="glyphicon glyphicon-home"></span> '.$data->name_office.'</h4>
                                                                    		<h5 class="text-center"><span class="glyphicon glyphicon-map-marker"></span> '.$data->address->province_name.'</h5>
                                                                    		<p class="text-center"><span class="glyphicon glyphicon-calendar"></span> ประกาศเมื่อ : วันที่ ' .Yii::$app->formatter->asDatetime($data->work_created_at,"d MMM yyyy kk:mm").'</p>
                                                                    		
                                                                    		
                                                                    		<p ><span class="glyphicon glyphicon-pushpin"></span> <b>หน่วยงาน  : </b>'.$data->belong.'</p>
                                                                    		<p ><span class="	glyphicon glyphicon-ok-sign"></span> <b>รับสมัครจำนวน  : </b>'.$data->number.'ตำแหน่ง</p>
                                                                                    		<b><span class="glyphicon glyphicon-list-alt"></span> รายละเอียด</b>
                                                                                    	
                                                                                    		<p>'. Yii::$app->formatter->asNtext($data->description).'</p>
                                                                                    		
                                                                                    		<br><p><span class="glyphicon glyphicon-time"></span><b> เวลาทำงาน : </b>'.Yii::$app->formatter->asTime($data->time_begin,"kk:mm").'
                                                                                    					ถึง '.Yii::$app->formatter->asTime($data->time_end,"kk:mm").'
                                                                                    		</p>
                                                                                    		<hr>
                                                                                    	
                                                                                    		
                                                                                    		<p><span class="glyphicon glyphicon-check"></span> <b> สวัสดิการ  </b></p>	
                                                                                    		<p>	 '. Yii::$app->formatter->asNtext($data->benefits).'</p>	
                                                                                    		<!-- <p><span class="glyphicon glyphicon-object-align-bottom"></span><b> คุณสมบัติ </b></p> -->
                                                                                    		
                                                                                    			<hr>
                                                                                    		<p><span class="glyphicon glyphicon-usd"></span> <b> รายได้ : </b>
                                                                                    				'. ($data->money2 ==NULL ? $data->money1: ($data->money1." - ".$data->money2))  .' บาท
                                                                                    		 </p>
                                                                                    		 <p><span class="glyphicon glyphicon-earphone"></span> <b>โทร : </b> '.$data->tel.'</p>
                                                                                    		 <p><span class="glyphicon glyphicon-map-marker"></span> <b>ที่ตั้ง : </b>'.$data->address->nameAddress.'</p>
                                                                                    
                                
                                                                   </div></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                      </div>
                    </div>
                
                  </div>
                </div>       <!--end Modal -->    
                 ',
            ]);
        }
  ?>

    <div class="form-group  pull-right">
   		 <?= Html::a('<span class= "glyphicon glyphicon-file"></span> ประกาศ+', ['location'], ['title'=>'ประกาศงาน','class' => 'btn btn-info ']) ?>
   		 <?=Html::a(' <span class="glyphicon  glyphicon-inbox"></span> inbox '.($inbox==0?"":"(".$inbox.")"),'/joinwork/inbox-of-radiologist',['class' => 'btn  btn-danger 	'])?> 
        <?=Html::a('<span class="	glyphicon glyphicon-th-list"></span> รับสมัครแล้ว','/joinwork/accept-of-radiologist',['class' => 'btn  btn-success'])?> 
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
