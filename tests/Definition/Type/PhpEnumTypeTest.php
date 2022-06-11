<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\Definition\Type;

use Overblog\GraphQLBundle\Definition\Type\PhpEnumType;
use Overblog\GraphQLBundle\Tests\Config\Parser\fixtures\annotations\Enum\ProtocolEnum;
use PHPUnit\Framework\TestCase;

class PhpEnumTypeTest extends TestCase
{
    public function testSerialize(): void
    {
        $enum = ProtocolEnum::HTTPS;

        $type = new PhpEnumType(ProtocolEnum::class, [
            'name' => 'ProtocolEnum',
            'description' => 'The list of protocols',
            'values' => [
                'HTTP' => [
                    'value' => 'http',
                ],
                'HTTPS' => [
                    'description' => 'Hypertext Transfer Protocol Secure',
                    'value' => 'https',
                ],
                'FTP' => [
                    'deprecationReason' => 'Why not? Use sftp',
                    'value' => 'ftp',
                ],
                'SFTP' => [
                    'description' => 'SSH File Transfer Protocol',
                    'value' => 'sftp',
                ],
            ],
        ]);

        $this->assertEquals('HTTPS', $type->serialize($enum));
    }
}
