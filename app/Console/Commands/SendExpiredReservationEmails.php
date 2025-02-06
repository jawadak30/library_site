<?php

namespace App\Console\Commands;

use App\Mail\ReservationExpired;
use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendExpiredReservationEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-expired-reservation-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send reservation expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all reservations where fin_dateReservation is today and not cancelled
        $expiredReservations = Reservation::where('fin_dateReservation', now()->toDateString())
                                          ->where('etat', '!=', 'annulée')
                                          ->get();

        // Send email for each expired reservation
        foreach ($expiredReservations as $reservation) {
            Mail::to($reservation->user->email)
                ->send(new ReservationExpired($reservation));  // Send the expiration email

            $this->info('Email sent to: ' . $reservation->user->email);  // Log the email sent
        }

        $this->info('Expired reservation emails sent successfully.');
    }
}
