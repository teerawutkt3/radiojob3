<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Html;
use wattanapong\datetime\DateTimePicker;


$this->title = 'ผู้ใช้งานทั้งหมด';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.panel-body1 {
background: 	#006363	;
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 
}
</style>
<div class="user-index">
    <div class="panel panel-default">
         <div class="panel-body panel-body1">
            <a href="../user/user-total" class="btn btn-default" >ทั้งหมด</a>	
        	<a href="../user/user-radiologist" class="btn btn-info" >นักรังสีเทคนิค</a>
        	<a href="../user/user-public_relations" class="btn btn-primary" >ผู้ประกาศ</a>
		</div>
    </div> <!-- end panel -->
    <?php Pjax::begin(['enablePushState'=>false // ปิดเพื่อให้ tatget="_blank" ทำงาน
]);  ?> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'username',
//             [
//                 'attribute' => 'fname',
//                 'value'=>function($model){
//                 return $model->fname.' '.$model->lname;
//                 }
//                 ],
            'fname',
            'lname',
           // 'fb_id',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'status',
            // 'address_id',
            [
                'attribute' =>'created_at',
                'format' => 'html',
                'value' => function($model, $key, $index, $widget) {
                return Yii::$app->formatter->asDatetime($model->created_at,"medium");
                },
                'filter' => DateTimePicker::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                        //'value' => $searchModel->created_at,
                        'value' => Yii::$app->formatter->asDatetime($searchModel->created_at,"medium"),
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
                    [
                        'attribute' =>'updated_at',
                        'format' => 'html',
                        'value' => function($model, $key, $index, $widget) {
                        return Yii::$app->formatter->asDatetime($model->updated_at,"medium");
                        },
                        'filter' => DateTimePicker::widget(
                            [
                                'model' => $searchModel,
                                'attribute' => 'updated_at',
                                //'value' => $searchModel->created_at,
                                'value' => Yii::$app->formatter->asDatetime($searchModel->updated_at,"medium"),
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

        //     'created_at:datetime',
         //   'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
            //    'options'=>['style'=>'width:120px;'],
                'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}</div>',
                'buttons'=>[
                    'view'=>function($url,$model,$key){
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>','../user/user-view?id='.$model->id,['class'=>'btn btn-default']);
                    },
                 ]
              ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
