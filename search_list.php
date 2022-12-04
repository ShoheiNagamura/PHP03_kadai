<?php
//DB接続
$dbn = 'mysql:dbname=kadai;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}

//selectのSQLクエリ用意
$sql = 'SELECT * FROM seller_users order by update_time DESC';
$stmt = $pdo->prepare($sql);

//SQL実行するがまだデータの取得はできていない
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

//fectchAllでデータの取得
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    // PHPではデータを取得するところまで実施
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// echo "<pre>";
// var_dump($result);
// echo "</pre>";

$output = "";

foreach ($result as $record) {
    $output .= "
        <div class='seller-items'>
            <p class='seller-item seller-name'>名前: {$record["name"]}</p>
            <p class='seller-item seller-email'>Email: {$record["email"]}</p>
            <p class='seller-item seller-update_time'>更新日: {$record["update_time"]}</p>
        </div>
    ";
}



?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>PHP課題02</title>
</head>

<body>
    <header>
        <div class="header-title">
            <a href="./index.php">
                <h1>ご依頼マッチングサイト</h1>
            </a>
        </div>
        <nav>
            <ul class="header-nav">
                <a href="./search_list.php">
                    <li>依頼できる人一覧</li>
                </a>
                <li class="signup">新規登録
                    <ul class="signup-down">
                        <a href="./order_signup.php">
                            <li class="order-signup">発注者登録</li>
                        </a>
                        <a href="./seller_signup.php">
                            <li class="seller-signup">販売者登録</li>
                        </a>
                    </ul>
                </li>
                <li class="login">ログイン
                    <ul class="login-down">
                        <a href="./order_login.php">
                            <li class="order-login">発注者ログイン</li>
                        </a>
                        <a href="./seller_login.php">
                            <li class="seller-login">販売者ログイン</li>
                        </a>
                    </ul>
                </li>
                <a href="./question.php">
                    <li>よくある質問</li>
                </a>
                <a href="./contact.php">
                    <li>お問い合わせ</li>
                </a>
            </ul>
        </nav>
    </header>

    <main>
        <div class="main-area">
            <h2>ご依頼する方をお選びください</h2>
            <div class="hoge-area">
                <?= $output ?>
            </div>
        </div>


    </main>


</body>

</html>