<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Config;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use function array_key_exists;
use function is_string;

class InputObjectTypeDefinition extends TypeDefinition
{
    public function getDefinition(): ArrayNodeDefinition
    {
        /** @var ArrayNodeDefinition $node */
        $node = self::createNode('_input_object_config');

        /** @phpstan-ignore-next-line */
        $node
            ->children()
                ->append($this->nameSection())
                ->append($this->validationSection(self::VALIDATION_LEVEL_CLASS))
                ->variableNode('fieldsDefaultAccess')
                    ->info('Default access control to fields (expression language can be use here)')
                ->end()
                ->variableNode('fieldsDefaultPublic')
                    ->info('Default public control to fields (expression language can be use here)')
                ->end()
                ->arrayNode('fields')
                    ->useAttributeAsKey('name', false)
                    ->prototype('array')
                        // Allow field type short syntax (Field: Type => Field: {type: Type})
                        ->beforeNormalization()
                            ->ifTrue(fn ($options) => is_string($options))
                            ->then(fn ($options) => ['type' => $options])
                        ->end()
                        ->append($this->typeSection(true))
                        ->append($this->descriptionSection())
                        ->append($this->defaultValueSection())
                        ->append($this->accessSection())
                        ->append($this->publicSection())
                        ->append($this->validationSection(self::VALIDATION_LEVEL_PROPERTY))
                    ->end()
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                ->end()
                ->append($this->descriptionSection())
            ->end();

        $this->treatFieldsDefaultAccess($node);
        $this->treatFieldsDefaultPublic($node);

        return $node;
    }

    protected function accessSection(): NodeDefinition
    {
        return self::createNode('access', 'scalar')->info('Access control to field (expression language can be used here)');
    }

    protected function publicSection(): NodeDefinition
    {
        return self::createNode('public', 'scalar')->info('Visibility control to field (expression language can be used here)');
    }

    /**
     * set empty fields.access with fieldsDefaultAccess values if is set?
     */
    private function treatFieldsDefaultAccess(ArrayNodeDefinition $node): void
    {
        $node->validate()
            ->ifTrue(fn ($v) => array_key_exists('fieldsDefaultAccess', $v) && null !== $v['fieldsDefaultAccess'])
            ->then(function ($v) {
                foreach ($v['fields'] as &$field) {
                    if (array_key_exists('access', $field) && null !== $field['access']) {
                        continue;
                    }

                    $field['access'] = $v['fieldsDefaultAccess'];
                }

                return $v;
            })
            ->end();
    }

    /**
     * set empty fields.public with fieldsDefaultPublic values if is set?
     */
    private function treatFieldsDefaultPublic(ArrayNodeDefinition $node): void
    {
        $node->validate()
            ->ifTrue(fn ($v) => array_key_exists('fieldsDefaultPublic', $v) && null !== $v['fieldsDefaultPublic'])
            ->then(function ($v) {
                foreach ($v['fields'] as &$field) {
                    if (array_key_exists('public', $field) && null !== $field['public']) {
                        continue;
                    }
                    $field['public'] = $v['fieldsDefaultPublic'];
                }

                return $v;
            })
            ->end();
    }
}
