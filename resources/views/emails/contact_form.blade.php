<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; color: #333333; background-color: #f5f5f5; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 6px; padding: 30px;">
        <h2 style="color: #6f2da8; border-bottom: 2px solid #6f2da8; padding-bottom: 10px;">
            Nouveau message depuis le site Sofifran
        </h2>

        <p><strong>Nom :</strong> {{ $form['name'] }}</p>
        <p><strong>Email :</strong> {{ $form['email'] }}</p>
        <p><strong>Téléphone :</strong> {{ $form['tel'] ?: 'Non renseigné' }}</p>

        <p style="margin-top: 20px;"><strong>Message :</strong></p>
        <div style="background: #f9f9f9; border-left: 4px solid #6f2da8; padding: 15px; white-space: pre-line;">{{ $form['message'] }}</div>

        <p style="margin-top: 30px; font-size: 12px; color: #999999;">
            Ce message a été envoyé depuis le formulaire de contact de sofifran.org
        </p>
    </div>
</body>
</html>
