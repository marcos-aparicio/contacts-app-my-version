<?php
  
require "./functionality/session.php";


$statement = $conn->prepare("SELECT * FROM contacts WHERE id = :id LIMIT 1");
$statement->execute([":id" => $_GET["id"]]);
$contact = $statement->fetch(PDO::FETCH_ASSOC);

HTTP_error_handling($statement, $contact);

//Variables in Session Error are used
POST_edit_contact($_GET["id"],$contact);

?>


<?php require "partials/header.php" ?>

<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit Contact</div>
        <div class="card-body">
          <?php if ($_SESSION["error"]["explanation"]): ?>
            <p class="text-danger">
              <?= $_SESSION["error"]["explanation"] ?>
            </p>
          <?php endif ?>
          <form method="POST" action="edit.php?id=<?= $contact['id']?>" name="input">
            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

              <div class="col-md-6">
                <input 
                  value="<?= $_SESSION["error"]["saved_name"] ?>"
                  id="name"
                  type="text"
                  class="form-control"
                  name="name"
                  autocomplete="name"
                  <?php if($_SESSION["error"]["type"] == 1):?> autofocus <?php endif?>
                >
              </div>
            </div>

            <div class="mb-3 row">
              <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>
              <div class="col-md-6">
                <input 
                  value="<?= $_SESSION["error"]["saved_phone_number"] ?>" 
                  id="phone_number" 
                  type="tel"
                  class="form-control"
                  name="phone_number"
                  autocomplete="phone_number"
                  <?php if($_SESSION["error"]["type"] != 1):?> autofocus <?php endif?> 
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

