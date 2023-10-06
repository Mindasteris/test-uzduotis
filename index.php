<?php 
    session_start();
    // require_once('inc/dbc.inc.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pradžia</title>
</head>
<body>
    <?php include('inc/nav.inc.php') ?>

    <div class="container">
        <h1 class="heading">Sveiki Atvykę į LOGO</h1>

        <main class="index-page">
            <div class="flex-container">
                <img src="assets/online-shop.jpg" alt="shop-image">
                <div>
                    <h1>Mūsų Parduotuvė</h1>
                    <p>Tai viena didžiausių elektronikos parduotuvių baltijos šalyse.
                        Mes siūlome platų asortimentą aukštos kokybės elektronikos ir technikos produktų.
                        Pasistengėme surinkti tik geriausius ir inovatyviausius elektronikos produktus iš populiariausių gamintojų. Taigi, galite būti tikri, kad rasite tai, ko jums reikia.

                    </p>
                </div>
            </div>

            <div class="flex-container">
                <div>
                    <h1>Mūsų Paslaugos</h1>
                    <ul>
                        <li>Greitas pristatymas</li>
                        <li>Platus prekių asortimentas</li>
                        <li>Geriausios kainos</li>
                        <li>Patogi apsipirkimo patirtis</li>
                        <li>Pinigų grąžinimo garantija</li>
                    </ul>
                </div>
                <img src="assets/online-delivery.jpg" alt="delivery-image">
            </div>
        </main>
    </div>

    <?php include('inc/footer.inc.php') ?>
</body>
</html>