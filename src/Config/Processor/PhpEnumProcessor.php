<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Config\Processor;

final class PhpEnumProcessor implements ProcessorInterface
{
    public static function process(array $configs): array
    {
        foreach ($configs as &$config) {
            if ('enum' === $config['type'] && null !== $config['config']['phpEnum']) {
                $config['type'] = 'php-enum';
            }
        }

        return $configs;
    }
}
