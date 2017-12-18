<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Geography;

/* @var $this yii\web\View */
/* @var $model common\models\User */
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

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="row"><div class="col-md-5">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

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
                            		        'onChanged'=>'alert(this.val())'
                            		
                            		]) ?></div>
      </div>  
    </div><!-- col-md-5 -->
    <div class="col-md-6">
        <?= $form->field($user_extention, 'educational_institution')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($user_extention, 'education')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($user_extention, 'branch')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($user_extention, 'experience')->textarea(['rows' => 10]) ?>
    
        <?= $form->field($user_extention, 'work_skill')->textarea(['rows' => 8]) ?>
    
        <?= $form->field($user_extention, 'language')->textarea(['rows' => 3]) ?>
    </div>
    </div> <!-- end row -->

                  


	<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-2">
					<div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'ตกลง', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']) ?>
                    </div>
			</div>
			<div class="col-md-2">
						<a href="/user/view?id=<?=$model->id?>" class="btn btn-default btn-block">ยกเลิก</a>
			</div>
			<div class="col-md-4"></div>
	</div>
    

    <?php ActiveForm::end(); ?>

</div>
