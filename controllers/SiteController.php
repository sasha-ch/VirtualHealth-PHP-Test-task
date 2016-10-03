<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\Source;
use app\models\Rel;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Task #4 action
     *
     * @return string
     */
    public function actionTask4()
    {
        $query = Source::find()->select([Source::tableName() . '.MEDREC_ID', 'PATIENT_NAME'])
                       ->innerJoinWith('rel', false)
                       ->where(['like binary', 'PATIENT_NAME', '%Alex%'])
                       ->distinct();

        return $this->renderPatientList($query);
    }

    /**
     * Task #5 action
     *
     * @return string
     */
    public function actionTask5()
    {
        $query = (new Query())->select(['s.MEDREC_ID', 's.PATIENT_NAME'])
                              ->from(['s' => 'tb_source', 'r' => 'tb_rel'])
                              ->where('s.MEDREC_ID=r.MEDREC_ID')
                              ->andWhere(['like binary', 'PATIENT_NAME', '%Alex%'])
                              ->distinct();
        return $this->renderPatientList($query);
    }

    protected function renderPatientList(Query $query)
    {

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'attributes' => [
                    'MEDREC_ID',
                    'PATIENT_NAME'
                ]
            ]
        ]);

        Yii::$app->db->cache(function ($db) use ($dataProvider){
            $dataProvider->prepare();
        }, 600);

        return $this->render('patient_list', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
