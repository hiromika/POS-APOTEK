<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

  <script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
  <style type="text/css">
    body{
      background-color: #ddd;>                                                                                          
    }
    .judul{
      margin: 80px 0 20px 0;
      color: white;
      text-shadow: 2px 2px 2px black;
      font-family: serif;
    }
    .bungkus{
      min-height: 350px;
      width: 80%;
      margin: 0 auto 0 auto;
      background: linear-gradient(45deg, #003399,#fff);
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0px 0px 10px 2px white;
    }
    .img-login{
      margin: 20px 0;
      border: 2px solid gray;
    }
    .login{
      padding: 0px 20px;
    }
    label{
      color: black;
    }
  </style>
</head>
<body style="background-color: rgb(255,255,255,255.3);">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 col-sm-12">
      <center><h1 class="judul">APOTEK NUSA INDAH</h1></center>
      <div class="bungkus text-center">
        <center><img src="assets/img/logo.jpg" width="150px" height="150px" style="color:black" class="img-login img-thumbnail"></center>        
        <form action="proses_login.php" method="POST" class="login">
          <div class="form-group">
            <label for="username">USERNAME</label>
            <input type="text" name="username" id="username" class="form-control";>
          </div>
          <div class="form-group">
            <label for="password">PASSWORD</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Login" class="btn btn-sm btn-info">
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-4"><!-- Kosong --></div>
  </div>
  <script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
