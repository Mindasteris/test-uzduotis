<?php
    session_start();

    // Include database connection
    require_once('inc/dbc.inc.php');

    // Delete message
    $deleteMessage = '';

    // Retrieve data from the database
    $query = "SELECT * FROM parduotuve";
    $stmt = $conn->query($query);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Select product from database
    if ($products) {
        $category = $products[0]['prekes_kategorija'];
    }

    // Delete product
    if (isset($_GET['trinti'])) {
        $productID = $_GET['trinti'];
        
        $query = "DELETE FROM parduotuve WHERE id = $productID";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // $deleteMessage = "Produktas sėkmingai pašalintas";

        $_SESSION['delete_message'] = "Produktas sėkmingai pašalintas.";
        header('Location: /uzduotis/dashboard.php');
        exit(); // Kad sustabdytu koda po redirecto ir nieko papildomai nevikdytu
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Dashboard</title>
</head>
<body>
    <?php include('inc/nav.inc.php') ?>

    <div class="container">
        <h1 class="heading">Parduotuvė</h1>

        <?php
            if (!isset($_SESSION['user'])) {
                header('Location: inc/login.inc.php');
            }
        ?>

        <div class="page-content">
            <a class="main-btn" href="create-product.php">Sukurti naują prekę</a>
        </div>

        <!-- Delete message alert -->
        <!-- Success -->
        <?php
        if (isset($_SESSION['delete_message'])) {
            echo '<script>';
            echo 'alert("' . $_SESSION['delete_message'] . '");';
            echo '</script>';

            // Clear the session variable to prevent displaying the message again
            unset($_SESSION['delete_message']);
        }
        ?>

        <!-- Products -->
        <div class="table-container">
            <?php if (!empty($products)): ?>

                <!-- Filter buttons -->
                <div class="filter-buttons">
                    
                    <!-- Kategorija -->
                    <p>Prekės kategorija:</p>
                    <select id="kategorijos_filtras">
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['prekes_kategorija']; ?>"><?php echo $product['prekes_kategorija']; ?></option>
                    <?php endforeach ?>
                    </select>

                    <!-- Modelis -->
                    <p>Modelis:</p>
                        <select id="modelio_filtras">
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['modelis']; ?>"><?php echo $product['modelis']; ?></option>
                        <?php endforeach ?>
                        </select>

                    <!-- Gamintojas -->
                        <p>Gamintojas:</p>
                        <select id="gamintojo_filtras">
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['gamintojas']; ?>"><?php echo $product['gamintojas']; ?></option>
                        <?php endforeach ?>
                        </select>
                    
                    <!-- Sandelyje -->
                        <p>Sandėlyje:</p>
                        <select id="sandelyje_filtras">
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['sandelis']; ?>"><?php echo $product['sandelis']; ?></option>
                        <?php endforeach ?>
                        </select>

                        <button onclick="filterProducts()">Filtruoti</button>
                        <button onclick="resetFilters()">Išvalyti filtrus</button>
                </div>

            <table class="product-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prekės kategorija</th>
                        <th>Modelis</th>
                        <th>Gamintojas</th>
                        <th>Sandėlyje</th>
                        <th>Redaguoti</th>
                        <th>Trinti</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Display products -->
                    <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="id"><?php echo $product['id'];?></td>
                                <td class="category-column"><?php echo $product['prekes_kategorija'];?></td>
                                <td class="model-column"><?php echo $product['modelis'];?></td>
                                <td class="manufacturer-column"><?php echo $product['gamintojas'];?></td>
                                <td class="stock-column"><?php echo $product['sandelis'];?></td>
                                <td><a href="/uzduotis/edit-product.php?produktas=<?php echo $product['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="/uzduotis/dashboard.php?trinti=<?php echo $product['id'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php else: ?>
                <h1 class="heading-no-products">Nėra prekių prekyboje!</h1>
            <?php endif; ?>
        </div>
    </div>

    <?php include('inc/footer.inc.php') ?>

    <script src="script.js"></script>
</body>
</html>