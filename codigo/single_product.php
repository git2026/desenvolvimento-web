<?php
session_start();
include(__DIR__ . '/server/connection.php');
$shopLink = (isset($_SESSION['admin']) && $_SESSION['admin'] === true) ? "shop_admin.php" : "shop.php";
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result();
} else {
    header('Location: front_page.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto Individual</title>
    
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

<!-- Produto Individual -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <?php while($row = $product->fetch_assoc()) { ?>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" 
                     src="assets/imgs/<?php echo $row['product_image1']; ?>" 
                     id="mainImg" />
                
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo $row['product_image1']; ?>" 
                             width="100%" 
                             class="small-img" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <h6><?php echo $row['product_category']; ?></h6>
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2><?php echo $row['product_price']; ?> €</h2>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                    <input type="hidden" name="product_image1" value="<?php echo $row['product_image1']; ?>" />
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
                    <input type="number" name="product_quantity" value="1" />
                    <button class="buy-btn" type="submit" name="add_to_cart">Adicionar ao Carrinho</button>
                </form>

                <h4 class="mt-5 mb-5">Detalhes do Produto</h4>
                <span><?php echo $row['product_description']; ?></span>
            </div>
        <?php } ?>
    </div>
</section>

<!-- Secção de Comentários -->
<section class="container my-5">
    <h4 class="mb-4">Comentários</h4>
    <div class="comments-list">
        <?php
        $comments_query = $conn->prepare("SELECT * FROM comments WHERE product_id = ? ORDER BY comment_date DESC");
        $comments_query->bind_param("i", $product_id);
        $comments_query->execute();
        $comments_result = $comments_query->get_result();

        if ($comments_result->num_rows > 0) {
            while ($comment = $comments_result->fetch_assoc()) {
                echo "
                <div class='comment mb-3'>
                    <h5>{$comment['user_name']}</h5>
                    <p>{$comment['comment_text']}</p>
                    <small class='text-muted'>{$comment['comment_date']}</small>
                </div>
                <hr class='comment-line'>";
            }
        } else {
            echo "<p>Sem comentários até agora. Seja o primeiro a comentar!</p>";
        }
        ?>
    </div>
    <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
        <div class="comment-form mt-4">
            <h5>Adicionar um Comentário</h5>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="comment_text" class="form-label">O seu Comentário</label>
                    <textarea name="comment_text" id="comment_text" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" name="submit_comment" class="btn btn-primary">Submeter</button>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-4" role="alert">
            É necessário estar autenticado para comentar. Por favor, faça <a href="account.php" class="alert-link">login</a>.
        </div>
        <?php
        ?>
    <?php endif; ?>

    <?php
    if (isset($_POST['submit_comment']) && isset($_SESSION['user_id'])) {
        $user_name = $_SESSION['user_name'];
        $comment_text = $conn->real_escape_string($_POST['comment_text']);

        $insert_comment = $conn->prepare("INSERT INTO comments (product_id, user_name, comment_text) VALUES (?, ?, ?)");
        $insert_comment->bind_param("iss", $product_id, $user_name, $comment_text);

        if ($insert_comment->execute()) {
            echo "<script>
                alert('Comentário adicionado com sucesso!');
                window.location.href = 'single_product.php?product_id=" . $product_id . "';
            </script>";
        } else {
            echo "<script>alert('Erro ao adicionar comentário. Tente novamente.');</script>";
        }
    }
    ?>
</section>

<!-- Rodapé -->
<footer class="mt-5 py-5">
    <div class="container">
        <div class="row pt-5">
            <!-- Coluna 1: Sobre a Empresa -->
            <div class="col-lg-4 col-md-6 mb-5">
                <img class="logo mb-3" src="assets/imgs/brand1.jpeg" alt="Logótipo do Rodapé" style="max-width: 150px;" />
                <h2 class="brand text-white">PowerUpTech</h2>
                <p class="pt-2 text-white">Fornecemos os melhores produtos ao melhor preço, com foco em qualidade e inovação para todos os nossos clientes.</p>
            </div>

            <!-- Coluna 2: Contactos -->
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

<script>
    let mainImg = document.getElementById("mainImg");
    let smallImg = document.getElementsByClassName("small-img");
    for (let i = 0; i < smallImg.length; i++) {
        smallImg[i].onclick = function () {
            mainImg.src = smallImg[i].src;
        }
    }
</script>
</body>
</html>
