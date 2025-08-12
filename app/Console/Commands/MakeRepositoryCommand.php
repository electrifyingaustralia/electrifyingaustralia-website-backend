<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create a new repository class';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $repositoryPath = app_path("Repositories/{$name}/{$name}Repository.php");
        $interfacePath = app_path("Repositories/{$name}/{$name}RepositoryInterface.php");

        if (!is_dir(app_path('Repositories'))) {
            mkdir(app_path("Repositories/{$name}"), 0755, true);
        }

        if (!is_dir(app_path("Repositories/{$name}"))) {
            mkdir(app_path("Repositories/{$name}"), 0755, true);
        }

        if (file_exists($repositoryPath)) {
            $this->error("Repository already exists!");
        } else {

            $stub = <<<EOT
<?php

namespace App\Repositories\\{$name};

use App\Repositories\\{$name}\\{$name}RepositoryInterface;

class {$name}Repository implements {$name}RepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function get(array \$filters = [], int \$perPage = 15)
    {
        // TODO: implement get method
    }

    public function all()
    {
        // TODO: implement all method
    }

    public function list()
    {
        // TODO: implement list method
    }

    public function find(int \$id)
    {
        // TODO: implement find method
    }

    public function view(int \$id)
    {
        // TODO: implement view method
    }

    public function create(array \$data)
    {
        // TODO: implement create method
    }

    public function update(int \$id, array \$data)
    {
        // TODO: implement update method
    }

    public function exists(int \$id): bool
    {
        // TODO: implement exists method
        return true;
    }

    public function delete(int \$id): bool
    {
        // TODO: implement delete method
        return true;
    }

}
EOT;

            file_put_contents($repositoryPath, $stub);

            $this->info("Repository created successfully: {$name}Repository");
        }

        // ===================================================================
        // ===================================================================
        // ^======================Repository Interface========================
        // ===================================================================
        // ===================================================================


        if (file_exists($interfacePath)) {
            $this->error("Repository already exists!");
        } else {

            $stub = <<<EOT
<?php

namespace App\Repositories\\{$name};

interface {$name}RepositoryInterface
{
    public function get(array \$filters = [], int \$perPage = 15);
    public function all();
    public function list();
    public function find(int \$id);
    public function view(int \$id);
    public function create(array \$data);
    public function update(int \$id, array \$data);
    public function exists(int \$id): bool;
    public function delete(int \$id): bool;
}
EOT;

            file_put_contents($interfacePath, $stub);

            $this->info("Repository Interface created successfully: {$name}RepositoryInterface");
        }
    }
}
