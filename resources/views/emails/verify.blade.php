<p>Bonjour {{ $user->name }},</p>
<p>Cliquez sur le lien ci-dessous pour vérifier votre email :</p>
<a href="{{ url('/email/verify/'.$user->id.'/'.sha1($user->email)) }}">Vérifier mon email</a>
<p>Merci.</p>
