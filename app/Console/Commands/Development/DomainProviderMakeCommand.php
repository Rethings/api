<?php
/**
 * This source file is proprietary and part of Rethings.
 *
 * (c) Rethings Inc.
 *
 * @see https://www.rethings.io
 */

declare(strict_types=1);

namespace Rethings\Console\Commands\Development;

use Illuminate\Console\GeneratorCommand;
use Rethings\Console\Commands\ResolvesStubPath;

class DomainProviderMakeCommand extends GeneratorCommand
{
    use ResolvesStubPath;

    protected $name = 'make:domain-provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service provider class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Domain Provider';

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/domain-provider.stub');
    }
}
