<?php
session_start();

$shopLink = (isset($_SESSION['admin']) && $_SESSION['admin'] === true) ? "shop_admin.php" : "shop.php";

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], 'product_id');
        if (in_array($_POST['product_id'], $products_array_ids)) {
            echo "<script>alert('O produto já está no carrinho');</script>";
        } else {
            $product_id       = $_POST['product_id'];
            $product_name     = $_POST['product_name'];
            $product_price    = $_POST['product_price'];
            $product_image    = $_POST['product_image1'];
            $product_quantity = $_POST['product_quantity'];
            $product_array = array(
                'product_id'       => $product_id,
                'product_name'     => $product_name,
                'product_price'    => $product_price,
                'product_image'    => $product_image,
                'product_quantity' => $product_quantity
            );
            $_SESSION['cart'][$product_id] = $product_array;
        }
    } else {
        $product_id       = $_POST['product_id'];
        $product_name     = $_POST['product_name'];
        $product_price    = $_POST['product_price'];
        $product_image    = $_POST['product_image1'];
        $product_quantity = $_POST['product_quantity'];
        $product_array = array(
            'product_id'       => $product_id,
            'product_name'     => $product_name,
            'product_price'    => $product_price,
            'product_image'    => $product_image,
            'product_quantity' => $product_quantity
        );
        $_SESSION['cart'][$product_id] = $product_array;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" 
          href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" 
          integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" 
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
        <div class="d-flex align-items-center">
            <img class="logo" src="assets/imgs/brand1.jpeg" alt="Logótipo"/>
            <span class="brand">PowerUpTech</span>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Alternar navegação">
           <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                   <a class="nav-link" href="front_page.php">Início</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="<?php echo $shopLink; ?>">Loja</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="contact.html">Ofertas e Contactos</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="cart.php"><i class="fas fa-shopping-bag"></i></a>
                    <a href="account.php"><i class="fas fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Carrinho --> 
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">O Seu Carrinho</h2>
            <hr>
        </div>
        <?php 
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "<p class='mt-5 text-center'>O seu carrinho está vazio.</p>";
        } else {
        ?>

        <table class="mt-5 pt-5">
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $item_subtotal = $value['product_price'] * $value['product_quantity'];
                $total += $item_subtotal;
            ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/product_generic.jpg" />
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span></span><?php echo $value['product_price']; ?>€</small>
                            <br>
                            <a class="remove-btn" href="#">Remover</a>
                        </div>
                    </div>
                </td>
                <td>
                <br>
                    <p><?php echo $value['product_quantity']; ?><p>
                </td>
                <td>
                    <span class="price"><?php echo number_format($item_subtotal, 2); ?>€</span>
                </td>
            </tr>
            <?php } ?>
        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td><?php echo number_format($total, 2); ?>€</td>
                </tr>
            </table>
        </div>
        <div class="checkout-container">
            <a class="btn checkout-btn" href="checkout.php?total=<?php echo number_format($total, 2); ?>">Finalizar Compra</a>
        </div>
        <?php }?>
    </section>

    <!-- Rodapé -->
    <footer class="mt-5 py-5">
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-4 col-md-6 mb-5">
                <img class="logo mb-3" src="assets/imgs/brand1.jpeg" alt="Logótipo do Rodapé" style="max-width: 150px;" />
                <h2 class="brand text-white">PowerUpTech</h2>
                <p class="pt-2 text-white">Fornecemos os melhores produtos ao melhor preço, com foco em qualidade e inovação para todos os nossos clientes.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-0">
                <h5 class="pb-3 text-uppercase text-white">Contacte-nos</h5>
                <ul class="list-unstyled text-white">
                    <li class="mb-3">
                        <h6 class="text-uppercase">Endereço</h6>
                        <p>Rua Doutor Malheiros 18, Sintra, 2605-353, Lisboa, Portugal</p>
                    </li>
                    <li class="mb-3">
                        <h6 class="text-uppercase">Telefone</h6>
                        <p><a href="tel:+351960000000" class="text-white text-decoration-none">+351 962 731 543</a></p>
                    </li>
                    <li>
                        <h6 class="text-uppercase">Email</h6>
                        <p><a href="mailto:poweruptech@gmail.com" class="text-white text-decoration-none">poweruptech@gmail.com</a></p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12 text-center text-lg-end">
                <h5 class="pb-3 text-uppercase text-white">Siga-nos</h5>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
            </div>
        </div>
        <hr class="my-4" style="border-top: 2px solid #6c63ff;">
        <div class="text-center">
            <p class="mb-0 text-white">PowerUpTech 2025 | Todos os Direitos Reservados</p>
        </div>
    </div>
</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>
</html>