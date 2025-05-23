<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a domain service and its interface';

    public function handle()
    {
        $name = $this->argument('name');
        $serviceName = ucfirst($name);
        $contractDir = app_path("Domain/Services/Contracts");
        $serviceDir = app_path("Domain/Services");

        // Ensure directories exist
        File::ensureDirectoryExists($contractDir);
        File::ensureDirectoryExists($serviceDir);

        // File paths
        $contractPath = "$contractDir/{$serviceName}ServiceInterface.php";
        $servicePath = "$serviceDir/{$serviceName}Service.php";

        // Service Contract
        if (!File::exists($contractPath)) {
            File::put($contractPath, $this->buildContract($serviceName));
            $this->info("Created: $contractPath");
        } else {
            $this->warn("Already exists: $contractPath");
        }

        // Service Class
        if (!File::exists($servicePath)) {
            File::put($servicePath, $this->buildService($serviceName));
            $this->info("Created: $servicePath");
        } else {
            $this->warn("Already exists: $servicePath");
        }
    }

    protected function buildContract($serviceName)
    {
        return <<<PHP
<?php

namespace App\Domain\Services\Contracts;

interface {$serviceName}ServiceInterface
{
//    public function getAll(array \$filters = [],  \$search = null);
//    public function paginate(array \$filters = [],  \$search = null, \$perPage = 10);
    public function getAll();
    public function paginate();
    public function create(array \$data);
    public function show(\$id);
    public function update(\$id, array \$data);
    public function delete(\$id);
}
PHP;
    }

    protected function buildService($serviceName)
    {
        $variableName = lcfirst($serviceName); // like 'engineer'

        return <<<PHP
<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\\Contracts\\{$serviceName}RepositoryInterface;
use App\Domain\Services\Contracts\\{$serviceName}ServiceInterface;

class {$serviceName}Service implements {$serviceName}ServiceInterface
{
    protected \${$variableName}Repo;

    public function __construct({$serviceName}RepositoryInterface \${$variableName}Repo)
    {
        \$this->{$variableName}Repo = \${$variableName}Repo;
    }

    public function getAll()
    {
        return \$this->{$variableName}Repo->all();
    }

    public function paginate()
    {
        return \$this->{$variableName}Repo->paginate();
    }

    public function create(array \$data)
    {
        return \$this->{$variableName}Repo->create(\$data);
    }

    public function show(\$id)
    {
        return \$this->{$variableName}Repo->find(\$id);
    }

    public function update(\$id, array \$data)
    {
        return \$this->{$variableName}Repo->update(\$data, \$id);
    }

    public function delete(\$id)
    {
        return \$this->{$variableName}Repo->delete(\$id);
    }
}
PHP;
    }
}
