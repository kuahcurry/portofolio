<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('portfolio:sync-linkedin', function () {
    $this->info('🔄 Syncing portfolio data with authentic LinkedIn profile for Aqief Hakimi...');
    $this->call(\Database\Seeders\PortfolioSeeder::class, ['--force' => true]);
    $this->info('✅ Successfully synchronized: Bio/Profile, Education, 5 Authentic Experiences, and Skills.');
    $this->info('✨ Any custom projects remain untouched!');
})->purpose('Sync authentic LinkedIn experiences, bio, education, and skills into the database');
