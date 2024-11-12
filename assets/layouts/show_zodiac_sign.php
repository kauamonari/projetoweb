<?php include 'header.php'; ?>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <?php
                // Carrega o arquivo XML
                $xml_file = 'C:\xampp\htdocs\signos.xml';
                if (!file_exists($xml_file)) {
                    echo "<p class='text-danger'>Erro: O arquivo XML não foi encontrado.</p>";
                    exit;
                }

                $xml_content = file_get_contents($xml_file);
                if ($xml_content === false) {
                    echo "<p class='text-danger'>Erro: Não foi possível ler o arquivo XML.</p>";
                    exit;
                }

                $xml = simplexml_load_string($xml_content);

                // Recebe a data do formulário
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $data_input = $_POST['data'];
                    
                    // Valida a data
                    if (!preg_match('/^\d{2}\/\d{2}$/', $data_input)) {
                        echo "<p class='text-danger'>Erro: Data inválida. Use o formato dd/mm.</p>";
                        exit;
                    }

                    list($dia, $mes) = explode('/', $data_input);

                    // Converte para número
                    $data_input_num = (int)$mes * 100 + (int)$dia;

                    $signo_encontrado = false;

                    foreach ($xml->signo as $signo) {
                        list($inicio_dia, $inicio_mes) = explode('/', $signo->dataInicio);
                        list($fim_dia, $fim_mes) = explode('/', $signo->dataFim);

                        $inicio_num = (int)$inicio_mes * 100 + (int)$inicio_dia;
                        $fim_num = (int)$fim_mes * 100 + (int)$fim_dia;

                        // Ajusta o intervalo se o período atravessar o final do ano
                        if ($inicio_num > $fim_num) {
                            if ($data_input_num >= $inicio_num || $data_input_num <= $fim_num) {
                                $signo_encontrado = $signo;
                                break;
                            }
                        } else {
                            if ($data_input_num >= $inicio_num && $data_input_num <= $fim_num) {
                                $signo_encontrado = $signo;
                                break;
                            }
                        }
                    }

                    if ($signo_encontrado) {
                        echo "<h2 class='card-title'>Seu signo é " . htmlspecialchars($signo_encontrado->signonome) . "</h2>";
                        echo "<p><strong>Período:</strong> " . htmlspecialchars($signo_encontrado->dataInicio) . " - " . htmlspecialchars($signo_encontrado->dataFim) . "</p>";
                        echo "<p><strong>Descrição:</strong> " . htmlspecialchars($signo_encontrado->descricao) . "</p>";
                    } else {
                        echo "<p class='text-danger'>Não foi possível determinar o signo para a data fornecida.</p>";
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php include 'header.php'; ?>