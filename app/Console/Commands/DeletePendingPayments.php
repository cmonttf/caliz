<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pago;
use Carbon\Carbon;

class DeletePendingPayments extends Command
{
    protected $signature = 'payments:delete';
    protected $description = 'Delete pending payments older than 180 seconds';

    public function handle()
    {
        $threeMinutesAgo = Carbon::now()->subSeconds(180);

        Pago::where('status', 1)
            ->where('created_at', '<=', $threeMinutesAgo)
            ->delete();

        $this->info('Pending payments older than 180 seconds have been deleted.');

    }
}

