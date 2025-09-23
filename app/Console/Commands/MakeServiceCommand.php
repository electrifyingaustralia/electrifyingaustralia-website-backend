<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class and interface';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $servicePath = app_path("Services/{$name}/{$name}Service.php");
        $interfacePath = app_path("Services/{$name}/{$name}ServiceInterface.php");

        if (!is_dir(app_path("Services/{$name}"))) {
            mkdir(app_path("Services/{$name}"), 0755, true);
        }

        /**
         * =====================
         * Service File Create
         * =====================
         */
        if (file_exists($servicePath)) {
            $this->error("Service already exists!");
        } else {
            $stub = <<<EOT
<?php

namespace App\Services\\{$name};

use App\Services\\{$name}\\{$name}ServiceInterface;

class {$name}Service implements {$name}ServiceInterface
{
    public function __construct()
    {
        //
    }
}
EOT;
            file_put_contents($servicePath, $stub);
            $this->info("Service created successfully: {$name}Service");
        }

        /**
         * =====================
         * Service Interface Create
         * =====================
         */
        if (file_exists($interfacePath)) {
            $this->error("Service Interface already exists!");
        } else {
            $stub = <<<EOT
<?php

namespace App\Services\\{$name};

interface {$name}ServiceInterface
{
}
EOT;
            file_put_contents($interfacePath, $stub);
            $this->info("Service Interface created successfully: {$name}ServiceInterface");
        }
        $this->addBindingToServiceProvider(
            "\\App\\Services\\{$name}\\{$name}ServiceInterface",
            "\\App\\Services\\{$name}\\{$name}Service"
        );
    }

    protected function addBindingToServiceProvider($interface, $implementation)
    {
        $providerPath = app_path('Providers/DependencyServiceProvider.php');
        $content = file_get_contents($providerPath);

        $pattern = '/\$services = \[([\s\S]*?)\];/';
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
                '$services = [' . $updatedBindings . "\n        ];",
                $content
            );

            file_put_contents($providerPath, $updatedContent);
        }
    }
}
