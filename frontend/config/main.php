<?php
use \yii\web\Request;
use \yii\web\View;
use kartik\mpdf\Pdf;

$baseUrl = str_replace ( '/frontend/web', '', (new Request())->getBaseUrl() );
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@backend/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mandrillapp.com',
                'username' => 'teerawutkt3@gmail.com',
                'password' => 'Teerawut_04012538',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                   //     'key' => 'AIzaSyArBQOuYHVIZ0ZIJIXJ4n0GW4FtjAUwInk',// ใส่ API ตรงนี้ครับ
                      //  'language' => 'th',
                      //  'version' => '3.1.18'
                    ]
                ]
            ]
        ], 
        'request' => [
            'baseUrl' => $baseUrl,
            'csrfParam' => '_csrf-frontend',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId'     =>'482701624128-umf72m74ccar9gu7tf7ivvt348qk525m.apps.googleusercontent.com',
                    'clientSecret' =>'FgTbIbUrEu-PdhVnCcalOmdP',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '298611097298842',
                    'clientSecret' => '5a20e330bd6954c9502aaad39491fab6',
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            //'suffix' => '.html',
            'rules' => [
             
                ///'mySecret' => '/work/create',
                
                '<controller>/<id:\d+>' => '<controller>/view',
                '<controller:(course|courseonsemester)>/update/<id:\d+>' => '<controller>/update',
                'courseonsemester/admin/<time:\d+>' => 'courseonsemester/admin',
            ]
        ],
        
    ],
    'params' => $params,
];
