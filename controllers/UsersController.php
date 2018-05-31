<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{

  public function behaviors()
  {
      return [
          'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
          'delete' => ['POST'],
          ],
      ],

      'access' => [
          'class' => AccessControl::className(),
          'only' => ['index', 'view', 'create', 'update', 'delete'],
          'rules' => [
                  [
                      'actions' => ['index'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],
                  [
                      'actions' => ['view'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],
                  [
                      'actions' => ['create'],
                      'allow' => true,
                      'roles' => ['@'],
                      'matchCallback' => function($rule, $action){
                    			if(Yii::$app->user->identity->adminGroup === 'admin' || Yii::$app->user->identity->adminGroup === 'manager'){
                    						return true;
                    					}
                    					else{
                    						return false;
                    					}
                					}
                  ],
                  [
                      'actions' => ['update'],
                      'allow' => true,
                      'roles' => ['@'],
                      'matchCallback' => function($rule, $action){
                    	   if(Yii::$app->user->identity->adminGroup === 'admin' || Yii::$app->user->identity->adminGroup === 'manager'){
                    				  return true;
                    		    }
                    		    else{
                    				  return false;
                    		    }
              				}
                  ],
                  [
                      'actions' => ['delete'],
                      'allow' => true,
                      'roles' => ['@'],
                      'matchCallback' => function($rule, $action){
                    				if(Yii::$app->user->identity->adminGroup === 'admin'){
                    						return true;
                    					}
                    					else{
                    						return false;
                    					}
                  		}
                  ],
              ],
          ],
      ];
  }

  public function actionIndex()
  {
      /* if (!Yii::$app->user->can('index')) {
           throw new ForbiddenHttpException('Access denied');
         }
      */

      $dataProvider = new ActiveDataProvider([
        'query' => Users::find(),
      ]);

      return $this->render('index', [
        'dataProvider' => $dataProvider,
      ]);

  }

  public function actionLogin()
  {

      if (!Yii::$app->user->isGuest) {
          return $this->goHome();
      }

      $model = new LoginForm();
      if ($model->load(Yii::$app->request->post()) && $model->login()) {
          return $this->redirect(['hello', 'email' => $model->email]);
      }

      $model->password = '';
      return $this->render('/users/login', [
          'model' => $model,
      ]);

  }

  public function actionLogout()
  {
      Yii::$app->user->logout();

      return $this->goHome();
  }

  public function actionRegistration()
  {

    if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    $model = new Users();
    $model_log = new LoginForm();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {

          $model->auth_key = $model->password;
          $model->save(false, ['auth_key']);

          $model_log->email = $model->email;
          $model_log->password = $model->password;

          if ($model_log->login()) {
              return $this->redirect(['hello', 'email' => $model->email]);
          }

    } else {
        return $this->render('registration', [
        'model' => $model,
      ]);
    }

  }

  public function actionCreate()
  {
    /* if (!Yii::$app->user->can('create')) {
         throw new ForbiddenHttpException('Access denied');
       }
    */

    $model = new Users();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {

        $model->auth_key = $model->password;
        $model->save(false, ['auth_key']);

        return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
        'model' => $model,
      ]);
    }
  }

  public function actionHello($email)
  {

    $dataProvider = new ActiveDataProvider([
      'query' => Users::find()->where(['email' => $email]),
    ]);

    return $this->render('hello', [
      'dataProvider' => $dataProvider,
    ]);

  }

  public function actionRemind()
  {

    $model = new Users();

    if (Yii::$app->request->post()) {
        $result = $model::find()->where(['email' => Yii::$app->request->post('Users')['email']])->one();
              Yii::$app->mailer->compose()
              ->setFrom('oleg.kolmyk@gmail.com')
              ->setTo($result['email'])
              ->setSubject('password')
              ->setTextBody('Здравствуйте '.$result['email'].'. Ваш пароль - '.$result['password'])
              ->send();
            return $this->redirect(['reminddone', 'email' => $result['email']]);

    } else {
        return $this->render('remind', [
            'model' => $model,
        ]);
    }

  }

  public function actionReminddone($email)
  {

    $model = new Users();

    return $this->render('reminddone', [
        'email' => $email,
    ]);
  }

  public function actionView($id)
  {

    return $this->render('view', [
        'model' => $this->findModel($id),
    ]);

  }

  public function actionUpdate($id)
  {

    /* if (!Yii::$app->user->can('update')) {
         throw new ForbiddenHttpException('Access denied');
       }
    */

    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {

        $model->auth_key = $model->password;
        $model->save(false, ['auth_key']);

        return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('update', [
        'model' => $model,
      ]);
    }

  }

  public function actionDelete($id)
  {

    // if (!Yii::$app->user->can('delete')) {
    //     throw new ForbiddenHttpException('Access denied');
    //   }

      $this->findModel($id)->delete();

      return $this->redirect(['index']);
  }

  protected function findModel($id)
  {
      if (($model = Users::findOne($id)) !== null) {
          return $model;
      } else {
          throw new NotFoundHttpException('The requested page does not exist.');
      }
  }

}
