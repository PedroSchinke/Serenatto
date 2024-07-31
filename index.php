<?php

    use Dbseller\ProjetoInicial\Infra\Persistence\ConexaoBd;
    use Dbseller\ProjetoInicial\Model\Product;
    use Dbseller\ProjetoInicial\Repository\ProductRepository;

    require_once 'vendor/autoload.php';

    $pdo = ConexaoBd::createConnection();

    $produtosRepositorio = new ProductRepository($pdo);
    $dadosCafe = $produtosRepositorio->coffeeOptions();
    $dadosAlmoco = $produtosRepositorio->lunchOptions();
    
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title>
</head>
<body>
    <main>
        <section class="container-banner">
            <div class="container-texto-banner">
                <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
            </div>
        </section>
        <h2>Cardápio Digital</h2>
        <section class="container-cafe-manha">
            <div class="container-cafe-manha-titulo">
                <h3>Opções para o Café</h3>
                <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-cafe-manha-produtos">
                <?php foreach ($dadosCafe as $cafe): ?>

                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $cafe->getImageDirectory() ?>">
                    </div>
                    <p><?= $cafe->getName() ?></p>
                    <p><?= $cafe->getDescription() ?></p>
                    <p><?= $cafe->getFormattedPrice() ?></p>
                </div>

                <?php endforeach; ?>
            </div>
        </section>
        <section class="container-almoco">
            <div class="container-almoco-titulo">
                <h3>Opções para o Almoço</h3>
                <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-almoco-produtos">
                <?php foreach ($dadosAlmoco as $almoco): ?>

                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $almoco->getImageDirectory() ?>">
                    </div>
                    <p><?= $almoco->getName() ?></p>
                    <p><?= $almoco->getDescription() ?></p>
                    <p><?= $almoco->getFormattedPrice() ?></p>
                </div>

                <?php endforeach; ?>
            </div>

        </section>
    </main>
</body>
</html>