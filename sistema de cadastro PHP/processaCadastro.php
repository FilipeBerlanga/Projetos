<h2 style="font-weight: bold;">Dados Cadastrados com Sucesso!</h2>

<?php
$nome         = $_POST['nome'];
$idade        = $_POST['idade'];
$profissao    = $_POST['profi'];
$salario      = $_POST['sal'];
$expAnterior  = $_POST['exp_anterior'];

echo "Nome: {$nome}<br>";
echo "Idade: {$idade}<br>";
echo "Profissão: {$profissao}<br>";
echo "Salário pretendido: R$ {$salario}<br>";
echo "Experiência Anterior: {$expAnterior}<br>";
echo "<br>";
echo "Bem-vindo(a), {$nome}! Ficamos felizes com seu interesse na vaga de {$profissao} nas Lojas Brincos e Companhia. Avaliaremos com carinho o seu histórico: \"{$expAnterior}\". <br>";

$formulario = "cadastro.html";
?>
<br>
<a href="<?php echo $formulario; ?>">
    <button type="button">Voltar ao formulário</button>
</a>