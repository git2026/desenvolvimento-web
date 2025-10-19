<?php
session_start();
include('server/connection.php');
$shopLink = (isset($_SESSION['admin']) && $_SESSION['admin'] === true) ? "shop_admin.php" : "shop.php";
if (isset($_SESSION['user_id'])) {
    header("Location: account.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name            = $_POST['name'];
    $email           = $_POST['email'];
    $password        = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo "<script>alert('As palavras-passe não coincidem!');</script>";
    } else {
        $stmt_check = $conn->prepare("SELECT user_email FROM users WHERE user_email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            echo "<script>alert('Este email já está registado!');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt_insert = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $name, $email, $hashed_password);
            if ($stmt_insert->execute()) {
                $_SESSION['user_id']    = $stmt_insert->insert_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name']  = $name;
                header("Location: account.php");
                exit();
            } else {
                echo "<script>alert('Erro ao registar o utilizador!');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo</title>
    
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

    <!-- Registo -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Registo</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container" style="max-width: 500px;">
            <form id="register-form" method="POST" action="register.php">
                <div class="form-group mb-3">
                    <label>Nome</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Nome" required>
                </div>
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group mb-3">
                    <label>Palavra-passe</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Palavra-passe" required>
                </div>
                <div class="form-group mb-3">
                    <label>Confirmar Palavra-passe</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirmar Palavra-passe" required>
                </div>
                <div class="form-group mb-3">
                    <input type="submit" class="btn btn-primary w-100" id="register-btn" value="Registar">
                </div>
                <div class="form-group mb-3 text-center">
                    <a id="login-url" class="btn" href="account.php">Já tem uma conta? Entre</a>
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