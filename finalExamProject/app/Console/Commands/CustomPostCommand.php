<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomPostCommand extends Command
{
    protected $signature = 'custom:post';
    protected $description = 'Custom post command';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Custom Post Command Executed');
    }
}
