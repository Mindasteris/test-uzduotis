<?php
    session_start();

    // Include connection
    require_once('dbc.inc.php');

    // Errors
    $errors = [];

    // Success msg
    $successMessage = '';

    // Check registration form
    if ($_SERVER['REQUEST_METHOD'] === 'POST')  {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        /* Validation */
        // empty
        if (empty(trim($name))) {
            $errors[] = "vardas_error";
        }
        elseif (empty(trim($email))) {
            $errors[] = "pastas_error";
        }
        elseif (empty(trim($password))) {
            $errors[] = "slaptazodis_error";
        }
        elseif (empty(trim($password_confirm))) {
            $errors[] = "slaptazodis_pakartoti_error";
        }

        // Email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            $errors[] = "netinkamas_pastas";
        }

        // Check if passwords match confirmation and length
        if ($password !== $password_confirm) {
            $errors[] = "slaptazodis_nesutampa";
        }
        if (strlen($password) <= 7 && !empty($password)) {
            $errors[] = "slaptazodis_trumpas";
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Register user sql
        $query = 'INSERT INTO vartotojai (vardas, el_pastas, slaptazodis)
        VALUES (:vardas, :el_pastas, :slaptazodis)';

        // Add user
        if (empty($errors)) {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":vardas", $name);
            $stmt->bindParam(":el_pastas", $email);
            $stmt->bindParam(":slaptazodis", $hashedPassword);
            $stmt->execute();

            $successMessage = "Užsiregistravote sėkmingai. Dabar galite prisijungti!";
        }


    }
    // else {
    //     header('Location: /uzduotis/index.php');
    //     die();
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Registracija</title>
</head>
<body>
    <?php include('./nav.inc.php') ?>

    <div class="container">
        <h1 class="heading">Registracija:</h1>

        <!-- Success message alert -->
        <?php
        if (!empty($successMessage) && empty($errors)) {
            echo '<div class="success-message">';
            echo $successMessage;
            echo '</div>';
        }
        ?>

        <!-- Display errors -->
        <?php
            // Errors
            // if (!empty($errors)) {
            //     echo "<div class='error'>";
            //     foreach ($errors as $error) {
            //         echo "<p>$error</p>";
            //     }
            //     echo "</div>";
            // }
        ?>
        <!--  -->

        <form action="signup.inc.php" method="POST">
            <div>
                <label for="name">Vardas</label>
                <div>
                    <input type="text" name="name" placeholder="Įveskite savo vardą" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('vardas_error', $errors)) {
                            echo '<p class="error-message">Vardo laukelis yra privalomas</p>';
                        }
                    ?>
                </div>

                <label for="email">El.paštas</label>
                <div>
                    <input type="text" name="email" placeholder="Įveskite el. paštą" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('pastas_error', $errors)) {
                            echo '<p class="error-message">El. pašto laukelis yra privalomas</p>';
                        }
                        elseif (!empty($errors) && in_array('netinkamas_pastas', $errors)) {
                            echo '<p class="error-message">Įvestas netinkamo formato el. paštas</p>';
                        }
                    ?>
                </div>

                <label for="password">Slaptažodis</label>
                <div>
                    <input type="password" name="password" placeholder="Įveskite slaptažodį">
                
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('slaptazodis_error', $errors)) {
                            echo '<p class="error-message">Slaptažodžio laukelis yra privalomas</p>';
                        }
                        elseif (!empty($errors) && in_array('slaptazodis_nesutampa', $errors)) {
                            echo '<p class="error-message">Slaptažodis nesutampa. Prašome patikrinti.</p>';
                        }
                        elseif (!empty($errors) && in_array('slaptazodis_trumpas', $errors)) {
                            echo '<p class="error-message">Slaptažodis negali būti trumpesnis nei 8 simboliai.</p>';
                        }
                    ?>
                </div>

                <label for="password_confirm">Pakartoti slaptažodį</label>
                <div>
                    <input type="password" name="password_confirm" placeholder="Pakartokite slaptažodį">
                
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('slaptazodis_pakartoti_error', $errors)) {
                            echo '<p class="error-message">Pakartokite slaptažodį</p>';
                        }
                    ?>
                </div>

                <button type="submit">Registruotis</button>
            </div>

            <a href="./login.inc.php">Jau turite paskyrą? Prisijunkite!</a>
        </form>
    </div>

    <?php include('./footer.inc.php') ?>
</body>
</html>