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

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Rethings\Console\Commands\ResolvesStubPath;

class ClassMakeCommand extends GeneratorCommand
{
    use ResolvesStubPath;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:class';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a class based on template';

    /**
     * The resource to be created.
     *
     * @var string
     */
    protected $type = 'Class';

    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/class.stub');
    }
}
