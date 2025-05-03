<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

if (!isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}

$patientId = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;
if (!$patientId) {
    die("ID patient non spécifié");
}

// Fetch patient
$stmt = $pdo->prepare("SELECT * FROM patient WHERE id = ?");
$stmt->execute([$patientId]);
$patient = $stmt->fetch();
if (!$patient) {
    die("Patient non trouvé");
}

// Fetch medical history
$history = [];
if ($pdo->query("SHOW TABLES LIKE 'medical_visits'")->rowCount()) {
    $stmt = $pdo->prepare("SELECT * FROM medical_visits WHERE patient_id = ? ORDER BY visit_date DESC");
    $stmt->execute([$patientId]);
    $history = $stmt->fetchAll();
}

// DICOM files: adjust “series-00000” to your actual series folder if dynamic
$seriesFolder = __DIR__ . '/../dicom_images/series-00000/';
$dicomFiles = is_dir($seriesFolder)
    ? glob($seriesFolder . '*.dcm')
    : [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen font-sans">
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white p-6 rounded-2xl shadow-lg mb-6">
        <h2 class="text-2xl font-bold text-blue-900 mb-4">Détails du Patient</h2>
        <div class="space-y-2">
            <p><span class="font-semibold text-blue-800">ID:</span> <?= $patient['id'] ?></p>
            <p><span class="font-semibold text-blue-800">Nom:</span> <?= htmlspecialchars($patient['name']) ?></p>
            <p><span class="font-semibold text-blue-800">Date de Naissance:</span> <?= $patient['dob'] ?></p>
            <p><span class="font-semibold text-blue-800">Sexe:</span> <?= $patient['sex'] ?></p>
            <?php if (!empty($patient['phone'])): ?>
                <p><span class="font-semibold text-blue-800">Téléphone:</span> <?= $patient['phone'] ?></p>
            <?php endif; ?>
            <?php if (!empty($patient['address'])): ?>
                <p><span class="font-semibold text-blue-800">Adresse:</span> <?= htmlspecialchars($patient['address']) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg mb-6">
        <h3 class="text-xl font-semibold text-blue-900 mb-4">Historique Médical</h3>
        <?php if (empty($history)): ?>
            <p class="text-gray-600">Aucun historique médical trouvé.</p>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($history as $visit): ?>
                    <div class="p-4 bg-blue-100 rounded-lg">
                        <p><strong>Date:</strong> <?= $visit['visit_date'] ?></p>
                        <p><strong>Diagnostic:</strong> <?= htmlspecialchars($visit['diagnosis']) ?></p>
                        <p><strong>Traitement:</strong> <?= htmlspecialchars($visit['treatment']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg mb-6">
        <h3 class="text-xl font-semibold text-blue-900 mb-4">Image DICOM</h3>
        <form action="../scripts/launch_dicom.php" method="post">
            <input type="hidden" name="dicomFile" value="dicom_images/series-00000/image-00000.dcm">
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
                ▶️ Ouvrir l'image DICOM
            </button>
        </form>
    </div>

    <a href="list_patients.php" class="inline-block text-blue-700 hover:underline">⬅️ Retour à la liste</a>
</div>
</body>
</html>





