<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\Config\Parser\fixtures\annotations\Input;

use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * @GQL\Input
 * @GQL\Description("Planet Input type description")
 * @GQL\Access("isAuthenticated()")
 * @GQL\IsPublic("isAuthenticated()")
 */
class Planet
{
    /**
     * @GQL\Field(type="String!")
     */
    protected $name;

    /**
     * @GQL\Field(type="Int!")
     */
    protected $population;

    /**
     * @GQL\Field(type="Boolean!")
     * @GQL\IsPublic("hasRole('KGB')")
     */
    protected $kgbWatchYou;
}
