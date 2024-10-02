<?php
namespace App\Enum;

enum MediaTypeEnum: string {
    case VALID = 'valid';
    case PENDING = 'pending';
    case REJECTED = 'rejected';
}
?>
