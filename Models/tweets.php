<?php
////////////////////////
///ツイートデータを処理
////////////////////////
/**
 * ツイート作成
 * @param array $data
 * @return bool
 */
function createTweet(array $data){
// DB接続
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// 接続エラーがある場合ー＞処理停止
if ($mysqli->connect_errno) {
  echo 'MySQLの接続に失敗しました。:' .$mysqli->connect_errno ."¥n";
  exit;
}

// 新規登録のSQLクエリを作成
$query = 'INSERT INTO tweets(user_id, body, image_name) VALUES (?, ?, ?)';

// プリペアドステートメントに、作成クエリを登録
$statement = $mysqli->prepare($query);

// クエリのプレースホルダ(?の部分)にカラム値を紐つけ(i=int,s=string)
// プリペアドステートメントのパラメータに変数をバインドする
$statement->bind_param('iss',$data['user_id'], $data['body'], $data['image_name'],);

// クエリを実行  executeはsqliのメソッド(関数に近い)
$response = $statement->execute();

// 実行に失敗した場合ー＞エラーを表示
if($response === false) {
  echo 'エラーメッセージ' .$mysqli->error . "¥n";
}

// DB接続を開放
$statement->close();
$mysqli->close();

return $response;
}