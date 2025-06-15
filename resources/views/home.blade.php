<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenue sur notre application</h1>
        <p>{{ $message }}</p>
        <p>Nombre total d'utilisateurs : {{ $totalUsers }}</p>
        <a href="/users" class="btn btn-primary">Voir les utilisateurs</a>
    </div>
</body>
</html>
