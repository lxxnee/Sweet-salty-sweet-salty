<header>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand " href="#">단짠단짠</a>
            <?php if ($_GET["url"] !== "user/login" && $_GET["url"] !== "user/regist") {
            ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                맛집
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                foreach ($this->arrBoardsNameInfo as $item) {
                                    $url = $item["b_type"] == 2 ? "/food/goodPlace.php" : "/board/list?b_type=" . $item["b_type"];
                                ?>
                                    <li><a class="dropdown-item" href="<?php echo $url ?>"><?php echo $item["bn_name"] ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <a href="/user/edit" class="navbar-nav nav-link text-light" role="button"><?php isset($_SESSION["u_id"]) ? print("회원정보수정") : print(""); ?></a>
                    <a href="/user/logout" class="navbar-nav nav-link text-light" role="button"><?php isset($_SESSION["u_id"]) ? print("Log Out") : print("Log In"); ?></a>
                </div>
            <?php
            }
            ?>
        </div>
    </nav>
</header>