<?php

use yii\web\View;

/* @var $this yii\web\View */

$this->title = 'RadioJob';
$this->registerJs("
 $(window).on('load',function(){
        $('#myModal').modal('show');
    });
",View::POS_READY);
?>
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 30px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

a{

  text-decoration: none !important;
}
.button1 {
    background-color: #B0C4DE	; 
    color: black; 
   /*  border: 2px solid #04859D; */
    box-shadow: 5px 5px 10px 10px rgba(50,50,50,.4);
    border-radius: 50%;
}

.button1:hover {
    background-color: #04859D;
    color: white;
}

.button2 {
    background-color: white; 
    color: black; 
    border: 2px solid #008CBA;
}

.button2:hover {
    background-color: #008CBA;
    color: white;
}

.button3 {
    background-color: white; 
    color: black; 
    border: 2px solid #f44336;
}

.button3:hover {
    background-color: #f44336;
    color: white;
}

.button4 {
    background-color: white;
    color: black;
    border: 2px solid #e7e7e7;
}

.button4:hover {background-color: #e7e7e7;}

.button5 {
    background-color: white;
    color: black;
    border: 2px solid #555555;
}

.button5:hover {
    background-color: #555555;
    color: white;
}
</style>
<div class="site-index "  >

<!--     <div class="jumbotron"> -->
    
         <h1 class="text-center"><img class="center" alt="" src="/img/logo.png" style="width:15%;  "><br></h1>
    <h1 class="text-center"> Radiojob</h1>
        <h2 class="text-center"> ค้นหางานสำหรับนักรังสีเทคนิค</h2><!-- 
        <div class="panel panel-default">
         	<div class="panel-body"> -->
         		 <h4 class="text-center text-danger">สมัครเข้าใช้งานแล้วกรอกข้อมูลส่วนตัวเพื่อให้ผู้ประกาศเห็นถึงประสบการณ์ทำงานและความสามารถของตัวคุณ</h4>
      <!--   	</div>
        </div> -->
       
    
   
        <!-- <h3 class="lead">  เว็บค้นหางานสำหรับนักรังสีเทคนิค</h3> -->

    	
    			<h1 class="text-center"> <a class="button button1 btn-lg " href="/work/work-search-normal"><span class="	glyphicon glyphicon-search"></span> ค้นหางาน  </a></h1>	
    		
    		<h2 class="text-center">
    			<a href="/site/login" class="btn btn-primary"><span class="	glyphicon glyphicon-pencil"></span> สมัครสมาชิก</a>
    			<a href="/site/about" class="btn btn-primary"><span class="glyphicon glyphicon-bookmark"></span> เกียวกับเรา</a>
    			<a href="/contact/create" class="btn btn-primary"><span class="	glyphicon glyphicon-share"></span> ติดต่อเรา</a>
    			
    		</h2>
   <!--  </div> --> <!-- end jumpo -->
<!-- 
    <div class="body-content">
		
        <div class="row">
        	<div class="col-lg-3"></div>
        	 <div class="col-lg-2">
            <div class="well"><h5 class="text-center"><a href="/site/login"><span class="	glyphicon glyphicon-pencil"></span> สมัครสมาชิก</a></h5></div>       
            </div>
            <div class="col-lg-2">
            <div class="well"><h5 class="text-center"><a href="/site/about"><span class="glyphicon glyphicon-bookmark"></span> เกี่ยวกับเรา</a></h5></div>       
            </div>
            <div class="col-lg-2">
                <div class="well"><h5 class="text-center"><a href="/contact/create"><span class="	glyphicon glyphicon-share"></span> ติดต่อเรา</a></h5></div>
            </div>
            <div class="col-lg-3"></div>
        </div>

    </div> -->
    
        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog"  >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body ">
                <div class="jumbotron">
                <img alt="" src="/img/logo.png" style="width:30%">
                <h1>Welcome</h1>
        
                <p class="lead">Radiojob web applications.</p>
                <p class="lead">เว็บไซต์ค้นหางานสำหรับนักรังสีเทคนิค</p><hr>
                <h1><span class="glyphicon glyphicon-search"></span></h1>
                	<p>ผลประโยชน์มากมายในการเข้าใช้งานระบบ เช่น </p>
                	<h2 class="text-danger">การช่วยคัดกรองในเรื่องของรายได้ </h2>
                	<h2 class="text-danger"> การค้นหาในแบบ google map </h2>
                	<h2 class="text-danger">และอื่นๆอีกหลากหลาย</h2>
                	<h1><span class="glyphicon glyphicon-ok-sign"></span></h1>
                	<h3 class="text-primary">สมัครเข้าใช้งานแล้วกรอกข้อมูลส่วนตัวเพื่อให้ผู้ประกาศเห็นถึงประสบการณ์ทำงานและความสามารถของตัวคุณ</h3>
                	
            </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
      </div>
    </div>

  </div>
</div>
        <!-- model -->
</div> <!-- end site -->