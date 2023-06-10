<?php
// エラー表示
ini_set('display_errors', 1);
// 日本時間の設定
date_default_timezone_set('Asia/Tokyo');
// URL/ディレクトリの置き換え設定
define('HOME_URL','/TwitterClone/');
// データベースの接続情報
define('DB_HOST','localhost');
define('DB_USER','dbuser');
define('DB_PASSWORD','Sada2211!');
define('DB_NAME','twitter_clone');
// 　★ローカル環境で動かすためには以下部分をコメントアウトしてください
// define('DB_HOST','localhost');
// define('DB_USER','root');
// define('DB_PASSWORD','root');
// define('DB_NAME','twitter_clone');