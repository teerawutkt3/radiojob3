<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Geography;
use kartik\time\TimePicker;
use common\models\Belong;

/* @var $this yii\web\View */
/* @var $model common\models\Work */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs('
    function listProvinces(){
    var geo_id = $("#geo_id").val();
    $.ajax({
        url:" '.Url::toRoute("/address/list_provinces?id=").' ",
        method: "GET",
         data: { id: geo_id }
    }).done(function(txt){
        $("#province_id").html(txt);
    });
    
    }
    function listAmphures(){
    var province_id = $("#province_id").val();
    $.ajax({
        url:"'.Url::toRoute("/address/list_amphures").'",
        method: "GET",
         data: { id: province_id }
    }).done(function(txt){
        $("#amphur_id").html(txt);
    });
    
    }
    
function listDistricts(){
    var amphur_id = $("#amphur_id").val();
    $.ajax({
        url:"'.Url::toRoute("/address/list_districts").'",
        method: "GET",
         data: { id: amphur_id }
    }).done(function(txt){
        $("#district_id").html(txt);
    });
    
    }
    
',
    View::POS_HEAD);
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-7"> <?= $form->field($model, 'name_office')->textInput(['maxlength' => true,'placeholder'=>'ชื่อสถานที่ทำงาน']) ?></div><br>
				<div class="col-md-3"><?php //echo Html::a('ระบุตำแหน่งเพื่อให้เห็นถึงพื้นที่ <span class="	glyphicon glyphicon-map-marker"></span>','/work/map',['class'=>'btn btn-warning'])?> </div>
			</div>
		   
            <?= $form->field($model, 'description')->textarea(['rows' => 20,'placeholder'=>'รายละเอียดของงาน']) ?>
            <div class="row">
            	<div class="col-md-4"> <?= $form->field($model, 'belong')->dropDownList(
            	           ArrayHelper::map(Belong::find()->all(),'name_belong', 'name_belong'),
            	           ['prompt' => 'หน่วยงาน / สังกัด',]
            	    )?></div>
            	<div class="col-md-3"><br><?= Html::a('เพิ่มหน่วยงาน +', ['/belong/create'], ['class'=>'btn btn-warning btn-xs']) ?></div>  
            	<div class="col-md-3">  <?= $form->field($model, 'number')->textInput(['placeholder'=>'จำนวนรับสมัคร']) ?></div>
            </div>
           
          <div class="row">
            	<div class="col-md-6">
            	 <?= $form->field($model, 'money1')->textInput(['placeholder'=>'รายได้ตั้งแต่ ']) ?></div> 
            	<div class="col-md-6">   <?= $form->field($model, 'money2')->textInput(['placeholder'=>'ถึง']) ?></div>
            </div>

		</div> <!-- end col-md-6 -->
		<div class="col-md-6">
		 <?= $form->field($model, 'benefits')->textarea(['rows' => 15,'placeholder'=>'รายละเอียดสวัสดิการ']) ?>
            
          
           <div class="row">
           				
           			<div class="col-md-6">
                    <?= $form->field($model, 'time_begin')->widget(TimePicker::className(),[
                        'name' => 'time_begin',  
           			    'pluginOptions' => [
           			        'showSeconds' => false,
           			        'showMeridian' =>false,
           			        'minuteStep' => 1,
           			        'secondStep' => 5,
           			    ],
           			    'addonOptions' => [
           			        'asButton' => true,
           			        'buttonOptions' => ['class' => 'btn btn-info']
           			    ]
           			] )?>
					</div>
           			<div class="col-md-6"> 
           			  <?= $form->field($model, 'time_end')->widget(TimePicker::classname(), [
           			      
           			          'name' => 'time_end',
           			          'pluginOptions' => [
           			              'showSeconds' => false,
           			              'showMeridian' => false,
           			              'minuteStep' => 1,
           			              'secondStep' => 5,
           			          ],
           			      'addonOptions' => [
           			          'asButton' => true,
           			          'buttonOptions' => ['class' => 'btn btn-danger']
           			      ]
           			      ] )?>
           			</div>
           </div>
             <div class="row"><div class="col-md-8"> <?= $form->field($model, 'tel')->textInput(['maxlength' => true,'placeholder'=>'เบอร์ติดต่อ']) ?>	</div></div>
           
		  <?= $form->field($address, 'data_address')->textarea(['rows' => '6']) ?>
		        <div class="row">
            <div class="col-md-6"><?= $form->field($address, 'geo_id')->
                            dropDownList(ArrayHelper::map(Geography::find()->all(), 'GEO_ID', 'GEO_NAME'),
                            		[
                            				'id' => 'geo_id',
                            				'prompt' => 'ภาค',
                            		        'onChange'=>'listProvinces()'
                            		]) ?></div>
            <div class="col-md-6"><?= $form->field($address, 'province_id')->
                            dropDownList([],
                            		[
                            				'id' => 'province_id',
                            				//'prompt' => 'จังหวัด',
                            		        'onChange'=>'listAmphures()'
                            		]) ?></div>
       
    </div>
            <div class="row">
            <div class="col-md-6">                       		  
                            		<?= $form->field($address, 'amphur_id')->
                            dropDownList([],
                            		[
                            				'id' => 'amphur_id',
                            			//	'prompt' => '---- เลือกอำเภอ  ----',
                            		        'onChange'=>'listDistricts()'
                            		
                            		]) ?></div>
             <div class="col-md-6"><?= $form->field($address, 'district_id')->
                            dropDownList([],
                            		[
                            				'id' => 'district_id',
                            		//		'prompt' => '---- เลือกตำบล   ----',
                            		        'onChanged'=>'alert(this.val())',
                            	                         		
                            		]) ?></div>
      </div>  
		</div>
	</div>

    <div class="row">
    	<div class="col-md-4"></div>
    	<div class="col-md-2"><?= Html::submitButton($model->isNewRecord ? 'ประกาศ' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-primary btn-block' : 'btn btn-primary btn-block']) ?></div>
    	<div class="col-md-2"><a href="/work/index" class="btn btn-block btn-default">ยกเลิก</a></div>
    	<div class="col-md-4"></div>
    </div>
       
    

    <?php ActiveForm::end(); ?>

</div>
