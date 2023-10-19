<?php session_start();
$is_admin = isset($_SESSION['username']) && $_SESSION['role'] === 'admin';
if ($is_admin) { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <title>Library : Settings</title>
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
    <link rel="stylesheet" href="../assets/css/settings.css" />
  </head>
  <?php
  include "../models/Database.php";
  include "../models/ORM.php";

  $db = new DataBase('library');
  $is_loggedin = isset($_SESSION['username']);

  if (!$db->connect())
    die('Server Connection Error');

  $orm = new ORM($db);
  $is_index_set = isset($_GET['index']) ? True : False;
  $is_view_set = isset($_GET['view']) ? True : False;
  ?>

  <body class="text-white settings-background">
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
                <a class="nav-link" href="./cart.php">Cart</a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="./aboutus.php">About Us</a>
            </li>
          </ul>
          <?php if ($is_loggedin) { ?>
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
          <?php } ?>
        </section>
    </nav>

    <main>
      <section class="main-navbar">
        <a href="./settings.php?view=1">
          <p class="<?php echo $is_view_set && $_GET['view'] == 1 ? "td-underline" : ""; ?>">add book</p>
        </a>
        <a href="./settings.php?view=2">
          <p class="<?php echo $is_view_set && $_GET['view'] == 2 ? "td-underline" : ""; ?>">list cart</p>
        </a>
        <a href="./settings.php?view=3">
          <p class="<?php echo $is_view_set && $_GET['view'] == 3 ? "td-underline" : ""; ?>">list accounts</p>
        </a>
      </section>
      <section class="parent-section">
        <!-- Update Book -->
        <?php if ($is_view_set && $_GET['view'] == 0) {
          $book_id = $_GET['book_id'];
          $book = $orm->select('book', "book_id={$book_id}", True); ?>
          <section class="child-form" id="0">
            <?php if (count($book) != 1) { ?>
              <p class="text-center text-danger">
                <?php echo "Book Not Found"; ?>
              </p>
            <?php } else { ?>

              <form class="form" action="../controller/book/update_book.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="book_id" value="<?php echo $book[0]['book_id']; ?>">
                <input type="hidden" name="book_cover" value="<?php echo $book[0]['book_cover']; ?>">
                <section class="mb-3">
                  <label class="txt-small" for="book_name">Book name</label>
                  <input type="text" name="book_name" id="book_name" value="<?php echo $book[0]['book_name']; ?>"
                    class="form-control mb-3" placeholder="book name" required>
                  <label class="txt-small" for="book_url">Book url</label>
                  <input type="text" name="book_url" id="book_url" value="<?php echo $book[0]['book_url']; ?>"
                    class="form-control" placeholder="book url" required>
                </section>
                <section class="mb-3 author-section">
                  <section>
                    <label class="txt-small" for="author_id">Author name</label>
                    <select name="author_id" id="author_id" class="form-select" required>
                      <?php
                      foreach ($orm->select('author') as $author) { ?>
                        <option value="<?php echo $author['author_id']; ?>" <?php if ($book[0]['author_id'] == $author['author_id']) { ?>selected<?php } ?>>
                          <?php echo $author['author_name']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </section>
                  <section>
                    <label class="txt-small" for="book_language">Book language</label>
                    <select name="book_language" id="book_language" class="form-select" required>
                      <?php
                      foreach (['ar', 'en'] as $language) { ?>
                        <option value="<?php echo $language; ?>" <?php if ($book[0]['book_language'] == $language) { ?> selected
                          <?php } ?>>
                          <?php echo $language; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </section>
                </section>
                <section class="mb-3">
                  <label class="txt-small" for="category">Category</label>
                  <select name="category" id="category" class="form-select" required>
                    <?php
                    foreach ($orm->select('category') as $category) { ?>
                      <option value="<?php echo $category['category_id']; ?>" <?php if ($book[0]['category_id'] == $category['category_id']) { ?>selected<?php } ?>>
                        <?php echo $category['category']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </section>
                <section class="mb-3 cost-section">
                  <section>
                    <label class="txt-small" for="cost">Cost</label>
                    <input type="number" name="cost" id="cost" class="form-control" value=<?php echo $book[0]['cost']; ?>
                      placeholder="cost" min="1" max="1000" required>
                  </section>
                  <section>
                    <label class="txt-small" for="currency">Currency</label>
                    <select name="currency" id="currency" class="form-select" required>
                      <?php
                      foreach (['USD', 'EGP'] as $currency) { ?>
                        <option value="<?= $currency; ?>" <?= ($book[0]['currency'] == $currency) ? 'selected' : ''; ?>>
                          <?= $currency; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </section>
                </section>
                <section class="mb-3">
                  <label class="txt-small" for="book_description">Book description</label>
                  <textarea class="form-control" id="book_description" name="book_description" placeholder="description"
                    cols="30" rows="5"><?php echo $book[0]['book_description']; ?></textarea>
                </section>
                <section class="mb-3 cover-section">
                  <img src="<?php echo "../assets/images/uploads/{$book[0]['book_cover']}"; ?>"
                    alt="<?php echo $book[0]['book_cover']; ?>">
                  <input type="file" name="book_cover" class="form-control">
                </section>
                <section class="submit-section">
                  <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </section>
              </form>
            <?php }
        } ?>

          <!-- Add Book -->
          <?php if ($is_view_set && $_GET['view'] == 1) { ?>
            <section class="child-form" id="1">
              <form class="form" action="../controller/book/add_book.php" method="post" enctype="multipart/form-data">
                <section class="mb-3">
                  <input type="text" name="book_name" class="form-control mb-3" placeholder="book name" required>
                  <input type="text" name="book_url" class="form-control" placeholder="book url" required>
                </section>
                <section class="mb-3 author-section">
                  <select name="author_id" class="form-select" required>
                    <option selected disabled>author</option>
                    <?php
                    foreach ($orm->select('author') as $author) { ?>
                      <option value="<?php echo $author['author_id']; ?>">
                        <?php echo $author['author_name']; ?>
                      </option>
                    <?php } ?>
                  </select>
                  <select name="book_language" class="form-select" required>
                    <option selected disabled>language</option>
                    <?php
                    foreach (['ar', 'en'] as $language) { ?>
                      <option value="<?php echo $language; ?>">
                        <?php echo $language; ?>
                      </option>
                    <?php } ?>
                  </select>
                </section>
                <section class="mb-3">
                  <select name="category" class="form-select" required>
                    <option selected disabled>category</option>
                    <?php
                    foreach ($orm->select('category') as $category) { ?>
                      <option value="<?php echo $category['category_id']; ?>">
                        <?php echo $category['category']; ?>
                      </option>
                    <?php } ?>
                  </select>
                </section>
                <section class="mb-3 cost-section">
                  <input type="number" name="cost" class="form-control" placeholder="cost" min="1" max="1000" required>
                  <select name="currency" class="form-select" required>
                    <option selected disabled>currency</option>
                    <?php
                    foreach (['USD', 'EGP'] as $currency) { ?>
                      <option value="<?php echo $currency; ?>">
                        <?php echo $currency; ?>
                      </option>
                    <?php } ?>
                  </select>
                </section>
                <section class="mb-3">
                  <input type="file" name="book_cover" class="form-control mb-3" required>
                  <textarea class="form-control" name="book_description" placeholder="description" cols="30"
                    rows="5"></textarea>
                </section>
                <section class="submit-section">
                  <button type="submit" name="submit" class="btn btn-success">Submit</button>
                </section>
              </form>
            </section>
          <?php } ?>

          <!-- view cart -->
          <?php if ($is_view_set && $_GET['view'] == 2) { ?>
            <section class="child-table" id="2">
              <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th>username</th>
                    <th>book name</th>
                    <th>author name</th>
                    <th>book language</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $cart_items = $orm->select_cart("", "", False);
                  foreach ($cart_items as $cart) { ?>
                    <tr>
                      <td>
                        <?php echo $cart['username']; ?>
                      </td>
                      <td>
                        <?php echo $cart['book_name']; ?>
                      </td>
                      <td>
                        <?php echo $cart['author_name']; ?>
                      </td>
                      <td>
                        <?php echo $cart['book_language']; ?>
                      </td>
                      <td>
                        <a
                          href="../controller/cart/remove_cart.php?url=settings&params=view=2&cart_id=<?php echo $cart['cart_id']; ?>">
                          <i class="fas fa-trash text-danger"></i></a>
                      </td>
                    </tr>
                  <?php } ?>
                  <?php if (count($cart_items) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center">No Data Currently</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </section>
          <?php } ?>

          <!-- view accounts -->
          <?php if ($is_view_set && $_GET['view'] == 3) { ?>
            <section class="child-table" id="3">
              <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th>user id</th>
                    <th>username</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $users = $orm->select('user');
                  foreach ($users as $user) {
                    if ($user['user_id'] == $_SESSION['user_id'])
                      continue; ?>
                    <tr>
                      <td>
                        <?php echo $user['user_id']; ?>
                      </td>
                      <td>
                        <?php echo $user['username']; ?>
                      </td>
                      <td>
                        <?php echo "{$user['first_name']} {$user['last_name']}"; ?>
                      </td>
                      <td>
                        <?php echo $user['gender']; ?>
                      </td>
                      <td>
                        <?php echo $user['role']; ?>
                      </td>
                      <td>
                        <a
                          href="../controller/account/remove_account.php?url=settings&params=view=3&user_id=<?php echo $user['user_id']; ?>&user_profile=<?php echo $user['user_profile']; ?>">
                          <i class="fas fa-trash text-danger"></i></a>
                      </td>
                    </tr>
                  <?php } ?>
                  <?php if (count($users) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center">No Data Currently</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </section>
          <?php } ?>
        </section>
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

  </html>
  <?php $db->close();
} else {
  header('Location: ../index.php');
} ?>