<?php

$params = array_merge(
	require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-frontend',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'language' => 'th', // Set the language here
	'controllerNamespace' => 'frontend\controllers',
	'modules' => [
		'news' => [
			'class' => 'app\modules\news\Module',
		],
		'customer' => [
			'class' => 'app\modules\customer\Module',
		],
		'user' => [
			'class' => 'dektrium\user\Module',
			'enableUnconfirmedLogin' => true,
			'confirmWithin' => 21600,
			'cost' => 12,
			'admins' => ['admin'],
		],
		'pdfjs' => [
			'class' => '\yii2assets\pdfjs\Module',
		],
	],
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-frontend',
		],
		'user' => [
			//'identityClass' => 'app\models\User',
			'identityClass' => 'dektrium\user\models\User',
			'enableAutoLogin' => true,
		],
		/*
			          'user' => [
			          'identityClass' => 'common\models\User',
			          'enableAutoLogin' => true,
			          'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
			          ],
		*/
		'session' => [
			// this is the name of the session cookie used for login on the frontend
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
		'assetManager' => [
			'bundles' => [
				'yii\bootstrap\BootstrapPluginAsset' => [
					'js' => [],
				],
				'yii\bootstrap\BootstrapAsset' => [
					'css' => [],
				],
			],
		],
	],
	'params' => $params,
];
