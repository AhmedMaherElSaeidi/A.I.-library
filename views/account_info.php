<?php session_start();
$is_loggedin = isset($_SESSION['username']);
$is_admin = isset($_SESSION['username']) && $_SESSION['role'] === 'admin';
if ($is_loggedin) { ?>
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
        <link rel="stylesheet" href="../assets/css/account_info.css" />
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/index.css" />
    </head>
    <?php
    include "../models/Database.php";
    include "../models/ORM.php";

    $db = new DataBase('library');
    if (!$db->connect())
        die('Server Connection Error');

    $orm = new ORM($db);
    $is_index_set = isset($_GET['index']) ? True : False;
    $is_view_set = isset($_GET['view']) ? True : False;
    ?>

    <body class="text-white settings-background">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <section class="container-fluid">
                <a class="navbar-brand" href="../index.php"><img src="../assets/images/ico/logo.jpg"
                        alt="Website_Logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <section class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../index.php"><i class="fas fa-home"> HOME</i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Options
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <?php
                                if ($is_admin) { ?>
                                    <li><a class="dropdown-item" href="./settings.php?view=1"><i class="fas fa-cog"></i>
                                            Settings</a></li>
                                <?php } ?>
                                <?php if ($is_loggedin) { ?>
                                    <li><a class="dropdown-item" href="../controller/auth/logout.php"><i
                                                class="fas fa-sign-out-alt"></i>
                                            Logout</a></li>
                                <?php } else { ?>
                                    <li><a class="dropdown-item" href="./sign_in.php"><i class="fas fa-sign-in-alt"></i> Log
                                            In</a></li>
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
                    <?php if ($is_loggedin) { ?>
                        <section class="profile-section">
                            <img src="../assets/images/uploads/<?php echo $_SESSION['user_profile'] != 'null' ? $_SESSION['user_profile'] : "default-profile.jpg" ?>"
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

        <?php $user = $orm->select('user', "user_id={$_SESSION['user_id']}", True)[0] ?>
        <section class="account-container">
            <h1 class="text-center">Profile Information</h1>
            <section class="account-info text-center">
                <img src="../assets/images/uploads/<?php echo $user['user_profile'] != 'null' ? $user['user_profile'] : "default-profile.jpg" ?>"
                    alt="">
            </section>
            <section class="account-info">
                <p><span class="info-label">Account Holder:</span>
                    <?php echo $_SESSION['fullname']; ?>
                </p>
                <p><span class="info-label">Account Username:</span>
                    <?php echo $_SESSION['username']; ?>
                </p>
                <p><span class="info-label">Account Type:</span>
                    <?php echo $_SESSION['role']; ?>
                </p>
                <p><span class="info-label">Account gender:</span>
                    <?php echo $_SESSION['gender']; ?>
                </p>
            </section>
            <section class="account-info">
                <form action="../controller/account/update_account.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <input type="hidden" name="user_profile" value="<?php echo $user['user_profile']; ?>">
                    <input type="hidden" name="role" value="<?php echo $user['role']; ?>">
                    <section class="mb-3 name-section">
                        <section>
                            <label class="txt-small" for="first_name">First name</label>
                            <input type="text" name="first_name" id="first_name" value="<?php echo $user['first_name']; ?>"
                                class="form-control" placeholder="first name" required>
                        </section>
                        <section>
                            <label class="txt-small" for="last_name">Last name</label>
                            <input type="text" name="last_name" id="last_name" value="<?php echo $user['last_name']; ?>"
                                class="form-control" placeholder="last name" required>
                        </section>
                    </section>
                    <section class="mb-3">
                        <label class="txt-small" for="username">Username</label>
                        <input type="email" name="username" id="username" value="<?php echo $user['username']; ?>"
                            class="form-control" placeholder="john@email.com"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                    </section>
                    <section class="mb-3">
                        <label class="txt-small" for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-select" required>
                            <?php
                            foreach ([['M', 'Male'], ['F', 'Female'], ['NA', 'Other']] as $gender) { ?>
                                <option value="<?php echo $gender[0]; ?>" <?php if ($user['gender'] == $gender[0]) { ?> selected
                                    <?php } ?>>
                                    <?php echo $gender[1]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </section>
                    <section class="mb-3">
                        <label class="txt-small" for="password">Password</label>
                        <input type="text" name="password" id="password" value="<?php echo $user['password']; ?>"
                            class="form-control" placeholder="********" required>
                    </section>
                    <section class="mb-3">
                        <label class="txt-small" for="user_profile">Profile</label>
                        <input type="file" name="user_profile" id="user_profile" class="form-control">
                    </section>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </section>
            <section class="account-info text-center">
                <span class="btn btn-danger" id="remove_account_btn1" onclick="alert_msg()">Remove Account</span>
                <a href="../controller/account/remove_account.php?url=logout&user_id=<?php echo $user['user_id']; ?>&user_profile=<?php echo $user['user_profile']; ?>"
                    class="btn btn-danger" id="remove_account_btn2" hidden>Remove Account</a>
            </section>
        </section>
        <script>
            function alert_msg() {
                alert("Careful you going to remove your account. Press again to procceed.");
                document.getElementById('remove_account_btn1').hidden = true;
                document.getElementById('remove_account_btn2').hidden = false;
            }
        </script>
    </body>

    </html>
    <?php $db->close();
} else {
    header('Location: ../index.php');
} ?>