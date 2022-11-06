<?php

return [
    'errors' => [
        'invalid_login_credentials' => 'ログイン出来ませんでした。',
        'unauthenticated' => '認証されていない',
        'limited_send_reset' => 'パスワード再設定メールの送信回数が上限に達しました。:liveTime分後にもう一度お試しください',
        'not_found' => 'データが存在しません',
        'unexpected' => '予期しないエラーが発生しました。'. PHP_EOL . 'お手数ですが再度お試しください。'. PHP_EOL . 'また、解消しない場合は本サービスの「お問い合わせ」からご連絡くださいませ。',
        'unable_register_with_line' => 'このLINEアカウントでの登録情報はありません。他のログイン方法をお試しください。',
        'unable_register_with_line_exists' => 'このLINEアカウントは既に登録されています。',
        'unable_login_with_line' => 'このLINEアカウントでの登録情報はありません。他のログイン方法をお試しください。',
        'unable_login_with_line_sns' => 'このメールアドレスはSNSアカウントで登録されています。該当のログイン方法をお試しください。',
        'line_already_exist' => 'このアカウントはすでにLINEアカウントと連携されています。登録の覚えがない場合、マイページ内お問い合わせよりその旨をご連絡ください。',
        'unfriended_user' => 'unfriended_user',
        'payment_fail' => '決済処理にエラーが発生しました。登録したクレジットカードが正しいかご確認ください',
        'check_payment_fail' => '決済に失敗しました。利用可能なクレジットカードを入力し直してください。',
        'save_card_fail' => '入力されたクレジットカードはお取り扱いできません',
        'payment_card_fail' => 'カード情報をご確認の上、再度登録してください。' . PHP_EOL . 'プリペイドカードやデビットカードをご利用の場合は残高が不足している可能性がございます。',
        'card_not_exist' => 'この患者はクレジットカードが登録されていません ',
        'address_master_error' => '住所が見つかりませんでした',
        'address_master_invalid' => '郵便番号は３桁または７桁入力してください。',
        'last_account_can_not_delete' => '削除できません。',
        'not_found_image' => '画像は存在しないためコピーできませんでした。'
    ],
    'passwords' => [
        'sent' => '登録しているメールアドレスへパスワード再設定リンクが送信されました',
        'reset' => 'パスワードの再設定が完了しました',
        'token' => 'パスワード再設定トークンの期限が切れました',
        'not_same_old_password' => '以前登録したパスワードは再び利用できません',
        'user' => 'ユーザー情報が見つかりません',
        'incorrect_current_password' => '旧パスワードが正しくありません',
    ],
    'emails' => [
        'subject_reset_password_admin' => '【apptosell】パスワードの再設定',
        'subject_reset_password_factory' => '【大和ライフネクスト】パスワードの再設定',
        'subject_email_after_create_admin' => '【apptosell】メールアドレス認証手続きを完了してください',
        'subject_email_after_create_factory' => '【大和ライフネクスト】クリーニングサービスへのログイン情報のお知らせ'
    ],
    'notifications' => [
    ]
];
