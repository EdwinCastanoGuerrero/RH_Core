<p>Bemvindo ao nosso sistema {{ env('APP_NAME') }}!</p>
<p>Seu cadastro foi realizado com sucesso. Para acessar sua conta, por favor, clique no botão abaixo para criar sua senha e confirmar seu e-mail:</p>
<p><a href="{{ $url }}" >Criar Senha e Confirmar E-mail</a></p>
<p>Se você não solicitou este cadastro, por favor, ignore este e-mail.</p>
<p>Atenciosamente,<br>{{ env('APP_NAME') }}</p>