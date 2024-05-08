<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="/view/css/bootstrap/bootstrap.css">
    <script src="/Js/css/bootstrap.js" defer></script>
    <link rel="stylesheet" href="/view/css/myCommon.css">
    <link href="/view/img/foodtitle.png" rel="shortcut icon" type="image/x-icon">
    <title>로그인</title>
</head>

<body>
    <?php require_once("view/inc/header.php"); ?>
    <div>
        <main class="d-flex justify-content-center align-items-center h-75">
            <form action="/user/login" class="loginForm" method="post">
                <?php require_once("view/inc/errorMsg.php"); ?>
                <label for="u_email" class="form-label">이메일</label>
                <input type="text" class="form-control mb-3" id="u_email" name="u_email">
                <label for="u_pw" class="form-label mb-3">비밀번호</label>
                <input type="password" class="form-control mb-3" id="u_pw" name="u_pw">
                <button type="submit" class="btn mb-3">로그인</button>
                <a href="/user/regist" class="btn mb-3 float-end my-btn">회원가입</a>
            </form>
        </main>
    </div>
    <footer class="fixed-bottom  text-center text-light p-3">Copyright by 이서린</footer>
</body>

</html>