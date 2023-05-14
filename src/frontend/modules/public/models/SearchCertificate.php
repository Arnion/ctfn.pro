<?php

namespace app\modules\public\models;

use Yii;
use yii\base\View;
use yii\base\Model;
use yii\helpers\Url;
use common\models\Clients;
use common\models\Certificate;

/**
 * Signup form
 */
class SearchCertificate extends Model
{
	public $user_nft_address;
	public $verifyCode;
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			['user_nft_address', 'trim'],
			['user_nft_address', 'string', 'max' => 255],
        ];
    }
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
			'user_nft_address' => Yii::t('Frontend', 'Crypto wallet address'),
        ];
    }

	/**
	 * searchUserNftAddress()
	 */
	public function searchUserNftAddress()
	{
		if (empty($this->user_nft_address)) {
			return false;
		}
		
		$certificates = Certificate::searchUserNftAddress($this->user_nft_address);
		if (empty($certificates)) {
			return false;
		}
		
		return $certificates;
	}
	
	

}
