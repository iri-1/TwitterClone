<?php
///////////////////////
///////便利な関数
//////////////////////
/**
 * 画像のファイル名から画像のURLを作成する
 * @param string $name 画像のファイル名
 * @param string $type user | tweet
 * return string
 */
function buildImagePath(string $name = null, string $type)
{
    if ($type === 'user' && !isset($name)) {
        return HOME_URL . 'Views/img/icon-default-user.svg';
    }
 
    return HOME_URL . 'Views/img_uploaded/' . $type . '/' . htmlspecialchars($name);
}

// 指定した日時からどれだけ通過したかを取得する
// @para string $datetime 日時
// @return string
function convertToDayTimeAgo(string $datetime)
{
    $unix = strtotime($datetime);
    $now = time();
    $diff_sec = $now - $unix;
 
    if ($diff_sec < 60) {
        $time = $diff_sec;
        $unit = '秒前';
    } elseif ($diff_sec < 3600) {
        $time = $diff_sec / 60;
        $unit = '分前';
    } elseif ($diff_sec < 86400) {
        $time = $diff_sec / 3600;
        $unit = '時間前';
    } elseif ($diff_sec < 2764800) {
        $time = $diff_sec / 86400;
        $unit = '日前';
    } else {
 
        if (date('Y') !== date('Y', $unix)) {
            $time = date('Y年n月j日', $unix);
        } else {
            $time = date('n月j日', $unix);
        }
        return $time;
    }
 
    return (int)$time . $unit;
}

/**ユーザー情報をセッションに保存する関数
 * @param array $user
 * @return void
 */
function saveUserSession(array $user){
// セッションを開始していない場合
if (session_status() === PHP_SESSION_NONE){
    // セッション開始
    session_start();
}
$_SESSION['USER'] = $user;
}

/**ユーザー情報をセッションから削除する関数
 * @return void
 */
function deleteUserSession(){
// セッションを開始してない場合
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
// セッションのユーザー情報を削除
unset($_SESSION['USER']);
}

/**セッションのユーザー情報を収得
 *
 * @return array|false
 */
function getUserSession()
{
// セッションを開始していない場合
if(session_status() === PHP_SESSION_NONE){
    // セッション開始
    session_start();
}
if(!isset($_SESSION['USER']))
{
    // セッションにユーザー情報がない
    return false;
}
$user = $_SESSION['USER'];

// 画像のファイル名からファイルのURLを取得
$user['image_path'] = buildImagePath($user['image_name'], 'user');

return $user;
}