<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lRuXgwhRa4ztNdujE22qsxGRaN5-DAdX',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Image custom route
                'DELETE api/image/delete/<id:\d+>' => 'api/image/delete',

                // Survey details route
                'GET api/surveys/<id:\d+>/details' => 'api/survey/details',

                // Pages API
                'GET api/surveys/<survey_id:\d+>/pages' => 'api/page/index',
                'GET api/surveys/<survey_id:\d+>/pages/<id:\d+>' => 'api/page/view',
                'PUT api/surveys/<survey_id:\d+>/pages/<id:\d+>' => 'api/page/update',
                'DELETE api/surveys/<survey_id:\d+>/pages/<id:\d+>' => 'api/page/delete',
                'POST api/surveys/<survey_id:\d+>/pages' => 'api/page/create',

                // Questions API
                'GET api/surveys/<survey_id:\d+>/pages/<page_id:\d+>/questions' => 'api/question/index',
                'GET api/surveys/<survey_id:\d+>/pages/<page_id:\d+>/questions/<id:\d+>' => 'api/question/view',
                'PUT api/surveys/<survey_id:\d+>/pages/<page_id:\d+>/questions/<id:\d+>' => 'api/question/update',
                'DELETE api/surveys/<survey_id:\d+>/pages/<page_id:\d+>/questions/<id:\d+>' => 'api/question/delete',
                'POST api/surveys/<survey_id:\d+>/pages/<page_id:\d+>/questions' => 'api/question/create',

                // Question Options API
                'GET api/questions/<question_id:\d+>/options' => 'api/question-option/index',
                'GET api/questions/<question_id:\d+>/options/<id:\d+>' => 'api/question-option/view',
                'PUT api/questions/<question_id:\d+>/options/<id:\d+>' => 'api/question-option/update',
                'DELETE api/questions/<question_id:\d+>/options/<id:\d+>' => 'api/question-option/delete',
                'POST api/questions/<question_id:\d+>/options' => 'api/question-option/create',

                // Responses API
                'GET api/surveys/<survey_id:\d+>/responses' => 'api/response/index',
                'GET api/surveys/<survey_id:\d+>/responses/<id:\d+>' => 'api/response/view',
                'PUT api/surveys/<survey_id:\d+>/responses/<id:\d+>' => 'api/response/update',
                'DELETE api/surveys/<survey_id:\d+>/responses/<id:\d+>' => 'api/response/delete',
                'POST api/surveys/<survey_id:\d+>/responses' => 'api/response/create',

                // Answer API
                'GET api/responses/<response_id:\d+>/questions/<question_id:\d+>/answers' => 'api/answer/index',
                'GET api/responses/<response_id:\d+>/questions/<question_id:\d+>/answers/<id:\d+>' => 'api/answer/view',
                'PUT api/responses/<response_id:\d+>/questions/<question_id:\d+>/answers/<id:\d+>' => 'api/answer/update',
                'DELETE api/responses/<response_id:\d+>/questions/<question_id:\d+>/answers/<id:\d+>' => 'api/answer/delete',
                'POST api/responses/<response_id:\d+>/questions/<question_id:\d+>/answers' => 'api/answer/create',

                // REST Urls
                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => ['api/theme', 'api/survey', 'api/survey-setting', 'api/logic']
                ]
            ],
        ],
    ],
    'modules' => [
        'api' => [
            'class' => \app\modules\api\Module::class
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
