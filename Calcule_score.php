<?php

function calculateScores()
{
    $baseScoreFormat = null;
    $impactFormat = null;
    $exploitabilityFormat = null;
    $TemporalScoreFormat = null;
    $EnvironmentalScoreFormat = null;
    $AdjustedImpactFormat = null;


    $impact = 0;
    $exploitability = 0;

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['AV']) && isset($_GET['AC']) && isset($_GET['PR']) && isset($_GET['C']) && isset($_GET['I']) && isset($_GET['A']) && isset($_GET['E']) && isset($_GET['RL']) && isset($_GET['RC']) && isset($_GET['CDP']) && isset($_GET['TD']) && isset($_GET['CR']) && isset($_GET['IR']) && isset($_GET['AR'])) {
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
        $cdp = $_GET['CDP']; // Collateral Damage Potential
        $td = $_GET['TD']; // Target Distribution
        $cr = $_GET['CR']; // Confidentiality Requirement
        $ir = $_GET['IR']; // Integrity Requirement
        $ar = $_GET['AR']; // Availability Requirement

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

        //CollateralDamagePotential (CDP)
        $CollateralDamagePotentialValue = [
            'N' => 0, //none = 0
            'L' => 0.1, //low = 0.1
            'LM' => 0.3, //low-medium = 0.3
            'MH' => 0.4, //medium-high = 0.4
            'H' => 0.5, //high = 0.5
            'ND' => 0 //not defined = 0
        ];

        //TargetDistribution (TD)
        $TargetDistributionValue = [
            'N' => 0, //none = 0
            'L' => 0.25, //low = 0.25
            'M' => 0.75, //medium = 0.75
            'H' => 1.00, //high = 1.00
            'ND' => 1.00 //not defined = 1.00
        ];

        //Confidentiality Requirement (CR)
        $ConfidentialityRequirementValue = [
            'L' => 0.5, //low = 0.5
            'M' => 1, //medium = 1
            'H' => 1.51, //high = 1.51
            'ND' => 1 //not defined = 1
        ];

        //Integrity Requirement (IR)
        $IntegrityRequirementValue = [
            'L' => 0.5, //low = 0.5
            'M' => 1, //medium = 1
            'H' => 1.51, //high = 1.51
            'ND' => 1 //not defined = 1
        ];

        //Availability Requirement (AR)
        $AvailabilityRequirementValue = [
            'L' => 0.5, //low = 0.5
            'M' => 1, //medium = 1
            'H' => 1.51, //high = 1.51
            'ND' => 1 //not defined = 1
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

        // Calculer le score environnementale
        $AdjustedImpact = Min(10, 10.41 * (1 - (1 - $confidentialityImpactValues[$c] * $ConfidentialityRequirementValue[$cr]) * (1 - $integrityImpactValues[$i] * $IntegrityRequirementValue[$ir]) * (1 - $availabilityImpactValues[$a] * $AvailabilityRequirementValue[$ar])));

        $AdjustedTemporal = (.6 * $AdjustedImpact + .4 * $exploitability - 1.5) * $fImpact * $exploitabiliteValues[$e] * $RemediationLevelValues[$rl] * $ReportConfidenceValues[$rc];
        $EnvironmentalScore = ($AdjustedTemporal + (10 - $AdjustedTemporal) * $CollateralDamagePotentialValue[$cdp]) * $TargetDistributionValue[$td];


        // Formater les valeurs
        $baseScoreFormat = number_format($baseScore, 1);
        $impactFormat = number_format($impact, 1);
        $exploitabilityFormat = number_format($exploitability, 1);
        $TemporalScoreFormat = number_format($TemporalScore, 1);
        $EnvironmentalScoreFormat = number_format($EnvironmentalScore, 1);
        $AdjustedImpactFormat = number_format($AdjustedImpact, 1);
    }

    return [
        'baseScoreFormat' => $baseScoreFormat,
        'impactFormat' => $impactFormat,
        'exploitabilityFormat' => $exploitabilityFormat,
        'TemporalScoreFormat' => $TemporalScoreFormat,
        'EnvironmentalScoreFormat' => $EnvironmentalScoreFormat,
        'AdjustedImpactFormat' => $AdjustedImpactFormat
    ];
}

// Calcule Overall Score
function calculateOverallScore() {
    // Récupérer les scores calculés
    $baseScoreFormat = calculateScores()['baseScoreFormat'];
    $TemporalScoreFormat = calculateScores()['TemporalScoreFormat'];
    $EnvironmentalScoreFormat = calculateScores()['EnvironmentalScoreFormat'];

    // Déterminer le score global en suivant l'arbre de décision
    if ($baseScoreFormat !== null) {
        if ($EnvironmentalScoreFormat !== null) {
            return $EnvironmentalScoreFormat;
        } elseif ($TemporalScoreFormat !== null) {
            return $TemporalScoreFormat;
        } else {
            return $baseScoreFormat;
        }
    } else {
        return "Not Defined";
    }
}

