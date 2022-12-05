<?php


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
            <a href="./mypage.php">
                <img src="./img/mypage.png" alt="マイページアイコン">
            </a>
        </nav>
    </header>

    <main>
        <div class="signup-form">
            <h2>発注者アカウント新規登録</h2>
            <p>発注者をしたい方は下記からご登録ください</p>
            <form class="form-area" action="./orderUserCreate.php" method="POST">
                <label for="name">ユーザー名</label>
                <input type="text" id="name" name="name" placeholder="ユーザー名を入力してください">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="メールアドレスを入力してください">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="パスワードを入力してください">
                <label for="conf-password">確認パスワード</label>
                <input type="password" id="conf-password" name="conf-password" placeholder="パスワードを入力してください">
                <button>登録</button>
            </form>
        </div>
    </main>




</body>

</html>