<?php
    session_start();

    // Include connection
    require_once('./dbc.inc.php');

     // Errors
     $errors = [];

     // Success msg
     $successMessage = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        /* Validation */
        // empty
        if (empty(trim($email))) {
            $errors[] = "pastas_error";
        }
        elseif (empty(trim($password))) {
            $errors[] = "slaptazodis_error";
        }

        // Login user
        $query = 'SELECT * FROM vartotojai WHERE el_pastas = :email';

        if (empty($errors)) {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            // rezultatas
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                // Compare passwords
                if (password_verify($password, $user['slaptazodis'])) {
                    $_SESSION['user'] = $user;
                    header('Location: ../dashboard.php');
                }
                else {
                    $errors[] = "Neteisingi prisijungimai";
                }
            }
            else {
                $errors[] = "Vartotojas nerastas";
            }
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
    <title>Prisijungti</title>
</head>
<body>
    <?php include('./nav.inc.php') ?>

    <div class="container">
        <h1 class="heading">Prisijungti:</h1>

        <!-- Display error -->
        <?php
            if (!empty($errors) && in_array('Vartotojas nerastas', $errors)) {
                echo '<p class="error-message">Tokio vartotojo nėra mūsų sistemoje!</p>';
            }

            if (!empty($errors) && in_array('Neteisingi prisijungimai', $errors)) {
                echo '<p class="error-message">Neteisingai įvestas el.paštas arba slaptažodis!</p>';
            }
        ?>

        <form action="#" method="POST">
            <div>
                <label for="email">El.paštas</label>
                <div>
                    <input type="email" name="email" placeholder="Įveskite el. paštą" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                
                        <!-- Error -->
                        <?php
                            if (!empty($errors) && in_array('pastas_error', $errors)) {
                                echo '<p class="error-message">El. pašto laukelis yra privalomas</p>';
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
                        ?>
                </div>

                <button type="submit">Prisijungti</button>
            </div>

            <a href="./signup.inc.php">Neturite paskyros? Užsiregistruokite!</a>
        </form>
    </div>

    <?php include('./footer.inc.php') ?>
</body>
</html>