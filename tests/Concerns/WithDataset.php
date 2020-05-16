<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Tests\Concerns;

use InvalidArgumentException;

trait WithDataset
{
    protected function setUpWithDataset(): void
    {
        $this->afterApplicationCreated(function (): void {
            if (method_exists($this, 'createDataset')) {
                $dataset = $this->createDataset();
                foreach ($dataset as $model => $data) {
                    $factory = factory($model);
                    foreach ($data as $entry) {
                        try {
                            $factory->create($entry);
                        } catch (InvalidArgumentException $e) {
                            // No factory defined
                            forward_static_call_array([$model, 'forceCreate'], [$entry]);
                        }
                    }
                }
                $this->afterSeed();
            }
        });
    }

    protected function afterSeed(): void
    {
    }
}
