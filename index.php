<!DOCTYPE html>
<html lang="en">
<?php
include "./models/Database.php";
include "./models/ORM.php";

session_start();
$db = new DataBase('library');
$is_admin = isset($_SESSION['username']) && $_SESSION['role'] === 'admin';
$is_loggedin = isset($_SESSION['username']);

if (!$db->connect())
  die('Server Connection Error');

$orm = new ORM($db);
$is_index_set = isset($_GET['index']) ? True : False;
?>

<head>
  <meta charset="UTF-8" />
  <title>Library :
    <?php echo $is_index_set ? $_GET['index'] : "Home"; ?>
  </title>
  <link rel="icon" href="assets/images/ico/footerlogo.jpg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Script -->
  <script src="./assets/js/bootstrap.bundle.min.js"></script>

  <!-- stylesheet -->
  <link rel="stylesheet" href="./assets/fontawesome/css/all.css" />
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/footer.css" />
  <link rel="stylesheet" href="./assets/css/index.css" />
</head>

<body class="index-background">
  <nav class="navbar navbar-expand-lg navbar-dark">
    <section class="container-fluid">
      <a class="navbar-brand" href="./index.php"><img src="assets/images/ico/logo.jpg" alt="Website_Logo" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <section class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php"><i class="fas fa-home"> HOME</i></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
              <?php foreach ($orm->select("category", "", False) as $category) {
                if ($is_index_set && $category['category'] == $_GET['index'])
                  continue;
                ?>
                <li><a class="dropdown-item" href="./index.php?index=<?php echo $category['category'] ?>">
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
                <li><a class="dropdown-item" href="views/settings.php?view=1"><i class="fas fa-cog"></i> Settings</a></li>
              <?php }
              if ($is_loggedin) { ?>
                <li><a class="dropdown-item" href="./views/account_info.php">
                    <i class="fas fa-user-circle"></i> User Account</a>
                </li>
                <li><a class="dropdown-item" href="./controller/auth/logout.php"><i class="fas fa-sign-out-alt"></i>
                    Logout</a>
                </li>
              <?php } else { ?>
                <li><a class="dropdown-item" href="./views/sign_in.php"><i class="fas fa-sign-in-alt"></i> Log In</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php
          if (!$is_admin && $is_loggedin) { ?>
            <li class="nav-item">
              <a class="nav-link" href="views/cart.php">Cart</a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="views/aboutus.php">About Us</a>
          </li>
        </ul>
        <?php if ($is_loggedin) { ?>
          <section class="profile-section">
            <img
              src="./assets/images/uploads/<?php echo $_SESSION['user_profile'] != 'null' ? $_SESSION['user_profile'] : "default-profile.jpg" ?>"
              alt="">
            <section>
              <p><a href="./views/account_info.php">
                  <?php echo $_SESSION['fullname']; ?>
                </a></p>
            </section>
          </section>
        <?php } ?>
      </section>
    </section>
  </nav>

  <main>
    <section class="home-view">
      <section>
        <form class="d-flex" action="./index.php" method="get">
          <input class="form-control me-2" type="search" name="index" placeholder="Search" aria-label="Search">
          <button class="btn btn-dark" type="submit" name="search-for" value="submit"><i
              class="fas fa-search"></i></button>
        </form>
      </section>
      <?php if (!$is_loggedin) { ?>
        <section class="signin-section-text">
          <h6>You're not logged in... <a href="views/auth/sign_in.php">log in</a></h6>
        </section>
      <?php } ?>
    </section>
    <section class="books-grid">
      <?php $books = $orm->select_book($is_index_set ? $_GET['index'] : "", $is_index_set);
      foreach ($books as $book) {
        $is_arabic = $book['book_language'] == 'ar'; ?>
        <section class="book-card">
          <section class="book-cover">
            <img src="<?php echo "assets/images/uploads/" . $book['book_cover'] ?>"
              alt="<?php echo $book['book_name'] ?>">
            <section class="overlay">
              <p class="card-text <?php echo $is_arabic ? "text-end" : ""; ?>">
                <?php echo $book['book_description']; ?>
              </p>
              <hr />
              <section class='overlay-btns'>
                <a href=<?php echo $book['book_url'] ?>><span class="btn btn-outline-info" title="Read book"><i
                      class="fas fa-book"></i></span></a>
                <?php if ($is_admin) { ?>
                  <a class='btn btn-outline-danger'
                    href="./controller/book/remove_book.php?book_id=<?php echo $book['book_id']; ?>&book_cover=<?php echo $book['book_cover']; ?>&url=index"
                    title="Delete book"><i class="fas fa-times"></i></a>
                  <a class="btn btn-outline-success"
                    href="./views/settings.php?view=0&book_id=<?php echo $book['book_id']; ?>" title="Update book"><i
                      class="fas fa-edit"></i></a>
                <?php } ?>
                <?php if (!$is_admin && $is_loggedin) {
                  ?>
                  <form action="./controller/cart/add_cart.php" method="post">
                    <input type="hidden" name="url" value="index">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <?php
                    if ($orm->in_cart($_SESSION['user_id'], $book['book_id'])) {
                      ?>
                      <a href="./views/cart.php" class="btn btn-outline-warning" title='In cart'><i
                          class="fas fa-shopping-cart"></i></a>
                      <?php
                    } else { ?>
                      <button class="btn btn-outline-primary" type="submit" name="submit"
                        value="<?php echo $book['book_id']; ?>" title="Add to cart"><i class="fas fa-cart-plus"></i></button>
                      <?php
                    } ?>
                  </form>
                  <?php
                }
                ?>
              </section>
            </section>
          </section>
          <section class="card-body">
            <section>
              <h6 class="card-title <?php echo $is_arabic ? "text-end" : ""; ?>">
                <?php echo $book['book_name']; ?>
              </h6>
              <hr />
              <section class="d-flex justify-content-between">
                <p class="card-text small">
                  <?php echo "Author " . $book['author_name']; ?>
                </p>
                <p class="card-text small">
                  <?php echo $book['cost'] . " " . $book['currency']; ?>
                </p>
              </section>
              <section class="d-flex justify-content-start">
                <p class="card-text small">
                  <?php echo $book['category']; ?>
                </p>
              </section>
            </section>
          </section>
        </section>
        <?php
      }
      ?>
    </section>
    <?php
    if (count($books) == 0) {
      ?>
      <section class="no-book-found">
        <h5>Unfortunately, our search yielded no results that matched your request.</h5>
      </section>
      <?php
    }
    ?>

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
</body>
<?php $db->close() ?>

</html>