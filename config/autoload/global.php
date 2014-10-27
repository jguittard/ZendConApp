<?php
return array(
    'db' => array(
        'adapters' => array(
            'DB\\Phonebook' => array(
                'driver' => 'Pdo_Mysql',
                'database' => 'DB_NAME_PLACEHOLDER',
                'username' => 'DB_USERNAME_PLACEHOLDER',
                'password' => 'DB_PASSWORD_PLACEHOLDER',
                'hostname' => 'DB_HOST_PLACEHOLDER',
                'port' => '3306',
            ),
        ),
    ),
);
