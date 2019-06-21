<?php

$params = array_merge(
	require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-backend',
	'name' => 'Garbage service',
	'basePath' => dirname(__DIR__),
	'language' => 'th_TH', // Set the language here
	'controllerNamespace' => 'backend\controllers',
	'bootstrap' => ['log'],
	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'enableUnconfirmedLogin' => true,
			'confirmWithin' => 21600,
			'cost' => 12,
			'admins' => ['admin'],
		],
		'customer' => [
			'class' => 'app\modules\customer\Module',
		],
		'news' => [
			'class' => 'app\modules\news\Module',
		],
		'garbagecontainer' => [
            'class' => 'app\modules\garbagecontainer\Module',
		],
		'report' => [
            'class' => 'app\modules\report\Module',
		],
		'promise' => [
            'class' => 'app\modules\promise\Module',
		],
		'roundgarbage' => [
            'class' => 'app\modules\roundgarbage\Module',
		],
		'roundmoney' => [
            'class' => 'app\modules\roundmoney\Module',
        ],
	],
	'components' => [
		'view' => [
			'theme' => [
				'pathMap' => [
					'@backend/views' => '@backend/themes/adminlte',
				],
			],
		],
		'request' => [
			'csrfParam' => '_csrf-backend',
		],
		/*
			          'user' => [
			          'identityClass' => 'common\models\User',
			          'enableAutoLogin' => true,
			          'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
			          ],
		*/
		'user' => [
			//'identityClass' => 'app\models\User',
			'identityClass' => 'dektrium\user\models\User',
			'enableAutoLogin' => true,
		],
		'session' => [
			// this is the name of the session cookie used for login on the backend
			'name' => 'ic-system',
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
		/*
			      'urlManager' => [
			      'enablePrettyUrl' => true,
			      'showScriptName' => false,
			      'rules' => [
			      ],
			      ],
		*/
		'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => 'http://localhost/garbageservice/frontend',
        ],
		'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => 'http://localhost/garbageservice/backend',
		],
		'thaiFormatter'=>[
			'class'=>'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
		],
	],
	'params' => $params,
];
