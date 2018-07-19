<?php 

include "koneksi.php";

  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM tb_user WHERE username = '$username' AND password = md5('$password')";

  $sql = mysqli_query($conn,$query);

  if (mysqli_num_rows($sql) > 0) {

    $data = mysqli_fetch_assoc($sql);

    // set session
    session_start();
    $_SESSION["username"] = $data['username'];
    $_SESSION["level"] = $data['level'];
    // end set session

    header("Location: home.php?link=dashboard");
    // if ($data['level'] == 1) {
    //   header("Location: admin/home.php?link=0");
    // }else{
    //   header("Location: user/home.php?link=0");
    // }


  }else{

    header("Location: index.php");
  }

 ?>