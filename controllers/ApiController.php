<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use app\models\User;
use app\models\Comment;

class ApiController extends Controller
{
	// fixer.io api token
	public $token = 'a77ce158752393317cef33a608245383';

	public function actionIndex()
	{
		// $url = 'http://data.fixer.io/api/latest?access_key='.$token;
		// $client = new Client();
		// $response = $client->createRequest()
		//     ->setMethod('GET')
		//     ->setUrl('http://data.fixer.io/api/latest?access_key=a77ce158752393317cef33a608245383&symbols=USD,RUB,BRL,JPY,ANG,UZS&format=1')
		//     ->send();

	 //    $newUserId = $response->data;
	   

		// return $this->render('index', [
		// 	'data' => $newUserId,
		// 	'data_uz' => $newUserId['rates']['UZS']
		// ]);

		$url = 'a77ce158752393317cef33a608245383';
		$client = new Client();
		$response = $client->createRequest()
		    ->setMethod('GET')
		    ->setUrl('http://data.fixer.io/api/latest?access_key=a77ce158752393317cef33a608245383&symbols=USD,RUB,BRL,JPY,ANG,UZS&format=1')
		    ->send();

	    $newUserId = $response->data;
	   	
	   	$comments = Comment::find()->with('user')->where(['status' => 1])->orderBy(['id' => SORT_DESC])->asArray()->all();
	   	

		return $this->render('index', [
			'data' => $newUserId,
			'data_uz' => $newUserId['rates']['UZS'],
			'comments' => $comments
		]);
	}

	public function actionComment()
	{
		$post = Yii::$app->request->post('comment-field');
		$user = Yii::$app->user->identity;
		if (!empty($post)) {
			$model = new Comment();
			$model->user_id = $user->id;
			$model->content = $post;
			$model->status = 1;
			$model->created_at = time();
			if ($model->save()) {
				$lastComment = Comment::find()->with('user')->where(['status' => 1])->orderBy(['id' => SORT_DESC])->asArray()->one();
				if ($lastComment) {
					$lastComment['created_at'] = date('Y-m-d H:i:s', $lastComment['created_at']);
					return json_encode($lastComment);
				}				
			}
			return false;
		}
	}

} 