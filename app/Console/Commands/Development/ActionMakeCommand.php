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
use Illuminate\Support\Str;
use Rethings\Console\Commands\ResolvesStubPath;

class ActionMakeCommand extends GeneratorCommand
{
    use ResolvesStubPath;

    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'make:action';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an Action class';

    /**
     * The resource to be created.
     *
     * @var string
     */
    protected $type = 'Action';

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        $name = $this->qualifyClass($this->getNameInput());
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
        if (Str::startsWith($class, ['Create', 'Add', 'Post', 'Store', 'Upsert', 'Log', 'Register'])) {
            return $this->resolveStubPath('/stubs/action.create.stub');
        }
        if (Str::startsWith($class, ['Update', 'Patch', 'Edit'])) {
            return $this->resolveStubPath('/stubs/action.update.stub');
        }
        if (Str::startsWith($class, ['Delete', 'Remove', 'Deactivate'])) {
            return $this->resolveStubPath('/stubs/action.delete.stub');
        }

        return $this->resolveStubPath('/stubs/action.stub');
    }
}
