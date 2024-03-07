<?php
// Inclure le fichier Calcule_score.php pour le traitement du formulaire
include "Calcule_score.php";

// var_dump($_GET);
// var_dump($baseScoreFormat);
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


    <nav class="navbar navbar-expand-lg bg-light">
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


    <form action="" method="GET" class="form">

        <fieldset>


            <div id="header">Mesures du score de base</div>

            <div class="note">

                <?php if (isset($baseScoreFormat) && isset($impactFormat) && isset($exploitabilityFormat)) : ?>
                    <div class="TotalNote">
                        <p id="ExploitNote"> Note d'exploitabilité : <?php echo $exploitabilityFormat; ?> </p>
                        <p id="BaseNote"> Note de base : <?php echo $baseScoreFormat; ?> </p>
                        <p id="ImpactNote"> Note d'impact : <?php echo $impactFormat; ?> </p>
                    </div>
                <?php endif; ?>

            </div>

            <div id="scoreBase">
                <div class="row g-3" id="exploit">

                    <h2>Métriques d'exploitabilité</h2>

                    <div class="col-md-4">

                        <label for="AV">Access Vector (AV):</label>
                        <select name="AV" id="AV" class="form-control">
                            <option value="L">Local (AV:L)</option>
                            <option value="M">Réseau adjacent (AV:A)</option>
                            <option value="H">Network (AV:N)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="AC">Access Complexity (AC):</label>
                        <select name="AC" id="AC" class="form-control">
                            <option value="L">Low (AC:L)</option>
                            <option value="M">Medium (AC:M)</option>
                            <option value="H">High (AC:H)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="PR">Authentication (Au):</label>
                        <select name="PR" id="PR" class="form-control">
                            <option value="N">None (Au:N)</option>
                            <option value="S">Single (Au:S)</option>
                            <option value="M">Multiple (Au:M)</option>
                        </select>

                    </div>
                </div>



                <div class="row g-3" id="impact">

                    <h2>Mesures d'impact</h2>

                    <div class="col-md-4">

                        <label for="C">Confidentiality Impact (C):</label>
                        <select name="C" id="C" class="form-control">
                            <option value="N">None (C:N)</option>
                            <option value="P">Partial (C:P)</option>
                            <option value="C">Complete (C:C)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="I">Integrity Impact (I):</label>
                        <select name="I" id="I" class="form-control">
                            <option value="N">None (I:N)</option>
                            <option value="P">Partial (I:P)</option>
                            <option value="C">Complete (I:C)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="A">Availability Impact (A):</label>
                        <select name="A" id="A" class="form-control">
                            <option value="N">None (A:N)</option>
                            <option value="P">Partial (A:P)</option>
                            <option value="C">Complete (A:C)</option>
                        </select>

                    </div>

                </div>

            </div>
            <div class="submitform">
                <button type="submit" class="btn btn-primary">Lancer le calcul</button>
            </div>

        </fieldset>

    </form>



    <form action="" method="GET" class="form">

        <fieldset>


            <div id="header">Mesures de score temporel</div>

            <div class="note">

                <?php if (isset($baseScoreFormat)) : ?>
                    <p id="note"> Note de base : <?php echo $baseScoreFormat; ?> </p>
                <?php endif; ?>

            </div>

            <div id="scoreBase">
                <div class="row g-3" id="tempo">

                    <div class="col-md-4">

                        <label for="E">Exploitabilité (E):</label>
                        <select name="E" id="E" class="form-control">
                            <option value="ND">Not Defined (E:ND)</option>
                            <option value="U">Unproven That exploit exists (E:U)</option>
                            <option value="POC">Proof of concept code (E:POC)</option>
                            <option value="F">Functional exploit exists (E:F)</option>
                            <option value="H">High (E:H)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="RL">Remediation Level (RL):</label>
                        <select name="RL" id="RL" class="form-control">
                            <option value="ND">Not Defined (RL:ND)</option>
                            <option value="OF">Official fix (RL:OF)</option>
                            <option value="TF">Temporary fix (RL:TF)</option>
                            <option value="W">Workaround (RL:W)</option>
                            <option value="U">Unavailable (RL:U)</option>
                        </select>

                    </div>

                    <div class="col-md-4">

                        <label for="RC">Report Confidence (RC):</label>
                        <select name="RC" id="RC" class="form-control">
                            <option value="ND">Not Defined (RC:ND)</option>
                            <option value="UC">Unconfirmed (RC:UC)</option>
                            <option value="UR">Uncorroborated (RC:UR)</option>
                            <option value="C">Confirmed (RC:C)</option>
                        </select>

                    </div>
                </div>


            </div>
            <div class="submitform">
                <button type="submit" class="btn btn-primary">Lancer le calcul</button>
            </div>

        </fieldset>

    </form>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>