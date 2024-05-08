<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="/view/css/bootstrap/bootstrap.css">
    <script src="/Js/bootstrap.js" defer></script>
    <link rel="stylesheet" href="/view/css/myCommon.css">
    <link href="/view/img/foodtitle.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/Js/board.js" defer></script>
    <title>맛집 저장소</title>
</head>

<body>
    <!-- 헤더 -->
    <?php require_once("view/inc/header.php"); ?>
    <div class="mb-3">
        <div class=" text-center place-title">
            <h1 class=" good-h1 animate__animated animate__bounce animate__delay-2s"><?php echo $this->boardName ?></h1>
        </div>
        <div class="text-right">
        <img src="data:image/png;base64,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"
        fill="currentColor" class="bi bi-chat-square-heart-fill" viewBox="0 0 16 16" data-bs-toggle="modal" data-bs-target="#modalInsert">
        <path d="M2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
        </div>
    </div>
    <main>
        <?php
        foreach ($this->arrBoardList as $item) {
        ?>
            <div class="card" id="card<?php echo $item["b_id"]; ?>">
                <img src="<?php echo $item["b_img"] ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $item["b_title"] ?></h5>
                    <p class="card-text"><?php echo $item["b_content"] ?></p>
                    <button class="btn my-btn-detail" data-bs-toggle="modal" data-bs-target="#modalDetail" value="<?php echo $item["b_id"] ?>">상세</button>
                </div>
            </div>
        <?php
        }
        ?>
    </main>
    <footer class="fixed-bottom  text-center text-light p-3">Copyright by 이서린</footer>
    <!-- 상세 모달 -->
    <div class="modal" tabindex="-1" id="modalDetail">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title">개발자입니다.</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>힘들다..</p>
                        <br>
                        <img src="" class="card-img-top">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div>
                            <button id="my-btn-delete" type="button" class="btn " data-bs-dismiss="modal">삭제</button>
                        </div>
                        <button type="button" class="btn" data-bs-dismiss="modal">닫기</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 작성 모달 -->
    <div class="modal" tabindex="-1" id="modalInsert">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/board/add" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="b_type" value="<?php echo $this->getBoardType(); ?>">
                    <div class="modal-header">
                        <input type="text" name="b_title" class="form-control" placeholder="제목을 입력하세요">
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" name="b_content" cols="30" rows="10" placeholder="내용을 입력하세요"></textarea>
                        <br>
                        <br>
                        <input type="file" name="img" accept="image/*" id="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn " data-bs-dismiss="modal">닫기</button>
                        <button type="submit" class="btn">작성</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>