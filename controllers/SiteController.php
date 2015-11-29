<?php

namespace app\controllers;

use app\models\Challenge;
use app\models\ChallengeSearch;
use Yii;
use yii\filters\AccessControl;
use yii\i18n\Formatter;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        $this->enableCsrfValidation = false;
        $model = Challenge::findActual();

        if (!empty($model)) {
//            проверка ответа
            if(!empty($post = Yii::$app->request->post())){
                Challenge::checkAnswer($post,$model);
            }
//        условие по времени
            $timestamp = $model->time;
            $currentTime = strtotime('now');
            $levelTime = $currentTime - $timestamp;
            $nextActionTime = 0;
            if ($levelTime < 30 * 60) {
                $nextActionTime = 30 * 60 - $levelTime;
            } elseif ($levelTime < 60 * 60) {
                $nextActionTime = 60 * 60 - $levelTime;
            } elseif ($levelTime < 90 * 60) {
                $nextActionTime = 90 * 60 - $levelTime;
            }
            $formatter = Yii::$app->formatter;
            $formatter->timeZone = 'GMT+5';
            $clearStartTime = $formatter->asTime($timestamp, 'php: H:i:s');
            $formatter->timeZone = 'GMT0';
            return $this->render('index', [
                'model' => $model,
                'startTime' => $clearStartTime,
                'levelTime' => $formatter->asTime($levelTime, 'php: H:i:s'),
                'nextActionTime' => $formatter->asTime($nextActionTime, 'php: i:s')
            ]);
        } else {
            return $this->render('about', []);
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    protected function findModel($id)
    {
        if (($model = Challenge::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
