<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
	'language'=>'en-EN',
	'name' => 'CTFN PRO',
	'homeUrl' => 'https://ctfn.pro',
    'components' => [
		 'formatter' => [
			'class' => 'yii\i18n\Formatter',
			//'dateFormat' => 'php:j M Y',
			//'datetimeFormat' => 'php:j M Y H:i',
			//'timeFormat' => 'php:H:i',
			'timeZone' => 'Europe/Moscow',
		],
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
            'csrfParam' => '_csrf-client',
			'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'some_random_key',
        ],
        'user' => [
            'identityClass' => 'common\models\Clients',
            'enableAutoLogin' => true,
            'identityCookie' => [
				'name' => '', // '_identity-ctfn_' + <some random string>
				'httpOnly' => true,
				'domain' => '.ctfn.pro', // domain
				'secure' => true,
			],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'identity-ctfn_', // 'identity-ctfn_' + <some random string>
			'cookieParams' => [
                'httpOnly' => true,
				'domain' => '.ctfn.pro',
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
					'class' => 'frontend\components\UrlRule',         
				],
				'' => 'site/index',
                '<action:(signup|login|captcha|logout|confirm|resendemail|passwordreset|passwordresetconfirm|terms|privacy|help|formvalidation|info|certificate)>' => 'site/<action>',
            ],
        ],
		
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=',
			'username' => '',
			'password' => '',
			'charset' => 'utf8mb4',
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
		
		'hahsids' => [
			'class' => 'light\hashids\Hashids',
			'salt' => '', // add random string
			'minHashLength' => 6,
			'alphabet' => 'abcdefghigk'
		],
		
		'reCaptcha' => [
			'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
			//'siteKeyV2' => '',
			//'secretV2' => '',
			'siteKeyV3' => '', // add v3 api data
			'secretV3' => '', // add v3 api data
		],
    ],
	'modules' => [
		'gii' => [
			'class' => 'yii\gii\Module',
			'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '217.28.227.34', '188.32.38.22'],
		],

		'profile' => [
			'class' => 'app\modules\profile\ProfileModule',
		
			'as access' => [ 
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'] 
					],
				]
			],
		],
		'certificate' => [
			'class' => 'app\modules\certificate\CertificateModule',
		
			'as access' => [ 
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'] 
					],
				]
			],
		],
		
		'public' => [
			'class' => 'app\modules\public\PublicModule',
		
			'as access' => [ 
				'class' => 'yii\filters\AccessControl',
				'rules' => [
					[
						'allow' => true,
						// 'roles' => ['@'] 
					],
				]
			],
		],
	],
	
	'bootstrap' => [ 
        'app\modules\profile\Bootstrap',
		'app\modules\certificate\Bootstrap',
		'app\modules\public\Bootstrap',
		'log',
    ],
	
    'params' => $params,
];
