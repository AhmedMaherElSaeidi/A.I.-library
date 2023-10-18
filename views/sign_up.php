<?php session_start();
if (!isset($_SESSION['username'])) { ?>
  <html>

  <head>
    <meta charset="UTF-8" />
    <title>Library : Sign Up</title>
    <link rel="icon" href="../assets/images/ico/footerlogo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Script -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- stylesheet -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/index.css" />
    <link rel="stylesheet" href="../assets/css/sign_up.css" />
  </head>

  <body class="signup-background">
    <main>
      <section class="signup-header">
        <a href="../index.php"><img src="../assets/images/ico/footerlogo.jpg" alt="Website_Logo" /></a>
        <h1 class="txt-gold">Registration</br> Form</h1>
      </section>
      <section class="signup-body">
        <form action="../controller/auth/register_user.php" method="post">
          <section class="d-flex name-section mb-3">
            <input type="text" class="form-control" name="fname" placeholder="First Name" required>
            <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
          </section>
          <section class="mb-3">
            <input type="email" name="username" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control"
              placeholder="john@gmail.com" required>
          </section>
          <section class="mb-3 passwod-section" onchange="check_password_validity()">
            <input type="password" name="password" id="password" placeholder="********" class="form-control mb-3"
              required>
            <i class="fas fa-eye" onclick="showPassword('re-password', 1)"></i>
            <input type="password" name="re-password" id="re-password" class="form-control" placeholder="********"
              required>
            <span class="text-center text-danger" id="invalid-password" hidden>password doesn't match</span>
          </section>
          <section>
            <?php $genders = [['Male', 'M'], ['Female', 'F'], ['Other', 'NA']];
            foreach ($genders as $value) { ?>
              <section class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="<?php echo "inlineRadio" . $value[1]; ?>"
                  value="<?php echo $value[1]; ?>" required>
                <label class="form-check-label txt-gold" for="<?php echo "inlineRadio" . $value[1]; ?>">
                  <?php echo $value[0]; ?>
                </label>
              </section>
            <?php } ?>
          </section>
          <section class="submit-section">
            <button type="submit" class="btn btn-outline-warning" id="submit" name="submit" disabled>Submit</button>
            <section class="form-check form-check-inline">
              <input class="form-check-input" type="Checkbox" required></input>
              <label class="form-check-label txt-gold" for="agree" style="font-size: 15px;"> I agree with terms and
                conditions </label>
            </section>
            <a href="./sign_in.php" class="txt-gold">Already have account?login</a>
          </section>
        </form>
      </section>
    </main>
    <script src="../assets/js/functions.js"></script>
  </body>

  </html>
<?php } else {
  header('Location: ../index.php');
} ?>