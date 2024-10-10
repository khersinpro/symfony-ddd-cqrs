<?php

namespace App\User\Application\Command\ChangePassword;

use App\Shared\Application\Command\CommandInterface;

class ChangePasswordCommand implements CommandInterface
{
    public function __construct(public string $newPassword) { }
}