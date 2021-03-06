<?php //require_once('external_html.php'); ?>
<?php require_once('external_php.php'); ?>
<?php require_once('connection.php'); ?>

<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  } 

  if (isset($_SESSION['position'])) {
      if ($_SESSION['position']!='admin') {
          header('Location:login.php');
      }
  }else{
    header('Location:login.php');
  }
?>

<?php

  $error=array();
  $lenth_error=array();

  if (isset($_POST['game_submit'])) {

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $dvd = mysqli_real_escape_string($conn,$_POST['dvd']);
    $tag = mysqli_real_escape_string($conn,$_POST['tag']);

    //check empty fild......
    $req_field = array('name','description','tag','dvd');
    $error=array_merge($error, check_empty($req_field));

    //check lenth ..........
    $max_length = array('description'=>800,'name'=>100,'tag'=>800);
    $lenth_error=array_merge($lenth_error, check_length($max_length));

    //check image............
    if (preg_match("!image!",$_FILES['image']['type'])) {
      $image = mysqli_real_escape_string($conn,'img/games/'.$name.$_FILES['image']['name']);
      if (copy($_FILES['image']['tmp_name'],$image)) {
        $date = date('d-m-y h:i:s');
        if (empty($error)&&empty($lenth_error)) {
          $query = "INSERT INTO games(name,description,dvd,available,tag,img) VALUES('{$name}','{$description}',{$dvd},'{$date}','{$tag}','{$image}')";
          $result = mysqli_query($conn , $query);
          if ($result) {
            $msg = ("game added");
            // if (mail($mail,$title,$msg,$header)) {
            //     echo '<script type="text/javascript">';
            //       echo 'alert(\'payment succed. check your mail.\')';
            //     echo '</script>';
            // }else{
            //     echo '<script type="text/javascript">';
            //       echo 'alert(\'payment succed. But can\'t send mail.!!!\')';
            //     echo '</script>';
            // }
            
          }else{
            $error[]="Query error";
          }
        }
      }
    }else{
      $error[]="invalid image type";
    }
  }


  if (isset($_POST['movie_submit'])) {

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $language = mysqli_real_escape_string($conn,$_POST['language']);
    $tag = mysqli_real_escape_string($conn,$_POST['tag']);

    //check empty fild......
    $req_field = array('name','description','language','tag');
    $error=array_merge($error, check_empty($req_field));

    //check lenth ..........
    $max_length = array('description'=>800,'name'=>100,'language'=>50,'tag'=>800);
    $lenth_error=array_merge($lenth_error, check_length($max_length));

    //check image............
    if (preg_match("!image!",$_FILES['image']['type'])) {
      $image = mysqli_real_escape_string($conn,'img/movies/'.$name.$_FILES['image']['name']);
      if (copy($_FILES['image']['tmp_name'],$image)) {
        $date = date('d-m-y h:i:s');
        if (empty($error)&&empty($lenth_error)) {
          $query = "INSERT INTO movies(name,description,available,language,tag,img) VALUES('{$name}','{$description}','{$date}','{$language}','{$tag}','{$image}')";
          $result = mysqli_query($conn , $query);
          if ($result) {
            $msg = ("Movie added");
            // if (mail($mail,$title,$msg,$header)) {
            //     echo '<script type="text/javascript">';
            //       echo 'alert(\'payment succed. check your mail.\')';
            //     echo '</script>';
            // }else{
            //     echo '<script type="text/javascript">';
            //       echo 'alert(\'payment succed. But can\'t send mail.!!!\')';
            //     echo '</script>';
            // }
            
          }else{
            $error[]="Query error";
          }
        }
      }
    }else{
      $error[]="invalid image type";
    }
  }


 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Add Movies</title>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="shortcut icon" href="img/titlelogo.png" type="image/png">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

      <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- menu -->
    <div class="wrappage">
        <header id="header" class="header-v2">
            <div class="header-top-banner">
                <a href="home2.php"><img src="img/banner-top.jpg" alt="" class="img-reponsive"></a>
            </div>
            
            <!-- end menu -->
            
            <div class="header-bottom hidden-xs hidden-sm">
                <div class="flex lr">
                    <div class="box-header-nav">
                        <nav class="main-menu">
                            <ul class="nav navbar-nav">
                                <li class="level1 active hassub">Home
                                    <span class="plus js-plus-icon"></span>
                                    <div class="menu-level-1 ver2 dropdown-menu">
                                        <div class="row">
                                            <div class="cate-item col-md-4 col-sm-12">
                                                <div class="demo-img">
                                                    <a href="movieshome.php">
                                                        <img src="img/demo/movies.jpg" alt="" class="img-reponsive">

                                                    </a>
                                                </div>
                                                <div class="demo-text">Movies\TV Series</div>
                                            </div>
                                            <div class="cate-item col-md-4 col-sm-12">
                                                <div class="demo-img">
                                                    <a href="gameshome.php"><img src="img/demo/games.jpg" alt="" class="img-reponsive"></a>
                                                </div>
                                                <div class="demo-text">Games</div>
                                            </div>
                                            <div class="cate-item col-md-4 col-sm-12">
                                                <div class="demo-img">
                                                    <a href="accessorieshome.php"><img src="img/demo/accessories.jpg" alt="" class="img-reponsive"></a>
                                                </div>
                                                <div class="demo-text">Accessories</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php 
                                    $sql = "SELECT  DISTINCT(language) FROM movies LIMIT 5";
                                    $result = mysqli_query($conn,$sql);
                                    if ($result) {
                                        if (mysqli_num_rows($result)>0) {
                                            while ($detail=mysqli_fetch_assoc($result)) {
                                                echo '<li class="level1"><a href="movieshome.php?filter='.$detail['language'].'"> '.$detail['language'].' </a></li>';
                                            }
                                        }
                                    }
                                ?>
                            </ul>
                        </nav>
                    </div>
                    <div class="box-header-menu">
                        <nav class="main-menu">
                            <ul class="nav navbar-nav">
                                <ul class="nav navbar-nav">
                                    <li class="level1"><a href="accessorieshome.php?sort=discountza">Flash Deals<span class="h-ribbon h-pos v4 e-skyblue">Dis</span></a></li>
                                    <li class="level1"><a href="accessorieshome.php?sort=newaz">Tech Discovery<span class="h-ribbon h-pos e-green v4">new</span></a></li>
                                    <li class="level1"><a href="accessorieshome.php?sort=newaz">Trending Styles<span class="h-ribbon h-pos v4 e-red">hot</span></a></li>
                                    <li class="level1"><a href="accessorieshome.php?sort=discountza">Gift Cards </a></li>
                                </ul>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- /header -->
        <!--content-->
        <div class="container container-240">
            
            <div class="myaccount">
                <ul class="breadcrumb v3">
                    <li><a href="admin_dashbord.php">Admin</a></li>
                    <li class="active">Add Games/Movies</li>
                </ul>
                <div class="row flex pd">
                    <div class="account-element bd-7 e-left">
                        <div class="cmt-title text-center abs">
                            <h1 class="page-title v1">Games</h1>
                        </div>
                        <div class="page-content">
                            <p>Add a Game</p>
                            <form class="login-form" method="post" action="addmovies.php" enctype = "multipart/form-data">
                                <div class="alert-danger"><p id="error"><?php print_error($error,$lenth_error); ?></p></div>
                                <div class="alert-success"><p id="msg"></p></div>
                                  <div class="form-group">
                                    <label>Game name <span class="f-red">*</span></label>
                                    <input type="text" id="name" class="form-control bdr" name="name" value="">
                                    <label>Description <span class="f-red">*</span></label>
                                    <input type="text" id="description" class="form-control bdr" name="description" value="">
                                    <label>Number of DVD <span class="f-red">*</span></label>
                                    <input type="Number" id="dvd" class="form-control bdr" name="dvd" value="1">
                                    <label>Tags <span class="f-red">*</span></label>
                                    <input type="text" id="tag" class="form-control bdr" name="tag" value="">
                                    <label>Image <span class="f-red">*</span></label>
                                    <input class="form-control bdr" type="file" name="image" id="image" accept="image/*">
                                  </div>
                                  <div class="flex lr">
                                      <button type="submit" name="game_submit" class="btn btn-submit btn-gradient">
                                          Add
                                      </button>
                                  </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="account-element bd-7 e-left">
                        <div class="cmt-title text-center abs">
                            <h1 class="page-title v1">Movies</h1>
                        </div>
                        <div class="page-content">
                            <p>Add a movie</p>
                            <form class="login-form" method="post" action="addmovies.php" enctype = "multipart/form-data">
                                <div class="alert-danger"><p id="error"><?php print_error($error,$lenth_error); ?></p></div>
                                <div class="alert-success"><p id="msg"></p></div>
                                  <div class="form-group">
                                    <label>Movie name <span class="f-red">*</span></label>
                                    <input type="text" id="name" class="form-control bdr" name="name" value="">
                                    <label>Description <span class="f-red">*</span></label>
                                    <input type="text" id="description" class="form-control bdr" name="description" value="">
                                    <label>Language <span class="f-red">*</span></label>
                                    <input type="text" id="language" class="form-control bdr" name="language" value="">
                                    <label>Tags <span class="f-red">*</span></label>
                                    <input type="text" id="tag" class="form-control bdr" name="tag" value="">
                                    <label>Image <span class="f-red">*</span></label>
                                    <input class="form-control bdr" type="file" name="image" id="image" accept="image/*">
                                  </div>
                                  <div class="flex lr">
                                      <button type="submit" name="movie_submit" class="btn btn-submit btn-gradient">
                                          Add
                                      </button>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="e-category">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h1 class="cate-title">Last Added Games</h1>
                        <div class="cate-item">
                            <?php
                                $sql = "SELECT * FROM games ORDER BY id DESC LIMIT 5";
                                $result = mysqli_query($conn,$sql);
                                if ($result) {
                                    if (mysqli_num_rows($result)>0) {
                                        while($detail=mysqli_fetch_assoc($result)){
                                            echo '<div class="product-img">';
                                            echo '<a href="gameshome.php?filter='.$detail['id'].'"><img src="'.$detail['img'].'" alt="" class="img-reponsive"></a>';
                                            echo '</div><div class="product-info">';
                                            echo '<h3 class="product-title"><a href="gameshome.php?filter='.$detail['id'].'">'.$detail['name'].' </a></h3>';
                                            echo '<div class="product-price v2"><span>'.$detail['description'].'</span></div>';
                                            echo '</div>';
                                        }
                                    }
                                }
                            ?>  
                        </div>  
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h1 class="cate-title">Last Added Movies</h1>
                        <div class="cate-item">
                            <?php
                                $sql = "SELECT * FROM movies ORDER BY id DESC LIMIT 5";
                                $result = mysqli_query($conn,$sql);
                                if ($result) {
                                    if (mysqli_num_rows($result)>0) {
                                        while($detail=mysqli_fetch_assoc($result)){
                                            echo '<div class="product-img">';
                                            echo '<a href="movieshome.php?filter='.$detail['id'].'"><img src="'.$detail['img'].'" alt="" class="img-reponsive"></a>';
                                            echo '</div><div class="product-info">';
                                            echo '<h3 class="product-title"><a href="movieshome.php?filter='.$detail['id'].'">'.$detail['name'].' </a></h3>';
                                            echo '<div class="product-price v2"><span>'.$detail['description'].'</span></div>';
                                            echo '</div>';
                                        }
                                    }
                                }
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- / end content -->
        <footer>

        <?php require_once('footer.php'); ?>
        <?php require_once('dev_footer.php'); ?>
            
        </footer>
        <!-- /footer -->
        <!-- /footer -->
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/slick.min.js"></script>
    
    <script src="js/main.js"></script>

      <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>