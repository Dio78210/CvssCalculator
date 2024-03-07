
<?php

/////////////////////////BASE SCORE

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['AV']) && isset($_GET['AC']) && isset($_GET['PR']) && isset($_GET['C']) && isset($_GET['I']) && isset($_GET['A'])) {
// Récupérer les données du formulaire dans un tableau
$av = $_GET['AV']; // Access Vector
$ac = $_GET['AC']; // Access Complexity
$pr = $_GET['PR']; // Authentication Required
$c = $_GET['C'];   // Confidentiality Impact
$i = $_GET['I'];   // Integrity Impact
$a = $_GET['A'];   // Availability Impact

// Définir les valeurs pour les différents cas possibles dans un tableau

// Access Vector (AV)
$accessVectorValues = [
    'L' => 0.395, //L = local
    'M' => 0.646, //M = Medium
    'H' => 1.0 // H = High
];

// Access Complexity (AC) OK
$accessComplexityValues = [
    'L' => 0.71,
    'M' => 0.61,
    'H' => 0.35
];

// Authentication Required (PR) OK
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

// Calculer le score de base
$impact = 10.41 * (1 - (1 - $confidentialityImpactValues[$c]) * (1 - $integrityImpactValues[$i]) * (1 - $availabilityImpactValues[$a]));
$exploitability = 20 * $accessComplexityValues[$ac] * $authenticationValues[$pr] * $accessVectorValues[$av];

$fImpact = ($impact == 0) ? 0 : 1.176;
// $baseScore = ($fImpact * $impact + 0.4 * $exploitability);
$baseScore = (.6 * $impact + .4 * $exploitability - 1.5) * ($fImpact);

//avoir 1 chiffre après la virgule
$baseScoreFormat = number_format($baseScore, 1);
$impactFormat = number_format($impact, 1);
$exploitabilityFormat = number_format($exploitability, 1);

// Afficher le score de base
// echo "Base Score: " . $baseScoreFormat;

}


/////////////////////////TEMPORAL SCORE

// if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['E']) && isset($_GET['RL'])&& isset($_GET['RC'])){


//     $e = $_GET['E']; // Exploitabilité
//     $rl = $_GET['RL']; // Remediation Level
//     $rc = $_GET['RC'];   // Report Confidence


//     // Exploitabilité (E) 
//     $exploitabiliteValues = [
//     'ND' => 1,
//     'POC' => 0.9,
//     'F' => 0.95,
//     'H' => 1,
//     'U' => 0.85
//     ];

//     // Remediation Level (RL)
//     $RemediationLevelValues = [
//         'OF' => 0.87,
//         'TF' => 0.90,
//         'W' => 0.95,
//         'U' => 1,
//         'ND' => 1
//     ];

//     // Report Confidence (RC)
//     $ReportConfidenceValues = [
//         'UC' => 0.90,
//         'UR' => 0.95,
//         'C' => 1,
//         'ND' => 1
//     ];



//     $TemporalScore = $baseScore * $exploitabiliteValues[$e] * $RemediationLevelValues[$rl] * $ReportConfidenceValues[$rc];

//     $TemporalScoreFormat = number_format($TemporalScore, 1);














// }
