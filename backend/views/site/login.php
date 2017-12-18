<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'เข้าสู่ระบบ';
?>
<style>
.panel-body1 {
background: 	#006363	;
color:#FFFFFF;
box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
} 
}
</style>
<div class="site-login">
    
	<h1 class="text-center">   <img alt="" src="/img/logo.png" style="width:15%"></h1>
     <div class="row">
     <div class="col-lg-4"></div>
        <div class="col-lg-4">
              	 <h1 class="text-center">การจัดการผู้ใช้งาน</h1>
            
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            
                            <?= $form->field($model, 'password')->passwordInput() ?>
            
                            <?php //echo $form->field($model, 'rememberMe')->checkbox() ?>
            
                           <h1 class="text-center">
                                <?= Html::submitButton('<span class="	glyphicon glyphicon-log-in"></span>   เข้าสู่ระบบ', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                           </h1>
            
                        <?php ActiveForm::end(); ?>
      </div>
      <div class="col-lg-4"></div>
    </div>
</div>
