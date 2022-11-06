<p>
{{ $notifiable->email}} 様
</p>

<p>
Maruaraiでの新規アカウントの登録がありますのでお知らせいたします。
</p>

<p>
本メールはご登録いただいたメールアドレスが正しいかどうか確認するための認証用メールです。
</p>

<p>
メール認証を完了するために下記のURLから本登録を完了してください。
</p>

<p>
<a href={{ $url }}> {{ $url }} </a><br>
</p>

<p>
※上記URLの有効期限は1週間({{ $expiredAt }}まで）有効です。それ以降はURLが無効となりますので早めにご対応をお願いします。<br>
※本メールに心当たりのない方は、誠に恐れ入りますがこのメールを削除してください。
</p>

<p>
******<br>
このメールはMaruaraiを利用されたお客様に自動的にお送りしております。<br>
送信専用のメールアドレスのため、返信はお受けできません。<br>
******
</p>
