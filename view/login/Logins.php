<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="view/login/stylelogin.css">
	<link rel="shortcut icon" href="logosospet.png">
</head>
<meta charset="utf-8">
<body>
	<div class="resgistroformulario"><h1>Login</h1></div>
	<div class="conteudo">
		<form action="index.php?classe=LoginController&metodo=logar" method="post">

			<input type="radio" name="opcao" value="ong"> Logar como ONG 
			<input type="radio" name="opcao" value="usuario"> Logar como Usuário
			
			<h2 class="nome">Email:</h2>
			<input class="email" type="text" name="email" placeholder="Digite o seu Email...">

			<h2 class="nome">Senha:</h2>
			<input class="senha" type="password" name="senha" placeholder="Digite a sua Senha...">

			<br>
			<p align="right">
  				<input class="botao" type="submit" value="Logar" />
			</p>

		</form>
	</div>

</body>
</html>