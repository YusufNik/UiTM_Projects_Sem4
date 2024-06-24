<?php include('dbconn.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CHAPS</title>
    <link rel="stylesheet" href="style8.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="image/logochaps.png" alt="CHAPS Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#about">About Us</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="home">
        <div class="container">
            <h1>Welcome to CHAPS</h1>
            <p>Your one-stop shop for the latest and greatest in computer hardware.</p>
            <a href="login.html" class="cta-button">Shop Now</a>
        </div>
    </section>

    <section id="products">
        <div class="container">
            <h2>Featured Products</h2>
            <div class="product-grid">
                <?php
                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product-item'>";
                        echo "<img src='" . $row['prodPic'] . "' alt='" . $row['prodName'] . "'>";
                        echo "<div class='product-info'>";
                        echo "<h3>" . $row['prodName'] . "</h3>";
                        echo "<p class='price'>RM " . $row['prodPrice'] . "</p>";
                        echo "<a href='login.html' class='cta-button'>View Details</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No products found.";
                }
                ?>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <h2>About Us</h2>
            <p>At CHAPS, we are passionate about delivering the highest quality computer hardware to our customers. Founded in 2024, our mission is to become your trusted source for the latest and greatest in computer components, peripherals, and accessories.</p>
            <br>
            <p>We understand that technology is constantly evolving, and so are the needs of our customers. That's why we are committed to staying at the forefront of the industry, offering a wide range of products from the most reputable brands. Whether you are a gamer, a professional, or a tech enthusiast, we have something for everyone.</p>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 CHAPS. All rights reserved.</p>
        </div>
    </footer>
    <script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

</body>
</html>

<?php $conn->close(); ?>
