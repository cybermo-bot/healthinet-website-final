<?php
// Start session and check authentication FIRST
require_once '../includes/config.php';
require_once '../includes/auth.php';

if (!isLoggedIn()) {
    $_SESSION['redirect_message'] = "Veuillez vous connecter d'abord";
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Système Patients</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-xl animate-fade-in">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="text-right text-gray-500 text-sm mb-4">
                Connecté en tant que: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
            </div>
        <?php endif; ?>

        <h1 class="text-3xl font-bold text-center text-blue-800 mb-6">Menu Principal</h1>

        <div class="grid gap-4">
            <a href="register.php" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out shadow-md">
                <i class="fas fa-user-plus mr-2"></i> Enregistrer un nouveau patient
            </a>
            <a href="liste_patient.php" class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out shadow-md">
                <i class="fas fa-list mr-2"></i> Liste des patients
            </a>
            <a href="../logout.php" class="block text-center bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-lg transition duration-300 ease-in-out shadow-md">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </a>
        </div>
    </div>
</body>
</html>
