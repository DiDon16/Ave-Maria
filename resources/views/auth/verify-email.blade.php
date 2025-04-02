<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container text-center">
        <h2>Vérification de votre adresse e-mail</h2>
        <p>Un lien de vérification a été envoyé à votre adresse e-mail.</p>
        <p>Veuillez vérifier votre boîte de réception et cliquer sur le lien pour activer votre compte.</p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success" role="alert">
                Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
            </div>
        @endif

        <!-- Formulaire pour renvoyer l'email de vérification -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button id="resendButton" type="submit" class="btn btn-primary" disabled>Resend verification email</button>
            <p id="countdownText" class="mt-2 text-danger"></p>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const resendButton = document.getElementById('resendButton');
            const countdownText = document.getElementById('countdownText');

            // Vérifier si un délai d'attente existe
            let lastRequestTime = localStorage.getItem('lastVerificationRequestTime');
            if (lastRequestTime) {
                let elapsedTime = (Date.now() - lastRequestTime) / 1000;
                if (elapsedTime < 30) {
                    disableButton(30 - elapsedTime);
                } else {
                    enableButton();
                }
            } else {
                enableButton();
            }

            resendButton.addEventListener('click', function (event) {
                // Stocker le temps actuel
                localStorage.setItem('lastVerificationRequestTime', Date.now());
                disableButton(30);
            });

            function disableButton(remainingTime) {
                resendButton.disabled = true;
                countdownText.innerText = `Please wait for ${Math.ceil(remainingTime)} secondes...`;

                let countdown = setInterval(() => {
                    remainingTime--;
                    countdownText.innerText = `Please wait for ${Math.ceil(remainingTime)} secondes...`;

                    if (remainingTime <= 0) {
                        clearInterval(countdown);
                        enableButton();
                    }
                }, 1000);
            }

            function enableButton() {
                resendButton.disabled = false;
                countdownText.innerText = '';
            }
        });
    </script>
</body>
</html>
