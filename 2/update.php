<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        $nameError = null;
        $priceError = null;
        $quantityError = null;
        $photoError = null;
         
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $photo = $_POST['photo'];
         
        $valid = true;
        if (empty($name)) {
            $nameError = 'Пожалуйста, введите название продукта';
            $valid = false;
        }
         
        if (empty($price)) {
            $priceError = 'Пожалуйста, введите цену продукта';
            $valid = false;
        }
         
        if (empty($quantity)) {
            $quantityError = 'Пожалуйста, введите количество продукта';
            $valid = false;
        }
         
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE product  set name = ?, price = ?, quantity =?, photo = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$price,$quantity, $photo, $id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM product where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $price = $data['price'];
        $quantity = $data['quantity'];
        $photo = $data['photo'];
        Database::disconnect();
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Обновить продукт</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Название</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Цена</label>
                        <div class="controls">
                            <input name="price" type="text" placeholder="Цена" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($quantityError)?'error':'';?>">
                        <label class="control-label">Количество</label>
                        <div class="controls">
                            <input name="quantity" type="text"  placeholder="Количество" value="<?php echo !empty($quantity)?$quantity:'';?>">
                            <?php if (!empty($quantityError)): ?>
                                <span class="help-inline"><?php echo $quantityError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($photoError)?'error':'';?>">
                        <label class="control-label">Фото</label>
                        <div class="controls">
                            <input name="photo" type="text"  placeholder="Фото" value="<?php echo !empty($photo)?$photo:'';?>">
                            <?php if (!empty($photoError)): ?>
                                <span class="help-inline"><?php echo $photoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Обновить</button>
                          <a class="btn" href="index.php">Назад</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>