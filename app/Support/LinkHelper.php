<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Support;

final class LinkHelper
{
    public static function link(string $rel, string $href, array $metadata = []): array
    {
        $data = compact('rel', 'href');
        if (!empty($metadata)) {
            $data['metadata'] = $metadata;
        }

        return $data;
    }

    public static function selfLink(string $href, array $metadata = []): array
    {
        return static::link('self', $href, $metadata);
    }
}
