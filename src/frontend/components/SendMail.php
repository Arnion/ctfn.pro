<?php

namespace frontend\components;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use phpmailer\phpmailer\PHPMailer;
use phpmailer\phpmailer\Exception;

/** 
 * $to Адрес кому отправляем письмо
 * $to_name Имя кому отправляем письмо
 * $subject Заголовок письма
 * $message Тело письмо
 * $from Адрес от кого отправляем письмо
 * $from_name Имя от кого отправляем письмо
 * $reply_to Адрес на который слать ответы
 * $header Дополнительные заголовки
 * $attachment Вложения
 * $type Тип сообщения
 */
class SendMail
{
    public static function send($to, $to_name='', $subject, $message, $from='', $from_name='', $reply_to='', $header = [], $attachment = [])
	{	
		if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
			return false;
		}
		
		if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
			return false;
		}

		if (!filter_var($reply_to, FILTER_VALIDATE_EMAIL)) {
			return false;
		}

		$data = [
			'to'             => $to,
			'to_name'        => $to_name,
			'subject'        => $subject,
			'message'        => wordwrap($message, 500,"\r\n\t",true),
			'from'           => $from,
			'from_name'      => $from_name,
			'reply_to'       => $reply_to,
			'message_id'     => $header['MessageID'], 
			'custom_header'  => $header,
			'attachment'     => $attachment,
		];
		
		if(self::request($data)) {
			return true;
		} 
		
		return false;
	}

	/**
	 * request($data)
	 */
	private static function request($data)
	{	
		$send_url = !empty(Yii::$app->params['postman_domain']) ? 'https://'.Yii::$app->params['postman_domain'].'/send' : '';
		$login = !empty(Yii::$app->params['postman_login']) ? Yii::$app->params['postman_login'] : '';
		$passwd = !empty(Yii::$app->params['postman_passwd']) ? Yii::$app->params['postman_passwd'] : '';
		$data = base64_encode(serialize($data));

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $send_url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);	
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl, CURLOPT_POSTREDIR, 3);	
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(['data'=>$data]));
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			'Authorization: Basic ' . base64_encode($login . ':' . $passwd)
		]);
		
		$api_answer = curl_exec($curl);
		
		error_log($api_answer."\r\n".PHP_EOL, 3, dirname(__FILE__).'/log.log');
		
		curl_close($curl);

		if (!empty($api_answer)) {
			$result = json_decode((string) $api_answer, true);
		
			if (empty($result)) {
				error_log('Error: '.date('Y-m-d H:i:s')."\r\n".$result['message']."\r\n".PHP_EOL, 3, dirname(dirname(__FILE__)).'/runtime/logs/sendlog.log');
				return false;
			} elseif (empty($result['error'])) {
				return true;
			} else {
				error_log('Error: '.date('Y-m-d H:i:s')."\r\n".$result['message']."\r\n".PHP_EOL, 3, dirname(dirname(__FILE__)).'/runtime/logs/sendlog.log');
				return false;
			}
		}
	}	
}