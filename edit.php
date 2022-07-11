<?php
  
require "./functionality/session.php";

HTTP_error_handling();

$error = null;
$errorType = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["name"]) || empty($_POST["phone_number"])) {

    $error = "Please fill all the fields.";
    $contact["name"] = $_POST["name"];
    $contact["phone_number"] = $_POST["phone_number"];

    $errorType = empty($_POST["name"])? 1:2;
  
  } else if (strlen($_POST["phone_number"]) < 9) {

    $error = "Phone number must be at least 9 characters.";
    $contact["name"] = $_POST["name"];
    $contact["phone_number"] = "";
    $errorType = 2;
    
  } else {

    $name = $_POST["name"];
    $phoneNumber = $_POST["phone_number"];

    $statement = $conn->prepare("UPDATE contacts SET name = :name, phone_number = :phone_number WHERE id = :id");
    $statement->execute([
      ":id" => $_GET["id"],
      ":name" => $_POST["name"],
      ":phone_number" => $_POST["phone_number"],
    ]);

    $_SESSION["flash"] = [
      "message" => "Contact {$_POST['name']} updated.",
      "color" => "info"
    ];

    header("Location: home.php");
    return;
  }
}
?>


<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Add New Contact</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="edit.php?id=<?= $contact['id'] ?>" name="input">
            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

              <div class="col-md-6">
                <input 
                  value="<?= $contact['name'] ?>"
                  id="name"
                  type="text"
                  class="form-control"
                  name="name"
                  autocomplete="name"
                  <?php if($errorType == 1):?> autofocus <?php endif?>
                >
              </div>
            </div>

            <div class="mb-3 row">
              <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>
              <div class="col-md-6">
                <input 
                  value="<?= $contact['phone_number'] ?>" 
                  id="phone_number" 
                  type="tel"
                  class="form-control"
                  name="phone_number"
                  autocomplete="phone_number"
                  <?php if($errorType != 1):?> autofocus <?php endif?> 
                >
              </div>
            </div>

            <div class="mb-3 row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require "partials/footer.php" ?>

