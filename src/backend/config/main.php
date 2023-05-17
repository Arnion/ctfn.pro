<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
	'language'=>'ru-RU',
	'name' => 'Панель управления',
	'homeUrl' => '', //https://admin.example.com
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [ 
		'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ]
                ],
				'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ]
                ],                 
				'yii\jui\JuiAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery-ui.js' : 'jquery-ui.min.js',
                    ]
                ],
				'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ],
            ],
        ],   
		'request' => [
            'csrfParam' => '_csrf-backend',
			'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'some_random_key',
        ],
		'user' => [
			'identityClass' => 'backend\models\Admins',
			'enableAutoLogin' => true,
            'identityCookie' => [
				'name' => '', 
				'httpOnly' => true,
				'secure' => true,
			],
        ],
		'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => '',
			'cookieParams' => [
                'httpOnly' => true,
				'sameSite' => 'None',
				'secure' => true,
            ],
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
			'enablePrettyUrl' => true,
            'showScriptName' => false,
			'enableStrictParsing' => true,
			'rules' => [
				[
					'class' => 'backend\components\UrlRule',         
				],
				'' => 'site/index',
				'<action:(login|captcha|create|logout)>' => 'site/<action>',
            ],
        ],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=',
			'username' => '',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		],
		'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'frontend\components\newDbMessageSource',
                    'sourceMessageTable' => '{{%source_message}}',
					'messageTable' => '{{%message}}',
                    'sourceLanguage' => 'ru', 
                ],
            ],
        ],
		'reCaptcha' => [
			'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
			//'siteKeyV2' => '',
			//'secretV2' => '',
			'siteKeyV3' => '',
			'secretV3' => '',
		],
		/*
		'view' => [
			'theme' => [
				'pathMap' => [
					'@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
				],
			],
		],
		*/	
	],		
	'modules' => [
		'gii' => [
			'class' => 'yii\gii\Module',
			'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '217.28.227.34', '188.32.38.22'],
		],

		'editors' => [
			'class' => 'backend\modules\editors\EditorsModule',
		
			'as access' => [ 
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'] 
					],
				]
			],
		
			'modules' => [
				
				'pages' => [
					'class' => 'backend\modules\editors\modules\pages\PagesModule',
				],
				
				'translations' => [
					'class' => 'backend\modules\editors\modules\translations\TranslationsModule',
				],
			],
		],
		'statistics' => [
			'class' => 'backend\modules\statistics\StatisticsModule',
		
			'as access' => [ 
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'] 
					],
				]
			],
		
			'modules' => [
				
				'yandex' => [
					'class' => 'backend\modules\statistics\modules\yandex\YandexModule',
				],
				
				'google' => [
					'class' => 'backend\modules\statistics\modules\google\GoogleModule',
				],
			],
		],	
	],
	'bootstrap' => [
		'backend\modules\editors\Bootstrap',
		'backend\modules\editors\modules\pages\Bootstrap',
		//'backend\modules\editors\modules\translations\Bootstrap',
		'backend\modules\statistics\Bootstrap',
		'backend\modules\statistics\modules\yandex\Bootstrap',
		'backend\modules\statistics\modules\google\Bootstrap',
		'log',
	],
    'params' => $params,
];
