<?php
///////////////////////////////////////
// ホームコントローラー
///////////////////////////////////////
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';
 
include_once '../Models/tweets.php';
// ログインチェック
$user = getUserSession();
if(!$user){
  // ログインしてない場合
  header('Location: ' . HOME_URL . 'Controllers/sign-in.php');
  exit;
}
// 表示用変数
$view_user = $user;
// var_dump($user);
//////////////////////
//ツイート一覧
//////////////////////
//モデルから取得
$view_tweets = findTweets($user);

//view_tweetsを表示してみましょう
// echo('<pre>');
// print_r($view_tweets);
// echo('<pre>');

// 画面表示
include_once '../Views/home.php';