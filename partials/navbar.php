<nav class="navbar navbar-expand-lg navbar-<?= $color ?> bg-<?= $color ?> px-0">
  <div class="container-fluid">
    <a class="navbar-brand font-weight-bold" href="index.php">
      <img class="mr-2" src="./static/img/logo.png" />
      ContactsApp
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="d-flex justify-content-between w-100 align-items-center">
        <ul class="navbar-nav">
          <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add.php">Add Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php endif ?>
        </ul>
        <div class="p-2 d-flex align-items-center">
        <?php if ($color == 'light'): ?>
          <a class = "border-dark btn rounded-circle" href = "./theme_changes/theme.php?color=dark">
            <i class="fa-solid fa-moon"></i>
          </a>
        <?php else: ?>
          <a class = "border-light btn rounded-circle" href = "./theme_changes/theme.php?color=light">
            <i class="fa-solid fa-sun"></i>
          </a>
        <?php endif ?>

        <?php if (isset($_SESSION['user'])): ?>
            <span class = "ms-5 ml-5">
              <?= $_SESSION['user']['email'] ?>
            </span>
            <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</nav>
