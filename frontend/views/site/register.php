<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'ลงทะเบียน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup" style="margin-top:-50px;margin-bottom:-50px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->hiddenInput()->label(false)?>
                
                <?= $form->field($model, 'fname')->textInput() ?>
                
                <?= $form->field($model, 'lname')->textInput() ?>

                <?= $form->field($model, 'email') ?>
                
                <?= $form->field($model, 'fb_id')->hiddenInput()->label(false) ?>
                <div class="row">
                	<div class="col-md-4">
                				<div class="panel panel-primary">
                                  <div class="panel-heading">เลือกสิทธิ์การใช้งาน</div>
                                  <div class="panel-body">
                                       <?= $form->field($auth_assignment, 'item_name')->radioList(array(
                                                    1=>'นักรังสีเทคนิค',0=>'ผู้ประกาศงาน'
                                        ));?>
                                        <p class="text-danger"> * ตรวจสอบสิทธิ์การใช้งานให้แน่ใจก่อนกดสมัคร</p>
                                  </div>
                                </div>
                	</div>
                </div>
           
             
                <?php //echo  $form->field($authassignment, 'item_name')->radioList([
                          //  '1'=>'นักรังสีเทคนิค','2'=>'โรงพยาบาล']) ->label('เลือกสิทธิ์การใข้งาน'); ?>
          		
              
                <?php // $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">

                    <?= Html::submitButton('สมัครสมาชิก', [
                        'class' => 'btn btn-primary', 
                        'name' => 'signup-button',
                        'data' => [
                            'confirm' => 'คุณตรวจสอบ สิทธิ์การใช้งานแล้วใช่หรือไม่',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
