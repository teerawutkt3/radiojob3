<?php 
 use yii\helpers\Html;
 
 $strTo = "teerawutkt3@gmail.com";  //"thnanap_2593@hotmail.com"; 
$strSubject = "ทอดสอบ";
$strHeader = "From: Radiojob@work.tk";
                     //    $html =   \Yii::$app->formatter->as( 'รายละเอียดงาน<br>'.
                        //      \Yii::$app->formatter->asNtext($model->description).'</br>สวัสดิการ<br>'.
                        //      \Yii::$app->formatter->asNtext($model->benefits));
$strMessage = Html::a('สมัคร','/work/search-map',['class'=>'btn btn-info']);


$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
 
?>
 
 <?php
// multiple recipients
// $to  = 'teerawutkt3@gmail.com';

// // subject
// $subject = 'โรงพยาบาล';

// // message
// $message = '
// <html>
// <head>
//   <title>งานประกาศ</title>
// </head>
// <body>
//   <p>สวัสดีครับ</p>
//   <a href="http://www.radiolab.tk/" >สมัครเลย</a>
// </body>
// </html>
// ';

// // To send HTML mail, the Content-type header must be set
// $headers  = 'MIME-Version: 1.0' . "\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// // Additional headers
// //$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
// $headers .= 'From: Radiojob <Radiojob@work.tk>' . "\r\n";
// //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
// //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// // Mail it
// mail($to, $subject, $message, $headers);
?>