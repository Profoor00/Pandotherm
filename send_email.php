<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Email cím, ahova az üzenetet küldeni szeretnéd
    $to = 'kapcsolat@pandotherm.hu'; 
    $subject = 'Új üzenet a kapcsolat űrlapról';
    $body = "Név: $name\nTelefonszám: $phone\nEmail: $email\nÜzenet:\n$message";
    $headers = "From: $email";

    // Email küldése
    if (mail($to, $subject, $body, $headers)) {
        echo "<h3>Üzenet elküldve</h3>";
        echo '<a href="index.html">Vissza a Főoldalra</a>';
    } else {
        echo "<h3>Hiba történt az üzenet küldésekor. Kérjük, próbálja újra.</h3>";
    }
}
?>