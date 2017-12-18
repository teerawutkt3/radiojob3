
		<p class="text-center">ส่งเมื่อ : <?=Yii::$app->formatter->asDatetime($model->contact_created_at)?></p>
		<p><b><u>เรื่อง</u></b>   <?=$model->subject?></p>
		<p><b><u>รายละเอียด</u></b></p>
		<p>- <?=Yii::$app->formatter->asNtext($model->description)?></p>
		<p><u>ผู้ร้องเรียน</u>  : <?=$model->user->fname." ".$model->user->lname?></p>
