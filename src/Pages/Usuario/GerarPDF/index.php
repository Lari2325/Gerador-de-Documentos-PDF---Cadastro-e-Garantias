<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de PDF</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <main>
        <button id="downloadBtn">Baixar PDF</button>
    </main>
    <section class="pdf" id="documento">
        <div class="page">
            <?php
                if(isset($_SESSION['user_data'])) {
                    $userData = $_SESSION['user_data'];
                    echo "<h2>Informações do Cliente:</h2>";
                    echo "Nome Completo: " . htmlspecialchars($userData['nome_completo']) . "<br>";
                    echo "CPF: " . htmlspecialchars($userData['cpf']) . "<br>";
                    echo "RG: " . htmlspecialchars($userData['rg']) . "<br>";
                    echo "Endereço: " . htmlspecialchars($userData['endereco']) . "<br>";
                    echo "Cidade: " . htmlspecialchars($userData['cidade']) . "<br>";
                    echo "UF: " . htmlspecialchars($userData['uf']) . "<br>";
                    echo "CEP: " . htmlspecialchars($userData['cep']) . "<br>";
                    echo "Celular/Telefone: " . htmlspecialchars($userData['celular_telefone']) . "<br>";
                    echo "Email: " . htmlspecialchars($userData['email']) . "<br>";
                    echo "Data de Nascimento: " . htmlspecialchars($userData['dt_nascimento']) . "<br>";
                    echo "Estado Civil: " . htmlspecialchars($userData['estado_civil']) . "<br>";
                    echo "Número da Casa: " . htmlspecialchars($userData['numero_casa']) . "<br>";

                    echo "<h2>Informações do Revendedor:</h2>";
                    echo "Nome do Revendedor: " . htmlspecialchars($userData['revendedor_nome']) . "<br>";

                    echo "<h2>Informações da Piscina:</h2>";
                    echo "Modelo da Piscina: " . htmlspecialchars($userData['modelo_piscina']) . "<br>";

                    echo "<h2>Informações do Documento:</h2>";
                    echo "Data da Compra: " . htmlspecialchars($userData['data_compra']) . "<br>";
                    echo "Data da Instalação: " . htmlspecialchars($userData['data_instalacao']) . "<br>";
                    echo "Número de Garantia: " . htmlspecialchars($userData['numero_garantia']) . "<br>";
                } else {
                    echo "Nenhuma informação de usuário encontrada.";
                }
            ?>
        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('downloadBtn').addEventListener('click', () => {
            var element = document.getElementById('documento');
            var opt = {
                margin:       0,
                filename:     'documento.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        });
    </script>
</body>
</html>