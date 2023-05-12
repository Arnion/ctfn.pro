<?php

namespace app\modules\public\controllers;

use Yii;
use Imagine\Image\Box;
use yii\imagine\Image;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Imagine\Image\BoxInterface;
use yii\web\NotFoundHttpException;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\modules\certificate\models\CertificateWork;
use app\modules\public\models\PublicPage;
use app\modules\public\components\PublicController;
use frontend\components\SchoolToken;
use common\models\Certificate;
use app\modules\public\models\SearchCertificate;

/**
 * Default controller for the `service` module
 */
class DefaultController extends PublicController
{		
	/**
     * @init
     */
	public function init()
    {
		$this->getView()->theme = Yii::createObject([
			'class' => '\yii\base\Theme',
			'basePath' => '@app/themes/th1',
			'baseUrl' => '@app/themes/th1/web',
			'pathMap' => ['@app/views' => '@app/themes/th1/views'],
		]);
		
		if (isset($_GET['lang']) && !empty($_GET['lang'])) {
			
			Yii::$app->language = strtolower($_GET['lang']).'-'.strtoupper($_GET['lang']);
			Yii::$app->response->cookies->add(new \yii\web\Cookie([
				'name' => 'lang',
				'value' => $_GET['lang'],
				'expire' => time() + (365 * 24 * 60),
			]));
			
			Yii::$app->session->set('lang', $_GET['lang']); 
			
		} else {
			
			$lang = Yii::$app->session->get('lang'); 
			if (!empty($lang)) {
				Yii::$app->language = strtolower($lang).'-'.strtoupper($lang);
			}
		}
		
		parent::init();
    }
	
	/**
     * Renders the index view for the module
     * @return string
     */


	public function actionViewaddress($id, $hash) {

		if (!Certificate::validateHashCertificate($id, $hash)) {
			throw new HttpException(404 , Yii::t('Error', '404'));
		}

		$modelCertificate = Certificate::find()->where('id_certificate = :id_certificate AND (minted_on_testnet = 1 OR minted_on_mainnet = 1)', ['id_certificate'=> $id])->one();

		if (empty($modelCertificate)) {
			throw new HttpException(404 , Yii::t('Error', '404'));
		}

		$model = new CertificateWork;
		$model->setAttributes($modelCertificate->attributes, false);

		return $this->render('view_address', [
			'model' => $model,
		]);
	}

	public function actionContract() {

		$model = new ViewContract;

		return $this->render('search_contract', [
			'model' => $model,
		]);
	}

	public function actionViewcontract($address, $tokenId) {

		$model = new ViewContract;

		return $this->render('view_contract', [
			'model' => $model,
		]);
	}
	
	/**
	 * action address
	 */
	public function actionAddress()
    {
		$model = new SearchCertificate;
		
		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());
		}

		return $this->render('address', [
			'model' => $model,
		]);
    }
}
