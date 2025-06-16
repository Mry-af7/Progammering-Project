namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->subject('Bevestiging afspraak - ' . $this->appointment->company->name)
                    ->markdown('emails.appointments.confirmation')
                    ->with([
                        'appointment' => $this->appointment,
                        'company' => $this->appointment->company,
                        'timeSlot' => $this->appointment->timeSlot,
                    ]);
    }
} 