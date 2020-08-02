<?php

namespace App\Notifications;

use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Coreproc\NovaNotificationFeed\Notifications\NovaBroadcastMessage;

class Arrival extends Notification
{
	use Queueable;

	protected $level = 'info';
	protected $message = '';
	public object $invoice;

	/**
	 * Create a new notification instance.
	 *
	 * @param App\Invoice $invoice
	 *
	 * @return void
	 */
	public function __construct(Invoice $invoice, $level, $message = "test message")
	{
		$this->level = $level;
		$this->message = __('New arrival from') . ' ' . $invoice->user->name . ' ' . __('check it out');
		$this->invoice = $invoice;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['database', 'broadcast'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->line('The introduction to the notification.')
			->action('Notification Action', url('/'))
			->line('Thank you for using our application!');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable): array
	{
		$base_path = config('app.url') . config('nova.path');
		return [
			'level' => $this->level,
			'message' => $this->message,
			'url' => $base_path . '/resources/invoices/' . $this->invoice->id,
			'target' => '_self'
		];
	}

	/**
	 * Get the broadcastable representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return BroadcastMessage
	 */
	public function toBroadcast($notifiable)
	{
		return new NovaBroadcastMessage($this->toArray($notifiable));
	}
}
