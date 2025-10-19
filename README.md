Projeto de Desenvolvimento Web

Criação de Website E-Commerce que permite explorar produtos, adicionar ao carrinho, realizar o checkout, gerir conta de utilizadores e produtos através de um backend administrativo.

## 1. Ferramentas e Tecnologias Utilizadas
No projeto, foram utilizadas as seguintes tecnologias e recursos:

- **Frontend**: HTML, CSS, Bootstrap e JavaScript
- **Backend**: PHP para a lógica de servidor e renderização dinâmica
- **Base de Dados**: MySQL para armazenamento de produtos, utilizadores, comentários e pedidos
- **Estilo e Recursos**: Google Fonts, ícones do Font Awesome e imagens locais na pasta `assets/imgs`

## 2. Requisitos para Execução do Site
1. Inicie o **XAMPP** e execute os serviços do **Apache** e **MySQL**.
2. No navegador, aceda a `http://localhost/phpmyadmin` e crie a base de dados `php_projects`. Em seguida, **importe** o ficheiro `tables.sql` (incluído no projeto) para criar e povoar as tabelas.
3. Configure as credenciais de base de dados em `server/connection.php` (host, nome da base de dados, utilizador e password).
4. Na raiz do projeto, execute o servidor embutido do PHP:
   ```bash
   php -S localhost:8000
   ```
5. No navegador, aceda a `http://localhost:8000/front_page.php`.
   
7. Caso queria pode aceder ao painel administrativo com o e-mail `admin@gmail.com` e password `admin`.

---

## Estrutura do Projeto
```
assets/
  css/style.css
  imgs/
server/
  connection.php
  get_products.php
account.php
cart.php
checkout.php
contact.html
front_page.php
register.php
shop_admin.php
shop.php
single_product.php
tables.sql
```

## Licença
GNU v3.0
