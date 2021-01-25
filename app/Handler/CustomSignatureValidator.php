<?php

namespace App\Handler;

use Illuminate\Http\Request;

use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;
use App\Handler\WebhookFailed as failed;
class CustomSignatureValidator implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $token = $request['token'];
        if (!$token) {
            throw failed::invalidToken();
        }
        $signingSecret = $config->signingSecret;
        if (empty($signingSecret)) {
            throw failed::signingSecretNotSet();
        }
        if ($token !== $signingSecret) {
            throw failed::invalidToken();
        } else {
            return true;

        }

    }
}
