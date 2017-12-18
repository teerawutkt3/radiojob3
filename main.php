<?php
use \yii\web\Request;
use \yii\web\View;

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
        'mailer' => [ //กำหนดการส่ง Email ผ่าน SMTP ของ Google
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.google.com',
                'username' => 'teerawutkt3@gmail.com', //user ทีจะใช้ smtp
                'password' => '04012538',//รหัสผ่านของ user
                'port' => '587',
                'encryption' => 'ssl',
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyArBQOuYHVIZ0ZIJIXJ4n0GW4FtjAUwInk',// ใส่ API ตรงนี้ครับ
                        'language' => 'th',
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
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '100790147243765',
                    'clientSecret' => 'dcc0e9de907c2c37a20ee49b98836c17',
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
