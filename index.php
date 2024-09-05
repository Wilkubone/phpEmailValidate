<?php
require_once 'UserValidator.php';

$emailError = '';
$passwordError = '';
$emailValid = true;
$passwordValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new UserValidator();

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$validator->validateEmail($email)) {
        $emailError = 'Niepoprawny adres e-mail.';
        $emailValid = false;
    }

    if (!$validator->validatePassword($password)) {
        $passwordError = 'Hasło musi mieć co najmniej 8 znaków, zawierać jedną dużą literę, jedną małą literę, cyfrę i znak specjalny.';
        $passwordValid = false;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walidacja e-maila i hasła</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Walidacja e-maila i hasła</h1>

<form method="POST" action="">
    <div class="form-group">
        <label for="email">Adres e-mail:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        <?php if (!$emailValid): ?>
            <div class="error"><?= $emailError ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>
        <?php if (!$passwordValid): ?>
            <div class="error"><?= $passwordError ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Zatwierdź</button>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $emailValid && $passwordValid): ?>
    <div class="success">E-mail i hasło są poprawne!</div>
<?php endif; ?>

</body>
</html>
