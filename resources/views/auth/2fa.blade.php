<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vérification 2FA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="card text-center">
    <h4 class="mb-3">🔐 Vérification 2FA</h4>
    <p>Veuillez entrer le code reçu par email.</p>

    <form id="2fa-form" method="POST", action="{{route('2fa.verify')}}">
        @csrf
        <div class="mb-3">
            <input type="text" name="code" class="form-control text-center" id="2fa-code" placeholder="Entrez le code" maxlength="5" required>
            @error('code')
                {{$message}}
            @enderror
        </div>
        <button type="submit" class="btn btn-dark w-100">Vérifier</button>
    </form>

    <form id="resend-form" method="POST" action="{{ route('2fa.resend') }}" class="mt-3">
        @csrf
        <button id="resend-btn" class="btn btn-outline-secondary w-100" disabled>Renvoyer le code (2:00)</button>
    </form>
</div>

<script>
    let resendButton = document.getElementById("resend-btn");
    let countdown = 120; // 2 minutes

    function updateTimer() {
        if (countdown > 0) {
            resendButton.innerText = `Renvoyer le code (${Math.floor(countdown / 60)}:${String(countdown % 60).padStart(2, '0')})`;
            countdown--;
            setTimeout(updateTimer, 1000);
        } else {
            resendButton.innerText = "Renvoyer le code";
            resendButton.disabled = false;
        }
    }

    updateTimer(); // Lancer le compte à rebours

    resendButton.addEventListener("click", function() {
        resendButton.disabled = true;
        countdown = 120;
        updateTimer();
        alert("Un nouveau code a été envoyé à votre email.");

        // Soumettre le formulaire
        document.getElementById("resend-form").submit();
    });

    // document.getElementById("2fa-form").addEventListener("submit", function(event) {
    //     event.preventDefault();
    //     let code = document.getElementById("2fa-code").value;
    //     if (code.length === 5) {
    //         alert("Vérification en cours...");
    //         // Ici, tu peux faire un appel AJAX pour vérifier le code
    //     } else {
    //         alert("Veuillez entrer un code valide à 5 chiffres.");
    //     }
    // });
</script>

</body>
</html>
