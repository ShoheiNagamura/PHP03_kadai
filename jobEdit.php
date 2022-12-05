<?php
//DB接続関数読み込み
include('./functions/connect_to_db.php');

// id受け取り
$id = $_GET['id'];


// DB接続
$pdo = connect_to_db();


// SQL実行
$sql = 'SELECT * FROM job_project WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

$result = $stmt->fetch(PDO::FETCH_ASSOC);

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
                <li class="job">案件管理
                    <ul class="job-down">
                        <a href="./jobInput.php">
                            <li class="job-input">案件登録</li>
                        </a>
                        <a href="./jobInputList.php">
                            <li class="job-list">案件管理一覧</li>
                        </a>
                    </ul>
                </li>
            </ul>
            <a href="./mypage.php">
                <img src="./img/mypage.png" alt="マイページアイコン">
            </a>
        </nav>
    </header>

    <main>
        <h2 class="jobTitle">案件内容編集</h2>
        <form class="jobUpdate" action="./jobUpdate.php" method="POST">
            <div>
                <label for="jobName">案件名（必須）</label>
                <input type="text" id="jobName" name=" jobName" placeholder="案件名をご入力ください" value="<?= $result['jobName'] ?>">
            </div>
            <div>
                <label for="status">募集状況（必須）</label>
                <select name="status" id="status" value="<?= $result['status'] ?>">
                    <option value="募集中">募集中</option>
                    <option value="急募">急募</option>
                    <option value="募集終了">募集終了</option>
                </select>
            </div>
            <div>
                <label for="place">場所（必須）</label>
                <input type="text" id="place" name="place" placeholder="お仕事の場所をご入力ください" value="<?= $result['place'] ?>">
            </div>
            <div>
                <label for="schedule">日程</label>
                <input type="text" id="schedule" name="schedule" placeholder="日程をご自由にご記載ください" value="<?= $result['schedule'] ?>">
            </div>
            <div>
                <label for="TransportationCosts">交通費</label>
                <input type="text" id="TransportationCosts" name="TransportationCosts" placeholder="交通費の金額をご入力ださい" value="<?= $result['TransportationCosts'] ?>">
            </div>
            <div>
                <label for="deadline">募集期限</label>
                <input type="date" id="deadline" name="deadline" value="<?= $result['deadline'] ?>">
            </div>
            <div>
                <label for="content">案件内容</label>
                <textarea name="content" id="content" cols="30" rows="10" placeholder="案件の内容を詳しくご記載ください"><?= $result['content'] ?></textarea>
            </div>
            <button>更新</button>
            <input type="hidden" name="id" value="<?= $id ?>">
        </form>
        <a href="./jobInputList.php"><button class="return">戻る</button></a>

    </main>


</body>

</html>