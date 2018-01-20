<h1 class="" style="width: 75%; float: left"><b>ประวัติส่วนตัว</b></h1>
<h2 class="text-center " style="width: 25%; float: right"> 
              		<img alt="profile" src="/img/user/<?=$user->img?>" style="width: 150px;border:3px solid #F3E3D9;
  padding:1px;
  background-color:black;">
</h2>
            
<img src="/img/line.png">
<img src="/img/lineblue.png">
<h3><b>ชื่อ </b><?=$user->fname?>  <b>นามสกุล</b> <?=$user->lname?></h3>
<h3><b>เกิด</b>  : <?=(!$user_extention ? "" : Yii::$app->formatter->asDate($user_extention->birth ,'full')) ?></h3>
<h3><b>ที่อยู่ </b>: <?=(!$user->address_id ? "" :$user->address->nameAddress )?></h3>
<h3><b>เบอร์ติดต่อ </b>: <?=(!$user_extention ? "" :$user_extention->tel )?></h3>
<h3><b>email</b> : <?=$user->email?></h3>
<img src="/img/line.png">
<img src="/img/lineblue.png">
<h3><b>การศึกษา</b></h3>
<h3><b>วุฒิการศึกษา : </b><?=(!$user_extention ||!isset($user_extention) ? "" : $user_extention->education)?></h3>
<h3><b>วุฒิการศึกษา : </b><?=(!$user_extention ? "" : $user_extention->branch)?></h3>
<h3><b>วุฒิการศึกษา : </b><?=(!$user_extention ? "" : $user_extention->educational_institution)?></h3>

<img src="/img/line.png">
<img src="/img/lineblue.png">
<h3><b>ทักษะด้านภาษา : </b>  <br><?=(!$user_extention ? "" :$user_extention->language)?></h3>
<h3><b>ทักษะด้านการทำงาน  :</b>  <br> <?=(!$user_extention ? "" :$user_extention->work_skill)?></h3>
<h3><b>ประสบการณ์   : </b>  <br><?=(!$user_extention ? "" :$user_extention->experience)?><br>


<?php 
$data_end = '';
foreach ($joinwork as $data_join_work):
	if ($data_join_work->work->name_office == $data_end){
    
    }else{
        echo $data_join_work->work->name_office;
     $data_end =$data_join_work->work->name_office;
    }
	 ?>
	<br>

<?php endforeach;?>
</h3>