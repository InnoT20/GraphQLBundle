<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\Config\Processor;

use Overblog\GraphQLBundle\Config\Processor\PhpEnumProcessor;
use Overblog\GraphQLBundle\Tests\Config\Parser\fixtures\annotations\Enum\ProtocolEnum;
use PHPUnit\Framework\TestCase;

class PhpEnumProcessorTest extends TestCase
{
    private array $fixtures = [
        'baz' => ['type' => 'object', 'config' => []],
        'totoro' => ['type' => 'interface', 'config' => []],
        'enumWithEmptyPhpEnum' => ['type' => 'enum', 'config' => ['phpEnum' => null]],
        'enumWithNotEmptyPhpEnum' => ['type' => 'enum', 'config' => ['phpEnum' => ProtocolEnum::class]],
    ];

    public function testProcess(): void
    {
        $configs = PhpEnumProcessor::process($this->fixtures);

        $this->assertEquals('object', $configs['baz']['type']);
        $this->assertEquals('interface', $configs['totoro']['type']);
        $this->assertEquals('enum', $configs['enumWithEmptyPhpEnum']['type']);
        $this->assertEquals('php-enum', $configs['enumWithNotEmptyPhpEnum']['type']);
    }
}
