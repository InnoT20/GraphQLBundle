<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\Util;

use Overblog\GraphQLBundle\Tests\Config\Parser\fixtures\annotations\Enum\Choice;
use Overblog\GraphQLBundle\Tests\Config\Parser\fixtures\annotations\Enum\ProtocolEnum;
use Overblog\GraphQLBundle\Util\EnumHelper;
use PHPUnit\Framework\TestCase;

final class EnumHelperTest extends TestCase
{
    public function testGetValueBackedEnum(): void
    {
        $value = EnumHelper::getValue(ProtocolEnum::HTTP);

        $this->assertEquals('http', $value);
    }

    public function testGetValueUnitEnum(): void
    {
        $value = EnumHelper::getValue(Choice::YES);

        $this->assertEquals('YES', $value);
    }

    public function testBuildBackedEnum(): void
    {
        $enum = EnumHelper::buildInstance(ProtocolEnum::class, 'https');

        $this->assertEquals(ProtocolEnum::HTTPS, $enum);
    }

    public function testBuildUnitEnum(): void
    {
        $enum = EnumHelper::buildInstance(Choice::class, 'NO');

        $this->assertEquals(Choice::NO, $enum);
    }
}
