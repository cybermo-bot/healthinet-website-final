<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

if (!isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}

$patients = $pdo->query("SELECT * FROM patient ORDER BY name")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Patients</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen p-8">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md p-6">
        <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Liste des Patients</h1>
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-blue-100 text-blue-800">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nom</th>
                    <th class="px-4 py-2 border">Date de Naissance</th>
                    <th class="px-4 py-2 border">Sexe</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                <tr class="hover:bg-blue-50">
                    <td class="px-4 py-2 border"><?= $patient['id'] ?></td>
                    <td class="px-4 py-2 border"><?= htmlspecialchars($patient['name']) ?></td>
                    <td class="px-4 py-2 border"><?= $patient['dob'] ?></td>
                    <td class="px-4 py-2 border"><?= $patient['sex'] ?></td>
                    <td class="px-4 py-2 border text-center">
                        <a href="patient_details.php?id=<?= $patient['id'] ?>" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Voir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-6 text-center">
            <a href="dashboard.php" class="text-blue-600 hover:underline">⬅️ Retour au tableau de bord</a>
        </div>
    </div>
</body>
</html>
