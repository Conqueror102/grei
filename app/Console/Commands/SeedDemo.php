<?php
namespace App\Console\Commands;
use Database\Seeders\DemoContentSeeder;
use Illuminate\Console\Command;
class SeedDemo extends Command {
    protected $signature='grei:demo {--force : Allow explicit demo seeding outside local/testing}';
    protected $description='Add clearly labelled illustrative GREI listings and design studies';
    public function handle():int{if(!app()->environment(['local','testing'])&&!$this->option('force')){$this->error('Demo seeding is limited to local/testing environments unless --force is explicitly provided.');return self::FAILURE;}(new DemoContentSeeder())->run();$this->info('Concept collection added. GREI_SHOW_DEMO controls public visibility.');return self::SUCCESS;}
}
