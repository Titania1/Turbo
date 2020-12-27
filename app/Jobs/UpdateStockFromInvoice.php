<?php

declare(strict_types=1);

namespace App\Jobs;

use App\{InvoicePart, Stock};
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};
class UpdateStockFromInvoice implements ShouldQueue
{
	use Dispatchable;
	use InteractsWithQueue;
	use Queueable;
	use SerializesModels;

	public int $invoice_id;
	public int $user_id;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(int $invoiceId, int $userId)
	{
		$this->user_id = $userId;
		$this->invoice_id = $invoiceId;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		// loop through the parts in the invoice
		// get their quantity and update the stock accordingly
		$parts = InvoicePart::where('invoice_id', $this->invoice_id)->get();
		foreach ($parts as $part) {
			$stock = Stock::firstOrCreate([
				'user_id' => $this->user_id,
				'part_id' => $part->part_id,
			], ['quantity' => 0]);
			$stock->quantity += $part->quantity;
			$stock->save();
		}
	}
}
