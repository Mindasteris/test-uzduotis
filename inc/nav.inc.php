<?php
    // session_start();
?>

<nav>
    <!-- Check user logged -->
    <?php if (!isset($_SESSION['user'])) { ?>
            <div class="menu">
                <h1>LOGO</h1>

                <ul class="menu-links">
                    <li><a href="/uzduotis/index.php">Pradžia</a></li>
                    <li><a href="/uzduotis/dashboard.php">Parduotuvė</a></li>
                </ul>
            </div>

            <div>
                <ul class="signin-links">
                    <li><a href="/uzduotis/inc/login.inc.php">Prisijungti</a></li>
                    <li><a href="/uzduotis/inc/signup.inc.php">Skurti paskyrą</a></li>
                </ul>
            </div>
    <?php } else {?>
            <div class="menu">
                    <h1>LOGO</h1>

                    <ul class="menu-links">
                        <li><a href="/uzduotis/index.php">Pradžia</a></li>
                        <li><a href="/uzduotis/dashboard.php">Parduotuvė</a></li>
                    </ul>
            </div>

            <!-- User info display -->
            <div>
                <ul class="">
                    <li><span class="user-info"><?php echo $_SESSION['user']['vardas']; ?></span></li>
                    <li><a href="/uzduotis/inc/logout.inc.php">atsijungti</a></li>
                </ul>
            </div>
    <?php } ?>
</nav>