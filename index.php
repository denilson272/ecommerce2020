<?php 
session_start();
// carrega todas as classes do projeto
require_once("vendor/autoload.php");

use \Slim\Slim;
// vai usar o Slim framework um gerenciador de rotas

$app = new Slim();
// instancia um novo objeto do tipo slim

$app->config('debug', true);

/* EXPLICAÇÃO DOS PATHS DAS CLASSES
COMPOSER JSON "Hcode\\": "vendor\\hcodebr\\php-classes\\src" por isso, Hcode\DB
\\ecommerce2020\vendor\hcodebr\php-classes\src\DB
\src onde estão as nossas classes: Mailer, Model, Page, PageAdmin
\DB namespace reservado somente para banco de dados - Sql
\Model namespace reservado para as classes Address, Cart, Category, Order, OrderStatus, Product, User

Teste de conexão com o banco de dados eccomerce e execução de uma consulta com retorno da tabela tb_users */

    $app->get ('/tbduser', function() {
    $sql = new Hcode\DB\Sql();
    //var_dump($sql);
    //exit;
    $results = $sql->select("SELECT * FROM tb_users");
    //var_dump($results);
    echo json_encode($results);
}); 

$app->get ('/tbdprod', function() {
    $sql = new Hcode\DB\Sql();
    //var_dump($sql);
    //exit;
    $results = $sql->select("SELECT * FROM tb_products");
    //var_dump($results);
    echo json_encode($results);
}); 

// carrega as funções e o site
require_once("functions.php");
require_once("site.php");


require_once("admin.php");
require_once("admin-users.php");
require_once("admin-categories.php");
require_once("admin-products.php");
require_once("admin-orders.php");

$app->run();

 ?>