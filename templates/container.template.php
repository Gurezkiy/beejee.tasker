<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="\css\style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Tasker</title>
</head>
    <body>
        <div id="wrapper" class="animate">
            <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
                <a class="navbar-brand" href="\">Tasker</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-md-auto d-md-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="\">Главная
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php if(!is_null($user)) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="\logout">Выйти</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="\login">Войти</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            <?php
                include $content;
            ?>
        </div>
    </body>
</html>