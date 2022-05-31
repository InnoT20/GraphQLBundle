<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\Config\Parser\fixtures\annotations\Enum;

use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * @GQL\Enum
 * @GQL\EnumValue(name="HTTP")
 * @GQL\EnumValue(name="HTTPS", description="Hypertext Transfer Protocol Secure")
 * @GQL\EnumValue(name="FTP", deprecationReason="Why not? Use sftp")
 * @GQL\EnumValue(name="SFTP", description="SSH File Transfer Protocol")
 * @GQL\Description("The list of protocols")
 */
#[GQL\Enum]
#[GQL\Description('The list of protocols')]
enum ProtocolEnum: string
{
    case HTTP = 'http';
    #[GQL\Description('Hypertext Transfer Protocol Secure')]
    case HTTPS = 'https';
    #[GQL\Deprecated('Why not? Use sftp')]
    case FTP = 'ftp';
    #[GQL\Description('SSH File Transfer Protocol')]
    case SFTP = 'sftp';
}
