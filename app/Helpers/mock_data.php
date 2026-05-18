<?php
/**
 * Frontend-only mock data store.
 * Replace with real DB queries when backend is re-enabled.
 */

if (!function_exists('mock')) {
    function mock(string $key): array
    {
        static $cache = null;
        if ($cache === null) {
            $cache = [
                'stats' => [
                    'patients'     => 248,
                    'appointments' => 12,
                    'pending'      => 5,
                    'revenue'      => 87450.00,
                ],

                'upcoming' => [
                    ['id' => 1, 'patient_name' => 'Maria Santos',    'dentist_name' => 'Jane Cruz',     'service_name' => 'Dental Cleaning', 'scheduled_at' => date('Y-m-d 09:00:00', strtotime('+1 day')),  'status' => 'confirmed'],
                    ['id' => 2, 'patient_name' => 'Juan Dela Cruz',  'dentist_name' => 'Mark Reyes',    'service_name' => 'Tooth Extraction','scheduled_at' => date('Y-m-d 10:30:00', strtotime('+1 day')),  'status' => 'pending'],
                    ['id' => 3, 'patient_name' => 'Anna Reyes',      'dentist_name' => 'Jane Cruz',     'service_name' => 'Root Canal',      'scheduled_at' => date('Y-m-d 14:00:00', strtotime('+2 days')), 'status' => 'confirmed'],
                    ['id' => 4, 'patient_name' => 'Pedro Garcia',    'dentist_name' => 'Mark Reyes',    'service_name' => 'Braces Adjustment','scheduled_at'=> date('Y-m-d 15:30:00', strtotime('+3 days')), 'status' => 'pending'],
                    ['id' => 5, 'patient_name' => 'Sofia Mendoza',   'dentist_name' => 'Jane Cruz',     'service_name' => 'Teeth Whitening', 'scheduled_at' => date('Y-m-d 11:00:00', strtotime('+4 days')), 'status' => 'confirmed'],
                ],

                'appointments' => [
                    ['id' => 1, 'patient_id' => 1, 'dentist_id' => 1, 'service_id' => 1, 'scheduled_at' => date('Y-m-d 09:00:00', strtotime('+1 day')),  'status' => 'confirmed', 'notes' => 'Routine cleaning'],
                    ['id' => 2, 'patient_id' => 2, 'dentist_id' => 2, 'service_id' => 2, 'scheduled_at' => date('Y-m-d 10:30:00', strtotime('+1 day')),  'status' => 'pending',   'notes' => ''],
                    ['id' => 3, 'patient_id' => 3, 'dentist_id' => 1, 'service_id' => 4, 'scheduled_at' => date('Y-m-d 14:00:00', strtotime('+2 days')), 'status' => 'confirmed', 'notes' => 'Follow-up'],
                    ['id' => 4, 'patient_id' => 4, 'dentist_id' => 2, 'service_id' => 6, 'scheduled_at' => date('Y-m-d 15:30:00', strtotime('+3 days')), 'status' => 'pending',   'notes' => ''],
                    ['id' => 5, 'patient_id' => 5, 'dentist_id' => 1, 'service_id' => 5, 'scheduled_at' => date('Y-m-d 11:00:00', strtotime('+4 days')), 'status' => 'completed', 'notes' => 'Done'],
                    ['id' => 6, 'patient_id' => 1, 'dentist_id' => 2, 'service_id' => 3, 'scheduled_at' => date('Y-m-d 16:00:00', strtotime('-2 days')), 'status' => 'completed', 'notes' => ''],
                    ['id' => 7, 'patient_id' => 3, 'dentist_id' => 1, 'service_id' => 1, 'scheduled_at' => date('Y-m-d 13:00:00', strtotime('-5 days')), 'status' => 'cancelled', 'notes' => 'Patient cancelled'],
                ],

                'patients' => [
                    ['id' => 1, 'name' => 'Maria Santos',     'email' => 'maria@example.com',    'phone' => '0917-111-1111', 'birthdate' => '1990-03-12', 'gender' => 'female', 'address' => 'Quezon City',  'created_at' => date('Y-m-d', strtotime('-2 days'))],
                    ['id' => 2, 'name' => 'Juan Dela Cruz',   'email' => 'juan@example.com',     'phone' => '0917-222-2222', 'birthdate' => '1985-07-04', 'gender' => 'male',   'address' => 'Manila',       'created_at' => date('Y-m-d', strtotime('-5 days'))],
                    ['id' => 3, 'name' => 'Anna Reyes',       'email' => 'anna@example.com',     'phone' => '0917-333-3333', 'birthdate' => '1995-11-22', 'gender' => 'female', 'address' => 'Makati',       'created_at' => date('Y-m-d', strtotime('-7 days'))],
                    ['id' => 4, 'name' => 'Pedro Garcia',     'email' => 'pedro@example.com',    'phone' => '0917-444-4444', 'birthdate' => '2002-01-15', 'gender' => 'male',   'address' => 'Pasig',        'created_at' => date('Y-m-d', strtotime('-10 days'))],
                    ['id' => 5, 'name' => 'Sofia Mendoza',    'email' => 'sofia@example.com',    'phone' => '0917-555-5555', 'birthdate' => '1988-09-30', 'gender' => 'female', 'address' => 'Taguig',       'created_at' => date('Y-m-d', strtotime('-14 days'))],
                    ['id' => 6, 'name' => 'Carlos Mendoza',   'email' => 'carlos@example.com',   'phone' => '0917-666-6666', 'birthdate' => '1979-04-18', 'gender' => 'male',   'address' => 'Mandaluyong',  'created_at' => date('Y-m-d', strtotime('-20 days'))],
                    ['id' => 7, 'name' => 'Liza Bautista',    'email' => 'liza@example.com',     'phone' => '0917-777-7777', 'birthdate' => '1992-12-05', 'gender' => 'female', 'address' => 'San Juan',     'created_at' => date('Y-m-d', strtotime('-25 days'))],
                ],

                'dentists' => [
                    ['id' => 1, 'name' => 'Jane Cruz',    'email' => 'jane@clinic.local',  'phone' => '0917-100-1001', 'specialty' => 'Orthodontics',  'license_no' => 'DDS-001'],
                    ['id' => 2, 'name' => 'Mark Reyes',   'email' => 'mark@clinic.local',  'phone' => '0917-100-1002', 'specialty' => 'Endodontics',   'license_no' => 'DDS-002'],
                    ['id' => 3, 'name' => 'Liza Tan',     'email' => 'liza@clinic.local',  'phone' => '0917-100-1003', 'specialty' => 'Pediatrics',    'license_no' => 'DDS-003'],
                ],

                'staff' => [
                    ['id' => 1, 'name' => 'Rosa Lim',     'email' => 'rosa@clinic.local',  'phone' => '0917-200-2001', 'position' => 'Receptionist'],
                    ['id' => 2, 'name' => 'Mike Tan',     'email' => 'mike@clinic.local',  'phone' => '0917-200-2002', 'position' => 'Dental Hygienist'],
                ],

                'services' => [
                    ['id' => 1, 'name' => 'Dental Cleaning',    'price' => 1500.00, 'duration_min' => 45, 'description' => 'Routine prophylaxis'],
                    ['id' => 2, 'name' => 'Tooth Extraction',   'price' => 1200.00, 'duration_min' => 30, 'description' => 'Simple extraction'],
                    ['id' => 3, 'name' => 'Dental Filling',     'price' => 1800.00, 'duration_min' => 45, 'description' => 'Composite filling'],
                    ['id' => 4, 'name' => 'Root Canal',         'price' => 8000.00, 'duration_min' => 90, 'description' => 'Endodontic treatment'],
                    ['id' => 5, 'name' => 'Teeth Whitening',    'price' => 6500.00, 'duration_min' => 60, 'description' => 'In-office whitening'],
                    ['id' => 6, 'name' => 'Braces Adjustment',  'price' => 2000.00, 'duration_min' => 30, 'description' => 'Orthodontic adjustment'],
                ],

                'treatments' => [
                    ['id' => 1, 'patient_id' => 1, 'dentist_id' => 1, 'tooth_number' => '11', 'diagnosis' => 'Caries', 'procedure' => 'Filling',   'performed_at' => date('Y-m-d', strtotime('-3 days'))],
                    ['id' => 2, 'patient_id' => 2, 'dentist_id' => 2, 'tooth_number' => '36', 'diagnosis' => 'Pulpitis','procedure' => 'Root Canal','performed_at' => date('Y-m-d', strtotime('-7 days'))],
                    ['id' => 3, 'patient_id' => 3, 'dentist_id' => 1, 'tooth_number' => '21', 'diagnosis' => 'Stain',   'procedure' => 'Whitening', 'performed_at' => date('Y-m-d', strtotime('-1 day'))],
                ],

                'invoices' => [
                    ['id' => 1001, 'patient_id' => 1, 'total' => 1500.00, 'status' => 'paid',    'notes' => 'Cleaning', 'issued_at' => date('Y-m-d', strtotime('-3 days'))],
                    ['id' => 1002, 'patient_id' => 2, 'total' => 8000.00, 'status' => 'unpaid',  'notes' => 'Root canal','issued_at'=> date('Y-m-d', strtotime('-2 days'))],
                    ['id' => 1003, 'patient_id' => 3, 'total' => 6500.00, 'status' => 'partial', 'notes' => 'Whitening','issued_at' => date('Y-m-d', strtotime('-1 day'))],
                    ['id' => 1004, 'patient_id' => 5, 'total' => 1200.00, 'status' => 'paid',    'notes' => 'Extraction','issued_at'=> date('Y-m-d')],
                ],

                'inventory' => [
                    ['id' => 1, 'name' => 'Latex Gloves',      'sku' => 'LG-100', 'quantity' => 240, 'unit' => 'pcs', 'reorder_at' => 50],
                    ['id' => 2, 'name' => 'Dental Cement',     'sku' => 'DC-22',  'quantity' => 12,  'unit' => 'tube','reorder_at' => 20],
                    ['id' => 3, 'name' => 'Composite Resin',   'sku' => 'CR-15',  'quantity' => 8,   'unit' => 'tube','reorder_at' => 10],
                    ['id' => 4, 'name' => 'Anesthetic',        'sku' => 'AN-50',  'quantity' => 60,  'unit' => 'vial','reorder_at' => 30],
                    ['id' => 5, 'name' => 'Cotton Rolls',      'sku' => 'CR-300', 'quantity' => 500, 'unit' => 'pcs', 'reorder_at' => 100],
                ],

                'monthly' => [
                    ['ym' => '2026-01', 'label' => 'Jan', 'total' => 42000],
                    ['ym' => '2026-02', 'label' => 'Feb', 'total' => 58500],
                    ['ym' => '2026-03', 'label' => 'Mar', 'total' => 51200],
                    ['ym' => '2026-04', 'label' => 'Apr', 'total' => 73900],
                    ['ym' => '2026-05', 'label' => 'May', 'total' => 87450],
                ],

                'top_services' => [
                    ['name' => 'Dental Cleaning',  'count' => 45],
                    ['name' => 'Tooth Extraction', 'count' => 28],
                    ['name' => 'Dental Filling',   'count' => 22],
                    ['name' => 'Root Canal',       'count' => 11],
                    ['name' => 'Teeth Whitening',  'count' => 9],
                ],

                'settings' => [
                    'clinic_name'    => 'Dental Clinic',
                    'clinic_address' => '123 Smile Avenue, Quezon City',
                    'clinic_phone'   => '+63 2 8000 1234',
                    'clinic_email'   => 'info@brightsmile.local',
                    'currency'       => 'PHP',
                ],
            ];
        }

        return $cache[$key] ?? [];
    }
}

if (!function_exists('mock_find')) {
    function mock_find(string $key, $id): ?array
    {
        foreach (mock($key) as $row) {
            if (($row['id'] ?? null) == $id) return $row;
        }
        return null;
    }
}
