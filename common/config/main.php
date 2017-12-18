<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
   'language'=>'th',
    'components' => [
    
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],  
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'd-MMM-yyy',
            'datetimeFormat' => 'd MMM yyy kk:mm',
            'timeFormat' => 'kk:mm:ss',
//             'dateFormat' => 'd-M-Y',
//             'datetimeFormat' => 'd-M-Y H:i:s',
//             'timeFormat' => 'HH:ii:ss',
            'locale' => 'th-TH@calendar=buddhist', // your language locale
             'defaultTimeZone' => 'Asia/Bangkok',
            'timeZone' => 'Asia/Bangkok',
            'calendar' => IntlDateFormatter::TRADITIONAL ,
        ] ,

    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
];
