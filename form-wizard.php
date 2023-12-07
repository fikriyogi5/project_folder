<?php
// Load the existing configuration
require_once 'config/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $newDbHost = $_POST['db_host'];
    $newDbUser = $_POST['db_user'];
    $newDbPassword = $_POST['db_password'];
    $newDbName = $_POST['db_name'];
    $newAdminEmail = $_POST['admin_email'];

    // Update the configuration file
    $configContent = "<?php\n";
    $configContent .= "define('DB_HOST', '$newDbHost');\n";
    $configContent .= "define('DB_USER', '$newDbUser');\n";
    $configContent .= "define('DB_PASSWORD', '$newDbPassword');\n";
    $configContent .= "define('DB_NAME', '$newDbName');\n";
    $configContent .= "define('ADMIN_EMAIL', '$newAdminEmail');\n";
    $configContent .= "?>";

    file_put_contents('config/config.php', $configContent);

    echo "Configuration updated successfully";
}
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="public/css/form-wizard.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
<body>
  <!-- MultiStep Form -->
  <div class="container-fluid" id="grad1">
      <div class="row justify-content-center mt-0">
          <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
              <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                  <h2><strong>Sign Up Your User Account</strong></h2>
                  <p>Fill all form field to go to next step</p>
                  <div class="row">
                      <div class="col-md-12 mx-0">
                          <form id="msform" action="" method="post">
                              <!-- progressbar -->
                              <ul id="progressbar">
                                  <li class="active" id="account"><strong>Account</strong></li>
                                  <li id="personal"><strong>Personal</strong></li>
                                  <li id="payment"><strong>Payment</strong></li>
                                  <li id="confirm"><strong>Finish</strong></li>
                              </ul>
                              <!-- fieldsets -->
                              <fieldset>
                                  <div class="form-card">
                                      <h2 class="fs-title">Account Information</h2><form method="post" action="">
                                      <label for="db_host">Database Host:</label>
                                      <input type="text" name="db_host" value="<?= DB_HOST ?>"><br>

                                      <label for="db_user">Database User:</label>
                                      <input type="text" name="db_user" value="<?= DB_USER ?>"><br>

                                      <label for="db_password">Database Password:</label>
                                      <input type="text" name="db_password" value="<?= DB_PASSWORD ?>"><br>

                                      <label for="db_name">Database Name:</label>
                                      <input type="text" name="db_name" value="<?= DB_NAME ?>"><br>

                                  </div>
                                  <input type="button" name="next" class="next action-button" value="Next Step"/>
                              </fieldset>
                              <fieldset>
                                  <div class="form-card">
                                      <h2 class="fs-title">Personal Information</h2>

                                      <label for="admin_email">Admin Email:</label>
                                      <input type="text" name="admin_email" value="<?= ADMIN_EMAIL ?>"><br>
                                  </div>
                                  <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                  <input type="button" name="next" class="next action-button" value="Next Step"/>
                              </fieldset>
                              <fieldset>
                                  <div class="form-card">
                                      <h2 class="fs-title">Payment Information</h2>
                                      <div class="radio-group">
                                          <div class='radio' data-value="credit"><img src="https://i.imgur.com/XzOzVHZ.jpg" width="200px" height="100px"></div>
                                          <div class='radio' data-value="paypal"><img src="https://i.imgur.com/jXjwZlj.jpg" width="200px" height="100px"></div>
                                          <br>
                                      </div>
                                      <label class="pay">Card Holder Name*</label>
                                      <input type="text" name="holdername" placeholder=""/>
                                      <div class="row">
                                          <div class="col-9">
                                              <label class="pay">Card Number*</label>
                                              <input type="text" name="cardno" placeholder=""/>
                                          </div>
                                          <div class="col-3">
                                              <label class="pay">CVC*</label>
                                              <input type="password" name="cvcpwd" placeholder="***"/>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-3">
                                              <label class="pay">Expiry Date*</label>
                                          </div>
                                          <div class="col-9">
                                              <select class="list-dt" id="month" name="expmonth">
                                                  <option selected>Month</option>
                                                  <option>January</option>
                                                  <option>February</option>
                                                  <option>March</option>
                                                  <option>April</option>
                                                  <option>May</option>
                                                  <option>June</option>
                                                  <option>July</option>
                                                  <option>August</option>
                                                  <option>September</option>
                                                  <option>October</option>
                                                  <option>November</option>
                                                  <option>December</option>
                                              </select>
                                              <select class="list-dt" id="year" name="expyear">
                                                  <option selected>Year</option>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                  <input type="submit" class="next action-button" value="Update Configuration">
                                  <!-- <input type="button" name="make_payment" class="next action-button" value="Confirm"/> -->
                              </fieldset>
                              <fieldset>
                                  <div class="form-card">
                                      <h2 class="fs-title text-center">Success !</h2>
                                      <br><br>
                                      <div class="row justify-content-center">
                                          <div class="col-3">
                                              <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                          </div>
                                      </div>
                                      <br><br>
                                      <div class="row justify-content-center">
                                          <div class="col-7 text-center">
                                              <h5>You Have Successfully Signed Up</h5>
                                          </div>
                                      </div>
                                  </div>
                              </fieldset>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="public/js/form-wizard.js"></script>

</body>
</html>
