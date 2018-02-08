<?php

/* @var $this yii\web\View */

$this->title = 'RadioJob';
?>
<div class="site-index">
   <h1>Admin : <?=Yii::$app->user->identity->fname.' '.Yii::$app->user->identity->lname?></h1>
   
    <div class="jumbotron">
       <img alt="" src="/img/logo.png" style="width:15%">
        <h1>การจัดการระบบ</h1>

        <!-- <p class="lead">You have successfully created your Yii-powered application.</p> -->

        
    </div>

    <div class="body-content">

        <div class="row">
                 
            <div class="col-lg-4" >
               <!--  <a class="btn btn-lg btn-success btn-block" href="/backend/web/index.php/authassignment/index"><h1>
             	  <span class="	glyphicon glyphicon-user"></span></h1>ผู้ใช้งาน <br><br></a>-->
         	  </div>
            <div class="col-lg-4">
             <!--   <a class="btn btn-lg btn-warning btn-block" href="/backend/web/index.php/authassignment/index"><h1>
                <span class="	glyphicon glyphicon-edit"></span></h1>ผู้ใช้งาน  / สิทธิ์การเข้าใช้งาน<br><br></a> -->
            </div>
           
            <div class="col-lg-4">
             <!--<a class="btn btn-lg btn-danger btn-block" href="/backend/web/index.php/user/user-block"><h1>
            	<span class="glyphicon glyphicon-lock"></span></h1>บล๊อค<br><br></a> -->
     		</div>

        </div>
        <div class="row">
        <div class="col-lg-4"><br>
        <a class="btn btn-lg btn-warning btn-block" href="/backend/web/index.php/authassignment/index"><h1>
                <span class="	glyphicon glyphicon-edit"></span></h1>ผู้ใช้งาน  / สิทธิ์การเข้าใช้งาน<br><br></a> 
          <!-- <a class="btn btn-lg btn-primary btn-block" href="#"><h1>
             <span class="	glyphicon glyphicon-file"></span></h1>งานประกาศ<br><br></a>-->
    		</div>
            <div class="col-lg-4"><br>
           <a class="btn btn-lg btn-info btn-block" href="/backend/web/index.php/contact/view"><h1>
            <span class="glyphicon glyphicon-list-alt"></span></h1>ติดต่อ - ร้องเรียน<br><br></a>
    		</div>
        </div>

    </div>
</div>
