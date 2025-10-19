<?php
    session_start();
    include('server/connection.php');
    
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header("Location: account.php");
        exit();
    }
    if (isset($_POST['login'])) {
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        if ($user_email === 'admin@gmail.com' && $user_password === 'admin') {
            $_SESSION['admin'] = true;
            $_SESSION['user_id'] = 0;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_name'] = "Admin";
            header("Location: shop_admin.php");
            exit();
        }
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['user_password'];
            if (password_verify($user_password, $hashed_password)) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['user_name'] = $row['user_name'];
            } else {
                echo "<script>alert('Palavra-passe incorreta!');</script>";
            }
        } else {
            echo "<script>alert('Utilizador não encontrado!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Conta</title>
    
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
                <img class="logo" src="assets/imgs/brand1.jpeg" alt="Logo"/>
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
                       <a class="nav-link" href="shop.php">Loja</a>
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

    <!-- Secção da Conta -->
    <section class="my-5 pt-5">
    <div class="container">
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 text-center mt-3 pt-5">
                    <h3 class="font-weight-bold">Informação da Conta</h3>
                    <hr class="mx-auto">
                    <div class="account-info">
                        <p>Nome: <span><?php echo $_SESSION['user_name']; ?></span></p>
                        <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
                        <p><a href="account.php?logout=1" id="logout-btn">Sair</a></p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <form id="account-form">
                        <h3>Alterar Palavra-passe</h3>
                        <hr class="mx-auto">
                        <div class="form-group">
                            <label>Nova Palavra-passe</label>
                            <input type="password" class="form-control" id="account-password" name="password" placeholder="Palavra-passe" />
                        </div>
                        <div class="form-group">
                            <label>Confirmar Palavra-passe</label>
                            <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Confirmar Palavra-passe" />
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Alterar Palavra-passe" class="btn" id="change-pass-btn" />
                        </div>
                    </form>
                </div>
            </div>
        
        <?php else: ?>
            <div class="row" style="margin-top: 6rem;">
                <div class="col-lg-6 offset-lg-3">
                    <h3 class="text-center">Iniciar Sessão</h3>
                    <hr class="mx-auto">
                    <form action="account.php" method="post">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="O seu email" required>
                        </div>
                        <div class="mb-3">
                            <label>Palavra-passe</label>
                            <input type="password" class="form-control" name="password" placeholder="A sua palavra-passe" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Entrar</button>
                        <!-- Link para página de registo -->
                        <p class="mt-3">Não tem conta? <a href="register.php">Crie uma aqui</a></p>
                    </form>
                </div>
            </div>
        <?php endif; ?>
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
