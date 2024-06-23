<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class ExistsInDatabaseException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'the value does not exist in the database.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'The value exists in the database.',
        ],
    ];
}