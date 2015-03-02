<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>CRUD для перечня продуктов</h3>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Создать запись</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Название продукта</th>
                      <th>Цена</th>
                      <th>Количество</th>
                      <th>Фото</th>
                      <th>Дата создания</th>
                      <th>Действия</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM product ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['price'] . '</td>';
                            echo '<td>'. $row['quantity'] . '</td>';
                            echo '<td>'. $row['photo'] . '</td>';
                            echo '<td>'. $row['date_time'] . '</td>';
                            echo '<td width=250>';
                                echo '<a class="btn" href="read.php?id='.$row['id'].'">Посмотреть</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Обновить</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Удалить</a>';
                                echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div>
  </body>
</html>