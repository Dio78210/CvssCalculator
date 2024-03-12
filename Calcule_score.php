<?php

function calculateScores()
{
    $baseScoreFormat = null;
    $impactFormat = null;
    $exploitabilityFormat = null;
    $TemporalScoreFormat = null;

    /////////////////////////BASE SCORE

    $impact = 0;
    $exploitability = 0;

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['AV']) && isset($_GET['AC']) && isset($_GET['PR']) && isset($_GET['C']) && isset($_GET['I']) && isset($_GET['A']) && isset($_GET['E']) && isset($_GET['RL']) && isset($_GET['RC'])) {
        // Récupérer les données du formulaire dans un tableau
        $av = $_GET['AV']; // Access Vector
        $ac = $_GET['AC']; // Access Complexity
        $pr = $_GET['PR']; // Authentication Required
        $c = $_GET['C'];   // Confidentiality Impact
        $i = $_GET['I'];   // Integrity Impact
        $a = $_GET['A'];   // Availability Impact
        $e = $_GET['E']; // Exploitabilité
        $rl = $_GET['RL']; // Remediation Level
        $rc = $_GET['RC'];   // Report Confidence

        // Définir les valeurs pour les différents cas possibles dans un tableau

        // Access Vector (AV)
        $accessVectorValues = [
            'L' => 0.395, //L = local
            'M' => 0.646, //M = Medium
            'H' => 1.0 // H = High
        ];

        // Access Complexity (AC)
        $accessComplexityValues = [
            'L' => 0.71,
            'M' => 0.61,
            'H' => 0.35
        ];

        // Authentication (PR)
        $authenticationValues = [
            'N' => 0.704, //N = No authentification
            'S' => 0.56, // S = Single instance of authentication
            'M' => 0.45 // M = multiple instances of authentication
        ];

        // Confidentiality Impact (C)
        $confidentialityImpactValues = [
            'N' => 0, // N = none
            'P' => 0.275, // P = Partial
            'C' => 0.66 // C = Complete
        ];

        // Integrity Impact (I)
        $integrityImpactValues = [
            'N' => 0,
            'P' => 0.275,
            'C' => 0.66
        ];

        // Availability Impact (A)
        $availabilityImpactValues = [
            'N' => 0,
            'P' => 0.275,
            'C' => 0.66
        ];

        // Exploitabilité (E)
        $exploitabiliteValues = [
            'U' => 0.85, // unproven
            'POC' => 0.9, // proof-of-concept
            'F' => 0.95, // functional
            'H' => 1.00, // high
            'ND' => 1.00 // not defined
        ];

        // Remediation Level (RL)
        $RemediationLevelValues = [
            'OF' => 0.87, // official-fix
            'TF' => 0.90, // temporary-fix
            'W' => 0.95, // workaround
            'U' => 1.00, // unavailable
            'ND' => 1.00 // not defined
        ];

        // Report Confidence (RC)
        $ReportConfidenceValues = [
            'UC' => 0.90, // unconfirmed
            'UR' => 0.95, // uncorroborated
            'C' => 1.00, // confirmed
            'ND' => 1.00 // not defined
        ];

        // Calculer l'impact
        $impact = 10.41 * (1 - (1 - $confidentialityImpactValues[$c]) * (1 - $integrityImpactValues[$i]) * (1 - $availabilityImpactValues[$a]));
        
        // Calculer l'exploitabilité
        $exploitability = 20 * $accessComplexityValues[$ac] * $authenticationValues[$pr] * $accessVectorValues[$av];

        // Calculer le score de base
        $baseScore = (.6 * $impact + .4 * $exploitability - 1.5);

        // Ajuster le score de base
        $fImpact = ($impact == 0) ? 0 : 1.176;
        $baseScore *= $fImpact;

        // Calculer le score temporel
        $TemporalScore = $baseScore * $exploitabiliteValues[$e] * $RemediationLevelValues[$rl] * $ReportConfidenceValues[$rc];

        // Formater les valeurs
        $baseScoreFormat = number_format($baseScore, 1);
        $impactFormat = number_format($impact, 1);
        $exploitabilityFormat = number_format($exploitability, 1);
        $TemporalScoreFormat = number_format($TemporalScore, 1);
    }

    return [
        'baseScoreFormat' => $baseScoreFormat,
        'impactFormat' => $impactFormat,
        'exploitabilityFormat' => $exploitabilityFormat,
        'TemporalScoreFormat' => $TemporalScoreFormat
    ];

    
}