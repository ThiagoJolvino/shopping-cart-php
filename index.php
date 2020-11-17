<?php 
    session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinhos de compra PHP</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <h2 class="titulo">Carrinho PHP</h2>
    <div class="carrinho-container">
<?php 
    
    $items = array(['nome'=>'Curso de CSS3','imagem'=>'img/css3.png','preco'=>'200'],
                    ['nome'=>'Curso de HTML','imagem'=>'img/HTML.png','preco'=>'400'],
                    ['nome'=>'Curso de JavaScript','imagem'=>'img/Javascript.png','preco'=>'1000']);

    foreach ($items as $key => $value) {
?> 
    <div class="produto">
        <img src="<?php echo $value['imagem'] ?>" />
        <a href="?adicionar=<?php echo $key ?>">Adicionar ao carrinho!</a>
    

    </div> 
<?php 
   }
?>
    </div><!--carrinho container-->


   <?php 
    if(isset($_GET['adicionar'])){
        //vamos adicionar ao carrinho
        $idProduto = (int) $_GET['adicionar'];
        if(isset($items[$idProduto])){
            if(isset($_SESSION['carrinho'][$idProduto])){
                $_SESSION['carrinho'][$idProduto]['quantidade']++;
            }else{
                $_SESSION['carrinho'][$idProduto] = array('quantidade'=>1,'nome'=>$items[$idProduto]['nome'],'preco'=>$items[$idProduto][
                'preco']);
            }
            echo '<script>alert("O item foi adicionado ao carrinho.");</script>';
        }else {
            die('Você não pode adicionar um item que não existe.');
        }
    }


   ?> 

    <h2 class='titulo'>Carrinho: </h2>


    <?php 
        foreach ($_SESSION['carrinho'] as $key => $value) {
           //Nome do produto
           //Quantidade
           //Preço

           echo '<div class="carrinho-item">';
           echo '<p>Nome: '.$value['nome'].' | Quantidade: '.$value['quantidade'].
           ' | Preço: R$'.($value['quantidade']*$value['preco']).',00</p>';
           echo '</div>';
        }
        
        

    ?>
</body>
</html>