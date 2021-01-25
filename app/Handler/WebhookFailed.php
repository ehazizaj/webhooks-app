<?php
namespace Spatie\WebhookClient\Exceptions;

namespace App\Handler;
use Exception;

class WebhookFailed extends Exception
{
    public static function invalidToken(): WebhookFailed
    {
        return new static('The token provided is not correct');
    }

    public static function signingSecretNotSet(): WebhookFailed
    {
        return new static('The webhook signing secret is not set. Make sure that the `signing_secret` config key is set to the correct value.');
    }
}
