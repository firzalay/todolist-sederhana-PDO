<?php
require 'db_conn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Sederhana</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main-section">
        <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if (isset($_GET['message']) && $_GET["message"] == "error") : ?>
                    <input type="text" name="title" style="border-color: red;" placeholder="This field is required">
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php else : ?>
                    <input type="text" name="title" placeholder="This field is required">
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php endif ?>

            </form>
        </div>
        <?php $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC") ?>
        <div class="show-todo-section">
            <?php if ($todos->rowCount() <= 0) : ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/f.png" width="100%">
                        <img src="img/Ellipsis.gif" width="80px">
                    </div>
                </div>
            <?php endif ?>

            <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="todo-item">
                    <span id="<?= $todo['id'] ?>" class="remove-to-do">X</span>
                    <?php if ($todo['checked']) : ?>
                        <input type="checkbox" data-todo-id="<?= $todo['id'] ?>" class="check-box" checked>
                        <h2 class="checked"><?= $todo["title"]; ?></h2>
                    <?php else :  ?>
                        <input type="checkbox" data-todo-id="<?= $todo['id'] ?>" class="check-box">
                        <h2><?= $todo["title"]; ?></h2>
                    <?php endif; ?>
                    <br>
                    <small><?= $todo["date_time"] ?></small>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.remove-to-do').click(function() {
                const id = $(this).attr('id');

                $.post("app/remove.php", {
                    id: id
                }, (data) => {
                    if (data) {
                        $(this).parent().hide(600);
                    }
                });
            })
        });

        $(".check-box").click(function(e) {
            const id = $(this).attr('data-todo-id');

            $.post('app/check.php', {
                    id: id
                },
                (data) => {
                    if (data != 'error') {
                        const h2 = $(this).next();
                        if (data === '1') {
                            h2.removeClass('checked');
                        } else {
                            h2.addClass('checked');
                        }
                    }
                });
        });
    </script>
</body>


</html>