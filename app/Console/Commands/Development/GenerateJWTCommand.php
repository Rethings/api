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
use Illuminate\Filesystem\Filesystem;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RS256;
use RuntimeException;

class GenerateJWTCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:jwt
    {sub : JWT Subject}
    {--jti= : JWT Token ID}
    {--exp= : JWT Token Expiration}
    {--key=test_key : Private key under ./keys directory}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a JWT for testing purposes.';

    private Filesystem $filesystem;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->laravel->environment('production')) {
            throw new RuntimeException('This command is not allowed in production.');
        }

        $keyName = $this->option('key');
        if (!$this->filesystem->exists($this->laravel->basePath("keys/$keyName.pem"))) {
            throw new RuntimeException("Key does not exists: $keyName.pem");
        }
        $privateKey = $this->filesystem->get(
            $this->laravel->basePath("keys/$keyName.pem")
        );
        $jwt = $this->build(new Builder())
            ->getToken(
                new RS256(),
                new Key($privateKey)
            );
        $this->info($jwt);
    }

    private function build(Builder $builder): Builder
    {
        $builder->relatedTo($this->argument('sub'))
            ->issuedAt(time());
        if ($this->option('jti')) {
            $builder->identifiedBy($this->option('jti'));
        }
        if ($this->option('exp')) {
            $builder->expiresAt($this->option('exp'));
        }

        return $builder;
    }
}
