<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HseChecklist extends Model
{
    use HasFactory;
    /**
     * Nama tabel yang digunakan (opsional jika nama tabelnya bukan plural dari nama model).
     */
    protected $table = 'hse_checklists';

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
    protected $fillable = ['date', 'reported_by', 'inst_dept', 'condition_status', 'ppe', 'working_position', 'ergonomic_health', 'tools_equipment', 'procedures', 'environment_housekeeping'];

    /**
     * Kolom yang bertipe JSON.
     */
    protected $casts = [
        'ppe' => 'array',
        'working_position' => 'array',
        'ergonomic_health' => 'array',
        'tools_equipment' => 'array',
        'procedures' => 'array',
        'environment_housekeeping' => 'array',
    ];
}
