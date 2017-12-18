<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use kartik\form\ActiveForm;

$this->title = 'กิจกรรมของ : '.Yii::$app->user->identity->fname.' '.Yii::$app->user->identity->lname;
$this->params['breadcrumbs'][] = $this->title;

$events = array();
//Testing
foreach ($data_event as $data){
  
$Event = new \yii2fullcalendar\models\Event();
$Event->id = 1;
$Event->title = $data->description;
$Event->start = date('Y-m-d\TH:i:s\Z',strtotime( Yii::$app->formatter->asDatetime($data->calendar_created_at,'Y-M-d kk:mm')));
if ($data->calendar_created_at < time()){
    $Event->color = 'red';
}else {
    
}
//$Event->start = date(Yii::$app->formatter->asDatetime($data->calendar_created_at));
$events[] = $Event;
}
?>
  <?php $form = ActiveForm::begin(); ?>
  	<div class="row">
  		<div class="col-md-8">
  		<?= $form->field($calendar, 'description')->textarea(['rows' => '3','placeholder'=>'กรอกรายละเอียด']) ?>
  		</div>
  		<div class="col-md-3">
  		 <?= $form->field($calendar, 'calendar_created_at')->widget(DateTimePicker::classname(), [
            	'options' => ['placeholder' => 'วัน - เวลา   กิจกรรม'],
            	'pluginOptions' => [
            		'autoclose' => true,
            	    'format' => ' d-m-yyyy H:i'
            	]
            ]);?>
  		</div>
  		<div class="col-md-1"><br>
  		<div class="form-group">
                <?= Html::submitButton('<span class="	glyphicon glyphicon-floppy-disk"></span> เพิ่ม',
                    ['class' =>  'btn btn-success']) ?>
            </div>
  		</div>
  	</div>
	
    <?php ActiveForm::end(); ?>
	<div class="row">
		<!-- <div class="col-md-1"></div> -->
		<div class="col-md-12">
			<?php echo '</h3>'?>
              <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
                  'events'=> $events,
              ));?>
		</div>
		<!-- <div class="col-md-1"></div> -->
	</div>
	<h3>บันทึกทั้งหมด</h3>
	<div class="row">
		<table class="table  table-hover table-striped">
    <thead>
    <tr class="info">
        <th>#</th>
        <th>รายละเอียด</th>
        <th>บันทึกเมื่อ</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php if (!$data_event || $data_event ==null){
    
    }else{?>
    <?php $count=0;  foreach ($data_event as $data):?>
      <tr>
      	<td ><?=++$count?></td>
        <td><?=(!$data->description? "": $data->description)?></td>
        <td><?=Yii::$app->formatter->asDatetime($data->calendar_created_at)?></td>
        <td > <?=Html::a('<span class="	glyphicon glyphicon-trash"></span>','/work/deletecalendar?id='.$data->id.'&user_id='.$data->user_id,['class'=>'btn btn-danger btn-xs'])?></td>
      </tr>
      <tr>
      <?php endforeach;}?>
    </tbody>
  </table>
	</div>
