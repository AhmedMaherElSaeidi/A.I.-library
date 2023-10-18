<?php session_start();
if (isset($_SESSION['username'])) { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <title>Library : Cart</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="../assets/images/ico/footerlogo.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Script -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- stylesheet -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/footer.css" />
    <link rel="stylesheet" href="../assets/css/index.css" />
    <link rel="stylesheet" href="../assets/css/cart.css" />
  </head>
  <?php
  include "../models/Database.php";
  include "../models/ORM.php";

  $db = new DataBase('library');
  $is_admin = isset($_SESSION['username']) && $_SESSION['role'] === 'admin';
  $is_loggedin = isset($_SESSION['username']);

  if (!$db->connect())
    die('Server Connection Error');

  $orm = new ORM($db);
  $is_index_set = isset($_GET['index']) ? True : False;
  ?>

  <body class="cart-background ">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <section class="container-fluid">
        <a class="navbar-brand" href="../index.php"><img src="../assets/images/ico/logo.jpg" alt="Website_Logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <section class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="../index.php"><i class="fas fa-home"> HOME</i></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Categories
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <?php foreach ($orm->select("category") as $category) {
                  if ($is_index_set && $category['category'] == $_GET['index'])
                    continue;
                  ?>
                  <li><a class="dropdown-item" href="../index.php?index=<?php echo $category['category'] ?>">
                      <?php echo $category['category'] ?>
                    </a></li>
                <?php } ?>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Options
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <?php
                if ($is_admin) { ?>
                  <li><a class="dropdown-item" href="./settings.php?view=1"><i class="fas fa-cog"></i> Settings</a></li>
                <?php } ?>
                <?php if ($is_loggedin) { ?>
                  <li><a class="dropdown-item" href="./account_info.php">
                      <i class="fas fa-user-circle"></i> User Account</a>
                  </li>
                  <li><a class="dropdown-item" href="../controller/auth/logout.php"><i class="fas fa-sign-out-alt"></i>
                      Logout</a></li>
                <?php } else { ?>
                  <li><a class="dropdown-item" href="./sign_in.php"><i class="fas fa-sign-in-alt"></i> Log In</a></li>
                <?php } ?>
              </ul>
            </li>
            <?php
            if (!$is_admin && $is_loggedin) { ?>
              <li class="nav-item">
                <a class="nav-link  active" href="./cart.php">Cart</a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="./aboutus.php">About Us</a>
            </li>
          </ul>
          <section class="profile-section">
            <img
              src="../assets/images/uploads/<?php echo $_SESSION['user_profile'] != 'null' ? $_SESSION['user_profile'] : "default-profile.jpg" ?>"
              alt="">
            <section>
              <p><a href="./account_info.php">
                  <?php echo $_SESSION['fullname']; ?>
                </a></p>
            </section>
          </section>
        </section>
    </nav>

    <main onchange="calculate_cart_receipt()" class="small-container cart-page">
      <table>
        <thead>
          <th>
            <h3>Books</h3>
          </th>
          <th>
            <h3>Amount</h3>
          </th>
        </thead>
        <tbody>
          <?php
          $cart_items = $orm->select_cart('cart.user_id', $_SESSION['user_id']);
          if (count($cart_items) > 0) {
            foreach ($cart_items as $item) {
              ?>
              <tr>
                <td>
                  <section class="card">
                    <section>
                      <img src="<?php echo '../assets/images/uploads/' . $item['book_cover']; ?>"
                        alt="<?php echo $item['book_cover']; ?>">
                    </section>
                    <section class="card-body">
                      <h5 class="card-title <?php echo $item['book_language'] == 'ar' ? "text-end" : ""; ?>">
                        <?php echo $item['book_name']; ?>
                      </h5>
                      <hr>
                      <section class="d-flex justify-content-between">
                        <p class="card-text">
                          <?php echo $item['author_name']; ?>
                        </p>
                        <p class="card-text text-muted small">
                          <?php echo "{$item['cost']} {$item['currency']}"; ?>
                        </p>
                      </section>
                      <hr>
                      <a href="../controller/cart/remove_cart.php?url=cart&params=''&cart_id=<?php echo $item['cart_id']; ?>"
                        class="btn btn-outline-danger"><i class="fas fa-trash text-danger"></i></a>
                      </form>
                    </section>
                  </section>
                </td>
                <td>
                  <section class="mb-3">
                    <input type="hidden" name="input-prices[]" value="<?php echo $item['cost'] . "$"; ?>">
                    <input type="number" name="input-amounts[]" value="1" class="form-control" min="1" max="50">
                  </section>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr class="empty-row">
              <td colspan="2">Cart is empty.</td>
            </tr>
            <?php
          } ?>
        </tbody>
      </table>

      <table>
        <tr>
          <td class="text-wb">SubTotal</td>
          <td name="show-data[]" class="text-wb"></td>
        </tr>
        <tr>
          <td class="text-wb">Taxes</td>
          <td name="show-data[]" class="text-wb"></td>
        </tr>
        <tr>
          <td class="text-wb">Total</td>
          <td name="show-data[]" class="text-wb"></td>
        </tr>
        <tr>
          <td class="text-wb">Items</td>
          <td name="show-data[]" class="text-wb"></td>
        </tr>
      </table>
    </main>

    <footer class="text-center text-white">
      <!-- Grid container -->
      <section class="container pt-4">
        <!-- Section: Social media -->
        <section class="col mb-1">
          <!-- Facebook -->
          <a class="btn btn-link btn-floating btn-lg m-1" href="https://www.facebook.com/ibrahim.mostafa.9809"><i
              class="fab fa-facebook-f"></i></a>
          <!-- Linkedin -->
          <a class="btn btn-link btn-floating btn-lg m-1" href="https://www.linkedin.com/in/ahmedmaherelsaeidi"><i
              class="fab fa-linkedin"></i></a>
          <!-- Instagram -->
          <a class="btn btn-link btn-floating btn-lg m-1" href="https://www.instagram.com/hika8853/"><i
              class="fab fa-instagram"></i></a>
          <!-- Twitter -->
          <a class="btn btn-link btn-floating btn-lg m-1" href="https://twitter.com/_Ahmed__Maher"><i
              class="fab fa-twitter"></i></a>
          <!-- Youtube -->
          <a class="btn btn-link btn-floating btn-lg m-1"
            href="https://www.youtube.com/channel/UCL3Kf6BwwiZyN723LfiEsCA"><i class="fab fa-youtube"></i></a>
          <!-- Github -->
          <a class="btn btn-link btn-floating btn-lg m-1" href="https://github.com/AhmedMaherElSaeidi"><i
              class="fab fa-github"></i></a>
        </section>
        <!-- Section: Social media -->
      </section>
      <!-- Grid container -->
      <section class="container pt-4">
        <p>
          "Explore the world of knowledge at A.I.. We're your gateway to a universe of books, research, and discovery.
          Visit us today to discover, learn, and connect. A.I. - Your journey to endless possibilities."
        </p>
      </section>
      <!-- Copyright -->
      <section class="text-center p-2">
        &copy; Copyright 2020/2021 A.I. library
      </section>
      <!-- Copyright -->
    </footer>

    <script src="../assets/js/functions.js"></script>
    <script>
      calculate_cart_receipt()
    </script>
  </body>

  </html>
  <?php
  $db->close();
} else {
  header('Location: ../index.php');
} ?>