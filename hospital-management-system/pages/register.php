<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';

if (!isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Enregistrement Patient</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f0f0;
            padding: 30px;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background: #218838;
        }
        .required:after {
            content: " *";
            color: red;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Enregistrement Nouveau Patient</h2>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // Get form data
                $name = htmlspecialchars($_POST['name']);
                $dob = $_POST['dob'];
                $sex = htmlspecialchars($_POST['sex']);
                $phone = htmlspecialchars($_POST['phone'] ?? '');
                $address = htmlspecialchars($_POST['address'] ?? '');
                
                // Insert patient
                $stmt = $pdo->prepare("INSERT INTO patient (name, dob, sex, phone, address) 
                                      VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$name, $dob, $sex, $phone, $address]);
                
                $patient_id = $pdo->lastInsertId();
                
                // Insert medical data if provided
                if (!empty($_POST['allergies'])) {
                    $stmt = $pdo->prepare("INSERT INTO allergies (patient_id, allergen, reaction) 
                                          VALUES (?, ?, ?)");
                    $stmt->execute([$patient_id, $_POST['allergies'], $_POST['reaction'] ?? '']);
                }
                
                echo '<div style="color:green; text-align:center;">Patient enregistré avec succès! ID: '.$patient_id.'</div>';
            } catch (PDOException $e) {
                echo '<div style="color:red; text-align:center;">Erreur: '.$e->getMessage().'</div>';
            }
        }
        ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label class="required">Nom complet:</label>
                <input type="text" name="name" required>
            </div>
            
            <div class="form-group">
                <label class="required">Date de naissance:</label>
                <input type="date" name="dob" required>
            </div>
            
            <div class="form-group">
                <label class="required">Sexe:</label>
                <select name="sex" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Téléphone:</label>
                <input type="tel" name="phone">
            </div>
            
            <div class="form-group">
                <label>Adresse:</label>
                <textarea name="address" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label>Allergies connues:</label>
                <input type="text" name="allergies" placeholder="Ex: Penicilline">
            </div>
            
            <div class="form-group">
                <label>Réaction aux allergies:</label>
                <input type="text" name="reaction" placeholder="Ex: Urticaire">
            </div>
            
            <button type="submit">Enregistrer</button>
            <a href="dashboard.php" style="float:right; margin-top:20px;">Retour au menu</a>
        </form>
    </div>
</body>
</html>