<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = "login";

?>
<style>
.panel-body1 {
background: 		#04859D	; /* #006363 */
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 
 
</style>
<div class="site-login">
                  		  <h1 class="text-center"><img class="center" alt="" src="/img/logo.png" style="width:10%;  "> 	เข้าสู่ระบบ</h1>     	 
        	

  <h1 class="text-center">  </h1>
<!--     <p>Please fill out the following fields to login:</p>
 -->
 
    <div class="row">
    <div class="col-lg-4"></div>
        <div class="col-lg-4">
               <h3 class="text-center">เข้าสู่ระบบด้วย </h3>
               	<div class="row">
               		<div class="col-md-3  col-xs-3"></div>
               		<div class="col-md-6">
               		 <?php  echo AuthChoice::widget(['baseAuthUrl' => ['site/auth'] ]);?>
               		</div>
               	</div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

               

                <div class="form-group">
                    <?= Html::submitButton('<span class="	glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
     	 
           <div class="col-lg-4">
            
           </div>
    </div>
</div>
