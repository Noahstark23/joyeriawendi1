<?php
return [
  'google' => [
    'clientId'     => $_ENV['GOOGLE_CLIENT_ID'] ?? '',
    'clientSecret' => $_ENV['GOOGLE_CLIENT_SECRET'] ?? '',
    'redirectUri'  => $_ENV['GOOGLE_REDIRECT_URI'] ?? '',
  ],
];
