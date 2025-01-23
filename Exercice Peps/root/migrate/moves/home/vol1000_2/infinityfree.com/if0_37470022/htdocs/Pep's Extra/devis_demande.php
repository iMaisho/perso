<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demander un devis</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Demander un devis gratuit</h1>
        <form id="devis-form">
            <h2> Vos informations </h2>
            <div class="mb-3">
                <label for="lastname" class="form-label">Nom *</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">Prénom *</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Entreprise</label>
                <input type="text" class="form-control" id="company" name="company" aria-describedby="company-help">
                <div id="company-help" class="form-text">Facultatif</div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Numéro de téléphone *</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <h2> Votre projet </h2>
            <div class="mb-3">
                <label for="needs" class="form-label">Votre besoin *</label><br>
                <input type="radio" id="needs-quick" name="needs" value="quick" required>
                <label for="needs-quick">Estimation rapide</label> <br>
                <input type="radio" id="needs-detailled" name="needs" value="detailled">
                <label for="needs-detailled">Devis détaillé</label>
            </div>  
            <div class="mb-3">
            <label for="deadline" class="form-label"> Echéance du projet *</label><br>
                <select name="deadline" id="deadline" required>
                    <option value="quick">Rapidement</option>
                    <option value="month">Dans le mois</option>
                    <option value="trimestre">Dans le trimestre</option>
                    <option value="year">Courant d'année</option>
                    <option value="noIdea" selected="selected">Je ne sais pas</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="budget" class="form-label">Budget *</label>
                <input type="" class="form-control" id="budget" name="budget"  required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description de votre projet *</label>
                <textarea class="form-control" placeholder="N'hésitez pas à nous transmettre toutes les informations nécéssaires à la bonne compréhension de votre projet." id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label" aria-describedby="company-help">Fichier supplémentaire</label>
                <div id="company-help" class="form-text">Types de fichiers acceptés : .pdf, .jpg, .jpeg, .png. Taille maximum 1Mo.</div>
                <input type="file" class="form-control" id="file" name="file" aria-describedby="company-help"/>
                <div id="company-help" class="form-text">Facultatif</div>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <div id="verification-answer"></div>

    <script src="JS/devis_demande_script.js"></script>
    </div>
</body>
</html>
