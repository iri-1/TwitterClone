<?php
////////////////
//ライクコントローラー
///////////////
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';
 //いいね！データ操作モデルを読み込む
include_once '../Models/likes.php';

// ログインチェック
$user = getUserSession();
if(!$user){
  // ログインしてない場合
  //404エラー
  header('HTTP/1.0 404 Not Found');
  exit;
}

//----------------------
// いいね！する
//----------------------
$like_id = null;
//tweet_idがPOSTされた場合
if(isset($_POST['tweet_id'])){
  $data = [
    'tweet_id' => $_POST['tweet_id'],
    'user_id' => $user['id'],
  ];
  //いいね！登録
  $like_id = createLike($data);
}

//----------------------
// いいね！取り消し
//----------------------
//like_idがPOSTされた場合
if(isset($_POST['like_id'])){
  $data = [
    'like_id' => $_POST['like_id'],
    'user_id' => $user['id'],
  ];
  //いいね！削除
  deleteLike($data);
}

//----------------------
// json式で結果を返す
//----------------------
$response = [
'message' => 'successful',
'like_id' => $like_id,
];
header('content-Type: application/json; charset=uft-8');
echo json_encode($response);