<?php

namespace Domain\Shared\Enums;

enum ErrorCode: string
{
    const BAD_REQUEST = 'bad_request';
    const UNAUTHORIZED = 'unauthorized';
    const FORBIDDEN = 'forbidden';
    const NOT_FOUND = 'not_found';
    const METHOD_NOT_ALLOWED = 'method_not_allowed';
    const CONFLICT = 'conflict';
    const VALIDATION_ERROR = 'validation_error';
    const SERVER_ERROR = 'server_error';
    const DATABASE_ERROR = 'database_error';
}
