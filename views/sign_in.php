<?php session_start();
if (!isset($_SESSION['username'])) { ?>
  <html>

  <head>
    <meta charset="UTF-8" />
    <title>Library : Sign In</title>
    <link rel="icon" href="../assets/images/ico/footerlogo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Script -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- stylesheet -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/index.css" />
    <link rel="stylesheet" href="../assets/css/sign_in.css" />
  </head>

  <body class="signin-background">
    <main>
      <section class="signin-header">
        <a href="../index.php" title="Home"><img src="../assets/images/ico/footerlogo.jpg" alt="Website_Logo" /></a>
      </section>

      <section class="signin-body">
        <form action="../controller/auth/sign_in.php" method="post">
          <?php if (isset($_GET['msg'])) { ?>
            <section class="mb-1 text-danger fw-bold">
              <?php echo '*' . $_GET['msg']; ?>
            </section>
          <?php } ?>
          <section class="mb-3">
            <input type="email" name="username" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
              class="form-control" placeholder="Email: john@gmail.com">
          </section>
          <section class="mb-3 input-password">
            <input type="password" id="password" name="password" required placeholder="Password" class="form-control">
            <i class="fas fa-eye" onclick="showPassword()"></i>
          </section>
          <section class="mb-3 submit-section">
            <button type="submit" id="signin" name="signin" class="btn btn-outline-warning">Sign In</button>
            <a class="txt-gold" href="./sign_up.php">Register?Don't have account...</a>
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