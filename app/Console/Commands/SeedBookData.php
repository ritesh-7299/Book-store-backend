<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SeedBookData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Seed:BookData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to fill the data in books table via external api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->ask('How many records do you want to seed?');
        Book::factory()->count($count)->create();

        $this->info($count.' records has been seeded to books table!');
    }
}
