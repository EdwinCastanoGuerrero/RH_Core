<p>Bemvindo ao nosso sistema {{ env('APP_NAME') }}!</p>
<p>Seu cadastro foi realizado com sucesso. Para acessar sua conta, por favor, clique no botão abaixo para confirmar seu e-mail:</p>
<p><a href="{{ $url }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Confirmar E-mail</a></p>
<p>Se você não solicitou este cadastro, por favor, ignore este e-mail.</p>
<p>Atenciosamente,<br>{{ env('APP_NAME') }}</p>