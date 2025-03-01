<?php

namespace App\Enums;

enum AppointmentOptions:string
{
    case MedicalExamination = 'Medical Checkup';
    case DoctorCheck = 'Cek Dokter';
    case ResultAnalysis = 'Analisis Hasil';
    case CheckUp = 'Pemeriksaan';
}
