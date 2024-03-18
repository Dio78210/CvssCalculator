<?php
// Inclure le fichier Calcule_score.php pour le traitement du formulaire
include "Calcule_score.php";
$score = calculateScores(); // inclure la fonction
$overallScore = calculateOverallScore();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>CVSS Calculator V2</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CVSS Calculateur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#header">Calculator V2</a>
                    <a class="nav-link" href="#">Calculator V3</a>
                    <!-- <a class="nav-link" href="#">Pricing</a>
                    <a class="nav-link disabled">Disabled</a> -->
                </div>
            </div>
        </div>
    </nav>

    <div id="scroll_to_top">
        <a href="#top"><i class="bi bi-arrow-up"></i></a>
    </div>


    <h1 class="titre">CVSS Calculator V2</h1>

    <form action="" method="GET" id="Form" class="form">

        <fieldset>

            <legend id="header">Mesures du score de base</legend>

            <div class="note">

                <?php if (!empty($score['baseScoreFormat']) && !empty($score['impactFormat']) && !empty($score['exploitabilityFormat']) && !empty($score['TemporalScoreFormat']) && !empty($score['EnvironmentalScoreFormat']) && !empty($score['AdjustedImpactFormat'])) : ?>
                    <div class="TotalNote">
                        <p id="BaseNote"> Note de base : <?php echo $score["baseScoreFormat"]; ?> </p>
                        <p id="ImpactNote"> Note d'impact : <?php echo $score["impactFormat"]; ?> </p>
                        <p id="ExploitNote"> Note d'exploitabilité : <?php echo $score["exploitabilityFormat"]; ?> </p>
                        <p id="TemporelNote"> Note temporel : <?php echo $score['TemporalScoreFormat']; ?> </p>
                        <p id="EnvironmentalNote"> Note environnemental : <?php echo $score['EnvironmentalScoreFormat']; ?> </p>
                        <p id="AdjustedImpactNote"> Note impact ajusté : <?php echo $score['AdjustedImpactFormat']; ?> </p>
                        <p id="OverallScoreNote"> Note Overall Score : <?php echo $overallScore; ?> </p>
                    </div>
                <?php endif; ?>

            </div>

            <div class="scoreBase">
                <div class="row g-3" id="exploit">

                    <h2>Métriques d'exploitabilité</h2>

                    <div class="col-md-4">

                        <label for="AV">Access Vector (AV):</label>
                        <select name="AV" id="AV" class="form-control">
                            <option value="L" <?= isset($_GET['AV']) && $_GET['AV'] == 'L' ? 'selected' : '' ?>>Local (AV:L)</option>
                            <option value="M" <?= isset($_GET['AV']) && $_GET['AV'] == 'M' ? 'selected' : '' ?>>Réseau adjacent (AV:A)</option>
                            <option value="H" <?= isset($_GET['AV']) && $_GET['AV'] == 'H' ? 'selected' : '' ?>>Network (AV:N)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="AC">Access Complexity (AC):</label>
                        <select name="AC" id="AC" class="form-control">
                            <option value="L" <?= isset($_GET['AC']) && $_GET['AC'] == 'L' ? 'selected' : '' ?>>Low (AC:L)</option>
                            <option value="M" <?= isset($_GET['AC']) && $_GET['AC'] == 'M' ? 'selected' : '' ?>>Medium (AC:M)</option>
                            <option value="H" <?= isset($_GET['AC']) && $_GET['AC'] == 'H' ? 'selected' : '' ?>>High (AC:H)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="PR">Authentication (Au):</label>
                        <select name="PR" id="PR" class="form-control">
                            <option value="N" <?= isset($_GET['PR']) && $_GET['PR'] == 'N' ? 'selected' : '' ?>>None (Au:N)</option>
                            <option value="S" <?= isset($_GET['PR']) && $_GET['PR'] == 'S' ? 'selected' : '' ?>>Single (Au:S)</option>
                            <option value="M" <?= isset($_GET['PR']) && $_GET['PR'] == 'M' ? 'selected' : '' ?>>Multiple (Au:M)</option>
                        </select>

                    </div>
                </div>

                <div class="row g-3" id="impact">

                    <h2>Mesures d'impact</h2>

                    <div class="col-md-4">

                        <label for="C">Confidentiality Impact (C):</label>
                        <select name="C" id="C" class="form-control">
                            <option value="N" <?= isset($_GET['C']) && $_GET['C'] == 'N' ? 'selected' : '' ?>>None (C:N)</option>
                            <option value="P" <?= isset($_GET['C']) && $_GET['C'] == 'P' ? 'selected' : '' ?>>Partial (C:P)</option>
                            <option value="C" <?= isset($_GET['C']) && $_GET['C'] == 'C' ? 'selected' : '' ?>>Complete (C:C)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="I">Integrity Impact (I):</label>
                        <select name="I" id="I" class="form-control">
                            <option value="N" <?= isset($_GET['I']) && $_GET['I'] == 'N' ? 'selected' : '' ?>>None (I:N)</option>
                            <option value="P" <?= isset($_GET['I']) && $_GET['I'] == 'P' ? 'selected' : '' ?>>Partial (I:P)</option>
                            <option value="C" <?= isset($_GET['I']) && $_GET['I'] == 'C' ? 'selected' : '' ?>>Complete (I:C)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="A">Availability Impact (A):</label>
                        <select name="A" id="A" class="form-control">
                            <option value="N" <?= isset($_GET['A']) && $_GET['A'] == 'N' ? 'selected' : '' ?>>None (A:N)</option>
                            <option value="P" <?= isset($_GET['A']) && $_GET['A'] == 'P' ? 'selected' : '' ?>>Partial (A:P)</option>
                            <option value="C" <?= isset($_GET['A']) && $_GET['A'] == 'C' ? 'selected' : '' ?>>Complete (A:C)</option>
                        </select>

                    </div>

                </div>

            </div>

        </fieldset>

        <fieldset id="ScoreTemporel">

            <legend id="header">Mesures de score temporel</legend>

            <div class="scoreBase">
                <div class="row g-3" id="tempo">

                    <div class="col-md-4">

                        <label for="E">Exploitabilité (E):</label>
                        <select name="E" id="E" class="form-control">
                            <option value="ND" <?= isset($_GET['E']) && $_GET['E'] == 'ND' ? 'selected' : '' ?>>Not Defined (E:ND)</option>
                            <option value="U" <?= isset($_GET['E']) && $_GET['E'] == 'U' ? 'selected' : '' ?>>Unproven That exploit exists (E:U)</option>
                            <option value="POC" <?= isset($_GET['E']) && $_GET['E'] == 'POC' ? 'selected' : '' ?>>Proof of concept code (E:POC)</option>
                            <option value="F" <?= isset($_GET['E']) && $_GET['E'] == 'F' ? 'selected' : '' ?>>Functional exploit exists (E:F)</option>
                            <option value="H" <?= isset($_GET['E']) && $_GET['E'] == 'H' ? 'selected' : '' ?>>High (E:H)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="RL">Remediation Level (RL):</label>
                        <select name="RL" id="RL" class="form-control">
                            <option value="ND" <?= isset($_GET['RL']) && $_GET['RL'] == 'ND' ? 'selected' : '' ?>>Not Defined (RL:ND)</option>
                            <option value="OF" <?= isset($_GET['RL']) && $_GET['RL'] == 'OF' ? 'selected' : '' ?>>Official fix (RL:OF)</option>
                            <option value="TF" <?= isset($_GET['RL']) && $_GET['RL'] == 'TF' ? 'selected' : '' ?>>Temporary fix (RL:TF)</option>
                            <option value="W" <?= isset($_GET['RL']) && $_GET['RL'] == 'W' ? 'selected' : '' ?>>Workaround (RL:W)</option>
                            <option value="U" <?= isset($_GET['RL']) && $_GET['RL'] == 'U' ? 'selected' : '' ?>>Unavailable (RL:U)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="RC">Report Confidence (RC):</label>
                        <select name="RC" id="RC" class="form-control">
                            <option value="ND" <?= isset($_GET['RC']) && $_GET['RC'] == 'ND' ? 'selected' : '' ?>>Not Defined (RC:ND)</option>
                            <option value="UC" <?= isset($_GET['RC']) && $_GET['RC'] == 'UC' ? 'selected' : '' ?>>Unconfirmed (RC:UC)</option>
                            <option value="UR" <?= isset($_GET['RC']) && $_GET['RC'] == 'UR' ? 'selected' : '' ?>>Uncorroborated (RC:UR)</option>
                            <option value="C" <?= isset($_GET['RC']) && $_GET['RC'] == 'C' ? 'selected' : '' ?>>Confirmed (RC:C)</option>
                        </select>

                    </div>
                </div>
            </div>

        </fieldset>

        <fieldset id="ScoreEnvironmental">

            <legend id="header">Mesures de score Environnemental</legend>

            <div class="scoreBase">
                <div class="row g-3" id="environmental">
                
                    <h2>Modificateurs généraux</h2>

                    <div class="col-md-4">

                        <label for="CDP">Collateral Damage Potential (CDP):</label>
                        <select name="CDP" id="CDP" class="form-control">
                            <option value="ND" <?= isset($_GET['CDP']) && $_GET['CDP'] == 'ND' ? 'selected' : '' ?>>Not Defined (CDP:ND)</option>
                            <option value="N" <?= isset($_GET['CDP']) && $_GET['CDP'] == 'N' ? 'selected' : '' ?>>None (CDP:N)</option>
                            <option value="L" <?= isset($_GET['CDP']) && $_GET['CDP'] == 'L' ? 'selected' : '' ?>>Low (light loss) (CDP:L)</option>
                            <option value="LM" <?= isset($_GET['CDP']) && $_GET['CDP'] == 'LM' ? 'selected' : '' ?>>Low-Medium (CDP:LM)</option>
                            <option value="MH" <?= isset($_GET['CDP']) && $_GET['CDP'] == 'MH' ? 'selected' : '' ?>>Medium-High (CDP:MH)</option>
                            <option value="H" <?= isset($_GET['CDP']) && $_GET['CDP'] == 'H' ? 'selected' : '' ?>>High (catastrophic loss) (CDP:H)</option>
                        </select>
                    </div>

                    <div class="col-md-4">

                        <label for="TD">Target Distribution (TD):</label>
                        <select name="TD" id="TD" class="form-control">
                            <option value="ND" <?= isset($_GET['TD']) && $_GET['TD'] == 'ND' ? 'selected' : '' ?>>Not Defined (TD:ND)</option>
                            <option value="N" <?= isset($_GET['TD']) && $_GET['TD'] == 'N' ? 'selected' : '' ?>>None [0%] (TD:N)</option>
                            <option value="L" <?= isset($_GET['TD']) && $_GET['TD'] == 'L' ? 'selected' : '' ?>>Low [0-25%] (TD:L)</option>
                            <option value="M" <?= isset($_GET['TD']) && $_GET['TD'] == 'M' ? 'selected' : '' ?>>Medium [26-75%] (TD:M)</option>
                            <option value="H" <?= isset($_GET['TD']) && $_GET['TD'] == 'H' ? 'selected' : '' ?>>High [76-100%] (TD:H)</option>
                        </select>

                    </div>

                    <h2>Modificateurs de sous-score d'impact</h2>

                    <div class="col-md-4">

                        <label for="CR">Confidentiality Requirement (CR):</label>
                        <select name="CR" id="CR" class="form-control">
                            <option value="ND" <?= isset($_GET['CR']) && $_GET['CR'] == 'ND' ? 'selected' : '' ?>>Not Defined (CR:ND)</option>
                            <option value="L" <?= isset($_GET['CR']) && $_GET['CR'] == 'L' ? 'selected' : '' ?>>Low (CR:L)</option>
                            <option value="M" <?= isset($_GET['CR']) && $_GET['CR'] == 'M' ? 'selected' : '' ?>>Medium (CR:M)</option>
                            <option value="H" <?= isset($_GET['CR']) && $_GET['CR'] == 'H' ? 'selected' : '' ?>>High (CR:H)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="IR">Integrity Requirement (IR):</label>
                        <select name="IR" id="IR" class="form-control">
                            <option value="ND" <?= isset($_GET['IR']) && $_GET['IR'] == 'ND' ? 'selected' : '' ?>>Not Defined (IR:ND)</option>
                            <option value="L" <?= isset($_GET['IR']) && $_GET['IR'] == 'L' ? 'selected' : '' ?>>Low (IR:L)</option>
                            <option value="M" <?= isset($_GET['IR']) && $_GET['IR'] == 'M' ? 'selected' : '' ?>>Medium (IR:M)</option>
                            <option value="H" <?= isset($_GET['IR']) && $_GET['IR'] == 'H' ? 'selected' : '' ?>>High (IR:H)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="AR">Availability Requirement (AR):</label>
                        <select name="AR" id="AR" class="form-control">
                            <option value="ND" <?= isset($_GET['AR']) && $_GET['AR'] == 'ND' ? 'selected' : '' ?>>Not Defined (AR:ND)</option>
                            <option value="L" <?= isset($_GET['AR']) && $_GET['AR'] == 'L' ? 'selected' : '' ?>>Low (AR:L)</option>
                            <option value="M" <?= isset($_GET['AR']) && $_GET['AR'] == 'M' ? 'selected' : '' ?>>Medium (AR:M)</option>
                            <option value="H" <?= isset($_GET['AR']) && $_GET['AR'] == 'H' ? 'selected' : '' ?>>High (AR:H)</option>
                        </select>

                    </div>
                </div>
            </div>

        </fieldset>

        <div class="submitform">
            <button type="submit" class="btn btn-primary">Lancer le calcul</button>
            <button type="button" id="resetBtn" class="btn btn-primary">Réinitialiser le formulaire</button>
        </div>

    </form>


    <script src="/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>