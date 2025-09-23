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
            return;
        } else {

            $stub = <<<EOT
<?php

namespace App\Repositories\\{$name};

use App\Repositories\\{$name}\\{$name}RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Models\\{$name};

class {$name}Repository implements {$name}RepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function query(): Builder{
        return {$name}::query();
    }

    public function get(array \$columns = ["*"], int \$perPage = 15): object
    {
        return \$this->query()->select(\$columns)->paginate(\$perPage);
    }

    public function all() : object
    {
        return \$this->query()->all();
    }

    public function list() : object
    {
        return \$this->query()->get();
    }

    public function find(int \$id) : object
    {
        return \$this->query()->findOrFail(\$id);
    }

    public function view(int \$id) : object
    {
        \$instance = \$this->find(\$id);
        return \$instance;
    }

    public function create(array \$data) : object
    {
        return {$name}::create(\$data);
    }

    public function update(int \$id, array \$data) : object
    {
        \$instance = \$this->find(\$id);
        \$instance->update(\$data);
        return \$instance;
    }

    public function exists(int | array \$id): bool
    {
        if(is_array(\$id)){
            return \$this->query()->where(\$id)->exists();
        }

        return \$this->query()->where("id", \$id)->exists();
    }

    public function delete(int \$id): bool
    {
        \$instance = \$this->find(\$id);
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
            return;
        } else {

            $stub = <<<EOT
<?php

namespace App\Repositories\\{$name};

use Illuminate\Database\Eloquent\Builder;

interface {$name}RepositoryInterface
{
    public function query(): Builder;
    public function get(array \$columns = ["*"], int \$perPage = 15): object;
    public function all(): object;
    public function list(): object;
    public function find(int \$id): object;
    public function view(int \$id): object;
    public function create(array \$data): object;
    public function update(int \$id, array \$data): object;
    public function exists(int \$id): bool;
    public function delete(int \$id): bool;
}
EOT;

            file_put_contents($interfacePath, $stub);

            $this->info("Repository Interface created successfully: {$name}RepositoryInterface");
        }


        $this->addBindingToServiceProvider(
            "\\App\\Repositories\\{$name}\\{$name}RepositoryInterface",
            "\\App\\Repositories\\{$name}\\{$name}Repository"
        );
    }


    protected function addBindingToServiceProvider($interface, $implementation)
    {
        $providerPath = app_path('Providers/DependencyServiceProvider.php');
        $content = file_get_contents($providerPath);

        $pattern = '/\$repositories = \[([\s\S]*?)\];/';
        preg_match($pattern, $content, $matches);

        if (isset($matches[1])) {
            $existingBindings = $matches[1];

            $newBinding = "";

            if (strlen($existingBindings) == 0) {
                $newBinding .= "\n            ";
            } else {
                $newBinding .= "    ";
            }

            $newBinding .= "{$interface}::class => {$implementation}::class,";

            $updatedBindings = $existingBindings . $newBinding;

            $updatedContent = str_replace(
                $matches[0],
                '$repositories = [' . $updatedBindings . "\n        ];",
                $content
            );

            file_put_contents($providerPath, $updatedContent);
        }
    }
}
