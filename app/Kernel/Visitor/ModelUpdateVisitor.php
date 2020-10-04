<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Kernel\Visitor;

use Hyperf\Database\Commands\Ast\ModelUpdateVisitor as Visitor;

class ModelUpdateVisitor extends Visitor
{
    protected function formatDatabaseType(string $type): ?string
    {
        switch ($type) {
            case 'datetime':
                return 'datetime';
            default:
                return parent::formatDatabaseType($type);
        }
    }
}
