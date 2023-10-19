<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Library : About</title>
  <link rel="icon" href="../assets/images/ico/footerlogo.jpg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Script -->
  <script src="../assets/js/bootstrap.bundle.min.js"></script>

  <!-- stylesheet -->
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/footer.css" />
  <link rel="stylesheet" href="../assets/css/index.css" />
  <link rel="stylesheet" href="../assets/css/about.css" />
</head>
<?php
include "../models/Database.php";
include "../models/ORM.php";

session_start();
$db = new DataBase('library');
$is_admin = isset($_SESSION['username']) && $_SESSION['role'] === 'admin';
$is_loggedin = isset($_SESSION['username']);

if (!$db->connect())
  die('Server Connection Error');

$orm = new ORM($db);
$is_index_set = isset($_GET['index']) ? True : False;
?>

<body class="about-background">
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
              <?php if ($is_admin) { ?>
                <li><a class="dropdown-item" href="./settings.php?view=1"><i class="fas fa-cog"></i> Settings</a></li>
              <?php } ?>
              <?php if ($is_loggedin) { ?>
                <li><a class="dropdown-item" href="./account_info.php">
                    <i class="fas fa-user-circle"></i> User Account</a>
                </li>
                <li><a class="dropdown-item" href="../controller/auth/logout.php"><i class="fas fa-sign-out-alt"></i>
                    Logout</a>
                </li>
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
            <a class="nav-link active" aria-current="page" href="./aboutus.php">About Us</a>
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
    <section class="d-flex justify-content-center text-white">
      <h1>About us</h1>
    </section>
    <section class="container-fluid text-white">
      <section class="row justify-content-start">
        <section class="col-4">
          <h4>Quotes about reading books.</h4>
        </section>
      </section>
      <section class="row justify-content-around">
        <section class="col-6">
          <p>“Once you learn to read, you will be forever free.” Frederick Douglass</p>
          <p>“There are many little ways to enlarge your world. Love of books is the best of all.” Jacqueline Kennedy
          </p>
          <p>“Reading is a discount ticket to everywhere.” Mary Schmich</p>
          <p>“In books I have traveled, not only to other worlds, but into my own.” Anna Quindlen</p>
          <p>“Books are the plane, and the train, and the road. They are the destination,
            and the journey. They are home.” Anna Quindlen</p>
        </section>
      </section>
      <section class="row justify-content-start">
        <section class="col-4">
          <h4>Notes about the owner.</h4>
        </section>
      </section>
      <section class="row justify-content-around">
        <section class="col-8 text-white">
          <p>The site has been created by Ibrahim Moustafa Darwish & Ahmed Maher El-Saeidy.</p>
        </section>
      </section>
      <section class="row justify-content-center">
        <section class="col-8">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus maiores unde, doloribus ipsum
            similique ex sapiente perspiciatis nostrum inventore eaque porro, tempora sunt odio cumque
            minima eos temporibus tenetur, aut maxime fugit amet. Iusto maiores laborum nulla ex eius
            saepe assumenda cumque sapiente? Modi, doloremque amet commodi eius rerum iure reprehenderit
            magni in veritatis error repellendus dolor, iste et perferendis neque ducimus, labore velit.
            officiis voluptatum, veritatis mollitia nam deserunt repellat laudantium doloribus dolorum
            quidem ipsam voluptas officia minima blanditiis maxime atque possimus dolor harum praesentium
            Doloribus explicabo dignissimos nam eos, illo ab, consequuntur aperiam, sunt error voluptates hic
            minima quas corrupti sed praesentium blanditiis aliquid qui iste. Nam, id temporibus autem, sint,
            debitis natus perferendis corporis veniam porro. Corrupti sint, assumenda, quo eum dicta inventore
            voluptates a consequuntur illo aliquid tenetur repellat!</p>
        </section>
      </section>
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
<?php $db->close() ?>

</html>