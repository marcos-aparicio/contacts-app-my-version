<?php 
require "partials/header.php";
?>

<div 
class="welcome d-flex align-items-center justify-content-center"
  <?php if($color == "light"): ?>    
    style = "background: url('./static/img/light_background.jpg');"
  <?php else: ?>
    style = "background: url('./static/img/background.jpg');"
  <?php endif ?>
>
  <div class="text-center text-white">
    <h1>Store Your Contacts Now</h1>
    <a class="btn btn-lg btn-<?=$color?>" href="register.php">Get Started</a>
  </div>
</div>

<?php require "partials/footer.php" ?>
