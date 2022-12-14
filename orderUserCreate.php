<?php
//DB接続関数読み込み
include('./functions/connect_to_db.php');
include('./functions/check_session_id');


if (
    !isset($_POST['name']) || $_POST['name'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''
) {
    exit('ParamError');
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
//パスワードのハッシュ化
$passwd_hash = password_hash($password, PASSWORD_DEFAULT);



//関数定義ファイルからDB接続関数呼び出す
$pdo = connect_to_db();

$sql = 'INSERT INTO order_users (id, name, email, password, created_time, update_time) VALUES (NULL, :name ,:email, :password, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

//画面遷移
header('Location:index.php');
exit();
