<?php

namespace App\Enums;

enum AppointmentEnum:string
{
    case MedicalExamination = 'Medical Checkup';
    case DoctorCheck = 'Cek Dokter';
    case ResultAnalysis = 'Analisis Hasil';
    case CheckUp = 'Pemeriksaan';
}
