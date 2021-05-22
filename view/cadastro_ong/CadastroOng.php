<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>Formulário de cadastro</title>
	<link rel="stylesheet" type="text/css" href="view/cadastro_ong/styleong.css">
	<link rel="shortcut icon" href="logosospet.png">
   

	<script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            //document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            //document.getElementById('ibge').value=(conteudo.ibge);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                //document.getElementById('ibge').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>
</head>
<meta charset="utf-8">
<body>
	<div class="resgistroformulario"><h1>Cadastro de ONG ou Doadores</h1></div>
	<div class="conteudo">
		<form action="index.php?classe=OngController&metodo=cadastrar" method="post">

			<h2 class="nome">Nome da ONG:</h2>
			<input class="nomeong" type="text" 			name="nome" placeholder="Nome da Ong">

			<h2 class="nome">Email:</h2>
			<input class="email" type="text" 			name="email" placeholder="Email da ONG">

			<h2 class="nome">CPF:</h2>
			<input class="primeironome" type="text" 	name="cpf" placeholder="CPF">

			<h2 class="nome">Senha:</h2>
			<input class="senha" type="password" 			name="senha" placeholder="Digite uma senha">

			<h2 class="nome">Telefone com DDD: </h2>
			<input class="codigo" type="tel" 			name="telefone" placeholder="Telefone da ONG">

			
			<h2 class="nome">Endereço: (Insira seu CEP primeiro)</h2>
			<div class="endereco">
				<input class="cep" type="text" 			name="cep" id="cep" value="" placeholder="Aperte TAB" onblur="pesquisacep(this.value);">
				<label class="ceplabel">Cep:</label>
				<input class="cep" type="text" 			name="estado" id="uf" placeholder="UF" readonly>
				<label class="ceplabel">Estado:</label>
				<input class="cep" type="text" 			name="cidade" id="cidade" placeholder="Cidade" readonly>
				<label class="ceplabel">Cidade:</label>
			</div>
			<br>
			<br>
			<div>
				<input class="bairro" type="text" 		name="bairro" id="bairro" placeholder="Bairro" readonly>
				<label class="bairrolabel">Bairro:</label>
				<input class="bairro" type="text" 		name="rua" id="rua" placeholder=Rua readonly>
				<label class="bairrolabel">Rua:</label>
			</div>
			


			<br>
			<p align="right">
  				<input class="botao" type="submit" value="Cadastrar" />
			</p>

		</form>
	</div>

</body>
</html>