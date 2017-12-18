<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\Joinwork;

$this->title = 'ประวัติการร่วมงาน';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 5px 5px rgba(50,50,50,.4);
} 

</style>

    <div class="panel panel-default">
              <div class="panel-body panel-body1 "><h3 class="text-center" ><img class="center" alt="" src="/img/logo.png" style="width:4%;  "> <?= Html::encode($this->title) ?></h3></div>
    </div>
<div class="form-group pull-right">
<?= Html::a('<span class= "glyphicon glyphicon-file"></span> ประกาศ+', ['/work/create'], ['title'=>'ประกาศงาน','class' => 'btn btn-info ']) ?> 
<?=Html::a(' <span class="glyphicon  glyphicon-inbox"></span> สมัคร '.($inbox==0?"":"+".$inbox),'/joinwork/inbox-of-radiologist',['class' => 'btn  btn-danger 	'])?> 
<?=Html::a('<span class="	glyphicon glyphicon-th-list"></span> อยู่ในการทำงาน','/joinwork/accept-of-radiologist',['class' => 'btn  btn-success'])?> 
<?=Html::a('<span class="	glyphicon glyphicon-list-alt"></span> รายชื่อผู้ร่วมงาน','/joinwork/success-of-radiologist',['class' => 'btn  btn-primary'])?> 
</div>
<?php Pjax::begin(['enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?>  

<?= GridView::widget([
                 	                'dataProvider' => $dataProvider,
                 	                'filterModel' => $searchModel,
                 	                'columns' => [
                 	                    ['class' => 'yii\grid\SerialColumn'],
                 	                    
                 	                    /*     'id',
                 	                     'comment:ntext',
                 	                     'point', */
                 	                    [
                 	                        'label'=>'ชื่อสำนักงาน',
                 	                        'attribute' => 'name_work',
                 	                        'value' => 'work.name_office'
                 	                    ],
                 	                    [
                 	                        'label' => 'ผู้ร่วมงาน',
                 	                        'attribute' => 'name_user',
                 	                        'value' => 'user.fullname'
                 	                    ],
                 	                    // 'status',
                 	                    [
                 	                        'attribute' => 'join_created_at',
                 	                        'label' => 'สมัครเมื่อ',
                 	                        'format' =>'datetime',
                 	                    ],
                 	                    [
                 	                        'attribute' => 'join_updated_at',
                 	                        'label' => 'สิ้นเสร็จ',
                 	                        'format' =>'datetime',
                 	                    ],
                 	                    [
                 	                        'attribute' => 'status',
                 	                        'format'=>'html',
                 	                        /*                  'filter'=>[
                 	                         Joinwork::STATUS_WAIT=>"รอการยืนยัน",
                 	                         Joinwork::STATUS_ACTION=>"อยู่ในการทำงาน",
                 	                         Joinwork::STATUS_SUCCESS=>"เสร็จสิ้น",
                 	                         ], */
                 	                        'value' => function ($model){
                 	                        if ($model->join_status == Joinwork::STATUS_WAIT ) {
                 	                            return '<span class="label label-warning">รอการยืนยัน</span>';
                 	                        }else if ($model->join_status == Joinwork::STATUS_ACTION){
                 	                            return '<span class="label label-success">อยู่ในการทำงาน</span>';
                 	                        }else return  '<span class="label label-danger">เสร็จสิ้น</span>';
                 	                        }
                 	                        ],
                 	                        // 'join_created_at',
                 	                        // 'join_updated_at',
                 	                        
                 	                        [
                 	                            'class' => 'yii\grid\ActionColumn',
                 	                            'template' => '{view} {accept} {delete}',
                 	                            'options'=> ['style'=>'width:100px;'],
                 	                            'buttons' => [
                 	                                'view' => function ($url, $model,$key) {
                 	                                
                 	                                return Html::a(' ','/work/view?id='.$model->work_id, [
                 	                                    'class'=>'btn btn-info     glyphicon glyphicon-eye-open',
                 	                                    'title'=>'ดูรายละเอียด'
                 	                                ]);
                 	                                },
                 	                                'accept' => function ($url, $model,$key){
                 	                                return Html::a('',['/joinwork/acceptjoin?id='.$model->id],[
                 	                                    'class' => 'btn btn-success  	glyphicon glyphicon-saved disabled',
                 	                                    'title' => 'รับสมัคร',
                 	                                    'data' => [
                 	                                        'confirm' => 'ยืนยันการรับสมัคร',
                 	                                        'method' => 'post',
                 	                                    ],
                 	                                ]);
                 	                                },
                 	                                
                 	                                'delete' => function ($url, $model,$key) {
                 	                                if ($model->join_status == 0){
                 	                                    return Html::a('', $url, [
                 	                                        'class'=>'btn btn-danger glyphicon glyphicon-trash',
                 	                                        'title'=>'ลบ',    
                 	                                        'data' => [
                 	                                            'confirm' => 'ยืนยันการลบ',
                 	                                            'method' => 'post',
                 	                                        ],
                 	                                    ]);
                 	                                }else {
                 	                                    return Html::a('', $url, [
                 	                                        'class'=>'btn btn-danger btn disabled glyphicon glyphicon-trash',
                 	                                        'data' => [
                 	                                            'title'=>'ลบ',
                 	                                            'confirm' => 'ยืนยันการลบ',
                 	                                            'method' => 'post',
                 	                                        ],
                 	                                    ]);
                 	                                }
                 	                                },
                 	                                
                 	                                ],
                 	                                ],
                 	                                ],
                 	                                ]);
?>
<?php Pjax::end(); ?>


