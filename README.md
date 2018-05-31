Установить

Выполнить миграции или использовать дамп

Внести в config/web.php 

свои данные

'mailer' => [
            'class' => yii\swiftmailer\Mailer::class,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => Swift_SmtpTransport::class,
                'host' => 'smtp.gmail.com',
                'username' => '', // внести свои данные
                'password' => '', // внести свои данные
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],


