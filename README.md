Projeto de um website ecomerce que permite explorar produtos, adicionar ao carrinho, realizar o checkout, gerir conta de utilizadores e produtos através de um backend administrativo.

## 1. Ferramentas e Tecnologias Utilizadas
Para alcançar os objetivos do projeto, foram utilizadas as seguintes tecnologias e recursos:

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

(É recomendada a visualização do site para uma melhor perceção do trabalho desenvolvido.)

---

## 3. Descrição do Trabalho Efetuado

### 3.1. Desenvolvimento de Ficheiros
Para a criação do site foram desenvolvidos vários ficheiros que integram páginas e funcionalidades, combinando front-end e back-end. Aqui estão os principais ficheiros e respetivas funções:

- `front_page.php`: Página inicial com destaque ao botão “Comprar agora”, que redireciona o utilizador para a loja.
- `shop.php`: Página de listagem de produtos (dados provenientes da base de dados). Permite navegar para a página do produto ou adicionar ao carrinho.
- `single_product.php`: Página de detalhe do produto. Exibe imagem, categoria, nome, descrição e preço. Se o utilizador tiver sessão iniciada, pode adicionar comentários guardados na base de dados. Possibilita adicionar o produto ao carrinho.
- `cart.php`: Página do carrinho. Mostra os produtos selecionados, quantidades, preços parciais e total. Permite avançar para checkout.
- `checkout.php`: Página de finalização de compra. O utilizador preenche dados (nome, e-mail, telefone, cidade, morada). Nome e e-mail são pré-preenchidos para utilizadores autenticados. Mostra o total do carrinho e, ao finalizar, regista a compra e limpa o carrinho.
- `account.php`: Página de conta do utilizador. Se existir sessão iniciada, o utilizador pode visualizar/alterar dados (ex.: password). Caso não exista sessão, a página apresenta o formulário de autenticação.
- `register.php`: Página de registo. Contém um formulário (nome, e-mail e password). Após registo com sucesso, a sessão é iniciada e as credenciais ficam armazenadas na base de dados.
- `shop_admin.php`: Área administrativa (apenas para utilizadores com credenciais de administrador). Permite criar/adicionar novos produtos (nome, categoria, descrição, preço e imagem), guardando-os na base de dados para posterior listagem na loja.
- `contact.html`: Página informativa (ex.: ofertas/contacto).

Ficheiros de apoio e ativos:
- `server/connection.php`: Configuração e criação da ligação à base de dados.
- `server/get_products.php`: Endpoint/utilitário para obtenção de produtos.
- `assets/css/style.css`: Ficheiro de estilos com a identidade visual do site.
- `assets/imgs/`: Conjunto de imagens utilizadas no site, guardadas localmente.
- `tables.sql`: Script SQL com a criação de tabelas e dados de exemplo.

> Nota: Credenciais de administrador (para testes): e-mail `admin@gmail.com`, password `admin`.

### 3.2. Estrutura da Base de Dados
A base de dados foi modelada para suportar as principais funcionalidades da loja. As tabelas principais incluem:

- **Produtos**: Guarda nome, categoria, descrição, preço e imagem(s). Pode suportar avaliações/ratings.
- **Utilizadores**: Regista dados dos clientes, incluindo credenciais (password encriptada) e metadados de conta.
- **Pedidos**: Regista transações, associando utilizador, linhas de produto, valores e data.
- **Comentários**: Associa comentários de utilizadores autenticados aos produtos (inclui `user_id` e `product_id`).

Esta estrutura permite:
- Listar produtos, consultar detalhes e respetivos comentários;
- Gerir contas e sessões de utilizadores;
- Criar registos de compra consistentes com o conteúdo do carrinho.

### 3.3. Alguns Pontos Adicionais
- **Design Refinado**: Ajustes de espaçamento, cores e imagens para coerência visual com o tema da loja.
- **Navbar e Footer**: Presentes em todas as páginas, facilitando a navegação e uniformizando o layout.
- **Linguagem**: O site encontra-se em português (pt-PT).
- **Utilização Local**: Totalmente operável com XAMPP, importando a base de dados via `tables.sql` e servindo com `php -S` (ou Apache).

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

## Créditos
Imagens utilizadas apenas para fins educativos.
