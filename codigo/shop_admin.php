<?php
session_start();
include('server/connection.php');

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: account.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $product_name        = $conn->real_escape_string($_POST['product_name']);
    $product_category    = $conn->real_escape_string($_POST['product_category']);
    $product_description = $conn->real_escape_string($_POST['product_description']);
    $product_price       = $_POST['product_price'];

    if(isset($_FILES['product_image1']) && $_FILES['product_image1']['error'] == 0) {
        $target_dir = "assets/imgs/";
        $target_file = $target_dir . basename($_FILES["product_image1"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["product_image1"]["tmp_name"]);
        if($check === false) {
            echo "<script>alert('O ficheiro enviado não é uma imagem válida.');</script>";
            exit();
        }
        
        if(move_uploaded_file($_FILES["product_image1"]["tmp_name"], $target_file)) {
            $product_image1 = $conn->real_escape_string(basename($_FILES["product_image1"]["name"]));
        } else {
            echo "<script>alert('Erro ao fazer upload da imagem.');</script>";
            exit();
        }
    } else {
        echo "<script>alert('Selecione uma imagem para o produto.');</script>";
        exit();
    }

    $stmt_insert = $conn->prepare("INSERT INTO products (product_name, product_category, product_description, product_image1, product_price) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert->bind_param("ssssd", 
        $product_name, 
        $product_category, 
        $product_description, 
        $product_image1, 
        $product_price, 
    );

    if ($stmt_insert->execute()) {
        echo "<script>alert('Produto adicionado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao adicionar o produto.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração da Loja</title>
    
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
    <style>
        .custom-file-input {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }
        .custom-file-input:hover {
            background-color: #f8f8f8;
        }
    </style>
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

<section class="container my-5 pt-5">
    <div class="text-center"style="margin-top: 6rem;">
        <h2>Adicionar Novo Produto</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto" style="max-width: 600px;">
        <form method="POST" action="shop_admin.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nome do Produto</label>
                <input type="text" name="product_name" class="form-control" placeholder="Nome do Produto" required>
            </div>
            <div class="mb-3">
                <label>Categoria do Produto</label>
                <input type="text" name="product_category" class="form-control" placeholder="Ex.: Sapatos, Roupas, etc." required>
            </div>
            <div class="mb-3">
                <label>Descrição do Produto</label>
                <textarea name="product_description" class="form-control" placeholder="Descrição do produto" required></textarea>
            </div>
            <div class="mb-3">
                <label>Preço</label>
                <input type="number" step="0.01" name="product_price" class="form-control" placeholder="Preço" required>
            </div>
            <div class="mb-3">
                <label>Imagem do Produto</label>
                <input type="file" name="product_image1" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="submit" name="add_product" class="btn btn-primary w-100" value="Adicionar Produto">
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

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const products = document.querySelectorAll('.product');
        products.forEach(product => {
            product.addEventListener("click", () => {
                const productId = product.getAttribute('data-id');
                if (productId) {
                    window.location.href = 'single_product.php?product_id=' + productId;
                }
            });
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>