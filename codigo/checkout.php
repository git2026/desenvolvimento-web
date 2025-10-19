<?php
session_start();
include('server/connection.php'); // Ajuste o caminho se necessário
$shopLink = (isset($_SESSION['admin']) && $_SESSION['admin'] === true) ? "shop_admin.php" : "shop.php";
$user_name_logged  = isset($_SESSION['user_name']) ? $_SESSION['user_name']  : '';
$user_email_logged = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';

// Calcular ou receber o total do carrinho
$total_to_pay = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_to_pay += $item['product_price'] * $item['product_quantity'];
    }
}

// Se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $city     = $_POST['city'];
    $address  = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $order_cost     = $_POST['order_cost'];

    // Identificar o user_id da sessão
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

    // INSERIR na tabela orders
    $stmt = $conn->prepare("INSERT INTO orders 
       (order_cost, order_status, user_id, user_phone, user_city, user_address) 
       VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("dsisss", $order_cost, $payment_method, $user_id, $phone, $city, $address);
    
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Agora, inserir cada item do carrinho em order_items
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $product_id       = $item['product_id'];
                $product_name     = $item['product_name'];
                $product_image    = $item['product_image'];
                $product_price    = $item['product_price'];
                $product_quantity = $item['product_quantity'];
                $item_total_cost  = $product_price * $product_quantity;

                $stmt_item = $conn->prepare("INSERT INTO order_items
                   (order_id, product_id, product_name, product_image, order_cost, user_id, product_quantity) 
                   VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt_item->bind_param("iissdii", 
                    $order_id, 
                    $product_id, 
                    $product_name, 
                    $product_image, 
                    $item_total_cost, 
                    $user_id,
                    $product_quantity
                );
                $stmt_item->execute();
            }
        }

        // Limpar o carrinho
        unset($_SESSION['cart']);

        // Mensagem de sucesso e redireciona
        echo "<script>
                alert('Compra efetuada com sucesso!');
                window.location = 'front_page.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Erro ao criar o pedido.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    
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

    <!-- Finalizar Compra -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Finalizar Compra</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container" style="max-width: 600px;">
            <form id="checkout-form" method="POST" action="">
                <div class="form-group checkout-small-element mb-3">
                    <label>Nome</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Nome" value="<?php echo $user_name_logged; ?>" readonly>
                </div>
                <div class="form-group checkout-small-element mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" value="<?php echo $user_email_logged;?>" readonly>
                </div>
                <div class="form-group checkout-small-element mb-3">
                    <label>Telefone</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Telefone" required>
                </div>
                <div class="form-group checkout-small-element mb-3">
                    <label>Cidade</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Cidade" required>
                </div>
                <div class="form-group checkout-large-element mb-3">
                    <label>Morada</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Morada" required>
                </div>

                <div class="form-group checkout-small-element mb-3">
                    <label>Método de Pagamento</label>
                    <select name="payment_method" class="form-control" required>
                        <option value="Cartão de Crédito">Cartão de Crédito</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Dinheiro na Entrega">Dinheiro na Entrega</option>
                    </select>
                </div>

                <div class="form-group checkout-small-element mb-3">
                    <label>Total a Pagar (€)</label>
                    <input type="text" class="form-control" 
                           name="display_total" 
                           value="<?php echo number_format($total_to_pay, 2); ?>" 
                           readonly>
                </div>
                <input type="hidden" name="order_cost" 
                       value="<?php echo $total_to_pay; ?>">
                <div class="form-group checkout-btn-container mt-4">
                    <input type="submit" class="btn btn-primary w-100" 
                           id="checkout-btn" value="Finalizar Compra">
                </div>
            </form>
        </div>
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
