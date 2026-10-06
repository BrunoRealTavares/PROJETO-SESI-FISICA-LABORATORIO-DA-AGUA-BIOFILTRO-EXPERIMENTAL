<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratório de Qualidade da Água & Biofiltro | ODS 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <header class="pb-3 mb-4 border-bottom">
            <h1 class="text-primary fw-bold">Simulador de Qualidade da Água & Biofiltro</h1>
            <p class="text-muted mb-0">Análise de potabilidade e eficiência de filtragem experimental (Alinhado com a ODS 6)</p>
        </header>

        <div class="row g-4">
            <!-- Form de Entrada de Dados -->
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-bold">
                        Entrada de Parâmetros da Amostra
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="mb-3">
                                <label for="ph" class="form-label">pH (Potencial Hidrogeniônico)</label>
                                <input type="number" step="0.1" min="0" max="14" class="form-control" id="ph" name="ph" value="<?= $_POST['ph'] ?? '7.2' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="turbidez" class="form-label">Turbidez (NTU)</label>
                                <input type="number" step="0.1" min="0" class="form-control" id="turbidez" name="turbidez" value="<?= $_POST['turbidez'] ?? '15.0' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cloro" class="form-label">Cloro Residual (mg/L)</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="cloro" name="cloro" value="<?= $_POST['cloro'] ?? '1.5' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="dureza" class="form-label">Dureza Total (mg/L CaCO₃)</label>
                                <input type="number" step="1" min="0" class="form-control" id="dureza" name="dureza" value="<?= $_POST['dureza'] ?? '120' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="temperatura" class="form-label">Temperatura (°C)</label>
                                <input type="number" step="0.1" class="form-control" id="temperatura" name="temperatura" value="<?= $_POST['temperatura'] ?? '23.5' ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 fw-bold">Analisar Amostra e Filtragem</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Painel de Resultados -->
            <div class="col-md-7">
                <?php if (isset($resultado)): ?>
                    <!-- Eficiência do Biofiltro -->
                    <div class="alert alert-info shadow-sm mb-4">
                        <h4 class="alert-heading fw-bold">Eficiência do Biofiltro</h4>
                        <p class="mb-0">Taxa de remoção de turbidez: <strong><?= $resultado['eficienciaBiofiltro'] ?></strong></p>
                    </div>

                    <div class="row g-3">
                        <!-- Amostra Bruta -->
                        <div class="col-md-6">
                            <div class="card border-warning shadow-sm h-100">
                                <div class="card-header bg-warning text-dark fw-bold">
                                    Antes do Filtro (Água Bruta)
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            pH: <?= $resultado['antesFiltro']['ph']['valor'] ?>
                                            <span class="badge bg-secondary"><?= $resultado['antesFiltro']['ph']['status'] ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Turbidez: <?= $resultado['antesFiltro']['turbidez']['valor'] ?> NTU
                                            <span class="badge bg-secondary"><?= $resultado['antesFiltro']['turbidez']['status'] ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Cloro: <?= $resultado['antesFiltro']['cloro']['valor'] ?> mg/L
                                            <span class="badge bg-secondary"><?= $resultado['antesFiltro']['cloro']['status'] ?></span>
                                        </li>
                                    </ul>
                                    <div class="text-center">
                                        <span class="badge fs-6 p-2 <?= $resultado['antesFiltro']['parecerFinal'] === 'Água Potável' ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $resultado['antesFiltro']['parecerFinal'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Amostra Filtrada -->
                        <div class="col-md-6">
                            <div class="card border-success shadow-sm h-100">
                                <div class="card-header bg-success text-white fw-bold">
                                    Depois do Filtro (Água Trata)
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            pH: <?= $resultado['depoisFiltro']['ph']['valor'] ?>
                                            <span class="badge bg-secondary"><?= $resultado['depoisFiltro']['ph']['status'] ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Turbidez: <?= $resultado['depoisFiltro']['turbidez']['valor'] ?> NTU
                                            <span class="badge bg-secondary"><?= $resultado['depoisFiltro']['turbidez']['status'] ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Cloro: <?= $resultado['depoisFiltro']['cloro']['valor'] ?> mg/L
                                            <span class="badge bg-secondary"><?= $resultado['depoisFiltro']['cloro']['status'] ?></span>
                                        </li>
                                    </ul>
                                    <div class="text-center">
                                        <span class="badge fs-6 p-2 <?= $resultado['depoisFiltro']['parecerFinal'] === 'Água Potável' ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $resultado['depoisFiltro']['parecerFinal'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card shadow-sm border-0 p-5 text-center text-muted">
                        <h4>Aguardando entrada de dados...</h4>
                        <p class="mb-0">Preencha os valores medidos na amostra no formulário ao lado para gerar o relatório e simular o biofiltro.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (isset($erro)): ?>
    <div class="alert alert-danger shadow-sm mb-4">
        <strong>Erro de Validação:</strong> <?= htmlspecialchars($erro) ?>
    </div>
<?php endif; ?>

</body>
</html>