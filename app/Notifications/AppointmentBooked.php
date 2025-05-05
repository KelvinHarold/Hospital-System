<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Appointment;

class AppointmentBooked extends Notification
{
    

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database']; // Or use ['mail', 'database'] if email is needed
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'New appointment booked by ' . $this->appointment->patient_name,
            'appointment_id' => $this->appointment->id,
            'appointment_date' => $this->appointment->appointment_date,
        ];
    }
}
