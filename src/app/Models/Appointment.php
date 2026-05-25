<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Appointment extends Model
{
    protected string $table = 'appointments';

    public function withRelations(): array
    {
        $sql = "SELECT a.*, p.name AS patient_name, d.name AS dentist_name, s.name AS service_name
                FROM appointments a
                LEFT JOIN patients p ON p.id = a.patient_id
                LEFT JOIN dentists d ON d.id = a.dentist_id
                LEFT JOIN services s ON s.id = a.service_id
                ORDER BY a.scheduled_at DESC";
        return $this->db()->query($sql)->fetchAll() ?: [];
    }
}
