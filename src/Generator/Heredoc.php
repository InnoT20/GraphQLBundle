<?php
declare(strict_types=1);

namespace Overblog\GraphQLBundle\Generator;

use Murtukov\PHPCodeGenerator\AbstractGenerator;

class Heredoc extends AbstractGenerator
{
    public function __construct(private string $text)
    {
    }

    public function generate(): string
    {
        return "<<<TEXT
$this->text
TEXT";
    }
}
