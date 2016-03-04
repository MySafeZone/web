Hi,
{{ $email_sender }} sent you an encrypted message on {{ $bag->created_at->formatLocalized('%d %B %Y %H:%M') }}.

Go here to decrypt it : {{ secure_url('/decrypt/'.$bag->id) }} 


Regards,

Leter.io