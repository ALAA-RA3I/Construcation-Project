<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new Repository and its Contract interface';

    public function handle()
    {
        $name = $this->argument('name');
        $repoDir = base_path("app/Infrastructure/Repositories");
        $contractDir = base_path("app/Infrastructure/Repositories/Contracts");

        // Ensure directories exist
        if (!File::exists($repoDir)) File::makeDirectory($repoDir, 0755, true);
        if (!File::exists($contractDir)) File::makeDirectory($contractDir, 0755, true);

        $repositoryClass = "{$name}Repository";
        $interfaceClass = "{$repositoryClass}Interface";

        $modelName = $name;

        // File paths
        $interfacePath = "$contractDir/{$interfaceClass}.php";
        $repositoryPath = "$repoDir/{$repositoryClass}.php";

        // Check existence
        if (File::exists($interfacePath) || File::exists($repositoryPath)) {
            $this->error("Repository or contract already exists!");
            return;
        }

        // Interface content
        $interfaceContent = <<<PHP
<?php

namespace App\Infrastructure\Repositories\Contracts;

interface {$interfaceClass} extends BaseRepositoryInterface
{
    //
}
PHP;

        // Repository content
        $repositoryContent = <<<PHP
<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\\{$interfaceClass};
use App\Models\\{$modelName};

class {$repositoryClass} extends BaseRepository implements {$interfaceClass}
{
    public function model()
    {
        return {$modelName}::class;
    }
}
PHP;

        // Write files
        File::put($interfacePath, $interfaceContent);
        File::put($repositoryPath, $repositoryContent);

        $this->info("Repository and interface created successfully!");
    }
}
