<?php
    session_start();

    // Database connection
    require_once('inc/dbc.inc.php');

    // Errors
    $errors = [];
 
    // Success msg
    $successMessage = '';

    // 
    if (isset($_GET['produktas'])) {
        $productID = $_GET['produktas'];

        // SQL
        $query = "SELECT * FROM parduotuve WHERE id = :productID";
        $stmt = $conn->prepare($query);
        $stmt->bindParam("productID", $productID);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $category = $product['prekes_kategorija'];
            $model = $product['modelis'];
            $manufacturer = $product['gamintojas'];
            $stock = $product['sandelis'];
        }
    }

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

        // Update
        if (empty($errors)) {
            $query = "UPDATE parduotuve SET prekes_kategorija = :category,
                modelis = :model, 
                gamintojas = :manufacturer, 
                sandelis = :stock WHERE id = :productID";
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":model", $model);
            $stmt->bindParam(":manufacturer", $manufacturer);
            $stmt->bindParam(":stock", $stock);
            $stmt->bindParam(":productID", $productID);
            
            if ($stmt->execute()) {
                $successMessage = "Produktas atnaujintas sėkmingai";
            }
            else {
                die("Klaida, nepavyksta atnaujinti duomenų!");
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Redaguoti produktą</title>
</head>
<body>
    <?php include('inc/nav.inc.php') ?>

    <div class="container">
        <h1 class="heading">Redaguoti produktą</h1>

        <!-- Success -->
        <?php
            if (!empty($successMessage) && empty($errors)) {
                echo '<div class="success-message">';
                echo $successMessage;
                echo '</div>';
            }
        ?>

        <form action="" method="POST">
            <div>

                <label for="prekes_kategorija">Prekes kategorija</label>
                <div>
                    <select name="prekes_kategorija">
                        <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
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
                    <input type="text" name="prekes_modelis" placeholder="Prekės pavadinimas (modelis)" value="<?php echo htmlspecialchars($model); ?>">
                
                    <!-- Error -->
                    <?php
                        if (!empty($errors) && in_array('modelis_error', $errors)) {
                            echo '<p class="error-message">Įveskite prekės modelį</p>';
                        }
                    ?>
                </div>

                <label for="prekes_gamintojas">Gamintojas</label>
                <div>
                    <input type="text" name="prekes_gamintojas" placeholder="Įveskite prekės gamintoją." value="<?php echo htmlspecialchars($manufacturer); ?>">
                
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


                <button type="submit">Atnaujinti produktą</button>
            </div>

            <a href="dashboard.php">Grįžti į katalogą</a>
        </form>
    </div>

    <?php include('inc/footer.inc.php') ?>
</body>
</html>