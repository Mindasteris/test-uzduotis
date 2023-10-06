<?php
     // Include connection
     require_once('inc/dbc.inc.php');

     // Errors
     $errors = [];
 
     // Success msg
     $successMessage = '';

     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category = $_POST['prekes_kategorija'];
        $model = $_POST['prekes_modelis'];
        $manufacturer = $_POST['prekes_gamintojas'];
        $stock = $_POST['sandelis'];

        /* Validation */
        // empty
        if (empty($category)) {
            $errors[] = "kategorija_error";
        }
        elseif (empty(trim($model))) {
            $errors[] = "modelis_error";
        }
        elseif (empty(trim($manufacturer))) {
            $errors[] = "gamintojas_error";
        }
        elseif (empty($stock)) {
            $errors[] = "sandelis_error";
        }

        // Add product
        $query = "INSERT INTO parduotuve (prekes_kategorija, modelis, gamintojas, sandelis)
        VALUES (:prekes_kategorija, :modelis, :gamintojas, :sandelis)";

        if (empty($errors)) {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":prekes_kategorija", $category);
            $stmt->bindParam(":modelis", $model);
            $stmt->bindParam(":gamintojas", $manufacturer);
            $stmt->bindParam(":sandelis", $stock);
            $stmt->execute();

            $successMessage = "Prekė pridėta sėkmingai!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sukurti produktą</title>
</head>
<body>
    <?php include('inc/nav.inc.php') ?>

    <div class="container">
        <h1 class="heading">Sukurti prekę</h1>

        <!-- Success -->
        <?php
            if (!empty($successMessage) && empty($errors)) {
                echo '<div class="success-message">';
                echo $successMessage;
                echo '</div>';
            }
        ?>

        <form action="#" method="POST">
            <div>

                <label for="prekes_kategorija">Prekes kategorija</label>
                <div>
                    <select name="prekes_kategorija">
                        <option value="">Pasirinkite kategoriją</option>
                        <option value="Fotoaparatai">Fotoaparatai</option>
                        <option value="Kompiuteriai">Kompiuteriai</option>
                        <option value="Telefonai">Telefonai</option>
                    </select>
                
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('kategorija_error', $errors)) {
                            echo '<p class="error-message">Privalote pasirinkti prekės kategoriją</p>';
                        }
                    ?>
                </div>

                <label for="prekes_modelis">Modelis</label>
                <div>
                    <input type="text" name="prekes_modelis" placeholder="Prekės pavadinimas (modelis)" value="<?php echo isset($_POST['prekes_modelis']) ? htmlspecialchars($_POST['prekes_modelis']) : ''; ?>">
                
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('modelis_error', $errors)) {
                            echo '<p class="error-message">Įveskite prekės modelį</p>';
                        }
                    ?>
                </div>

                <label for="prekes_gamintojas">Gamintojas</label>
                <div>
                    <input type="text" name="prekes_gamintojas" placeholder="Įveskite prekės gamintoją." value="<?php echo isset($_POST['prekes_gamintojas']) ? htmlspecialchars($_POST['prekes_gamintojas']) : ''; ?>">
                
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('gamintojas_error', $errors)) {
                            echo '<p class="error-message">Įveskite prekės gamintoją</p>';
                        }
                    ?>
                </div>

                <div><label for="sandelis">Sandėlyje</label></div>
                <label for="">Taip</label>
                <div class="checkbox">
                    <input type="radio" name="sandelis" value="taip" checked>
                </div>
                <label for="">Ne</label>
                <div class="checkbox">
                    <input type="radio" name="sandelis" value="ne">
                </div>
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('sandelis_error', $errors)) {
                            echo '<p class="error-message">Būtina pasirinkti ar yra prekė sandėlyje ar ne</p>';
                        }
                    ?>


                <button type="submit">Sukurti prekę</button>
            </div>

            <a href="dashboard.php">Grįžti į katalogą</a>
        </form>
    </div>

    <?php include('inc/footer.inc.php') ?>
</body>
</html>