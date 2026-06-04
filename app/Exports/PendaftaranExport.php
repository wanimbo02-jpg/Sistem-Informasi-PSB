<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $data;
    protected $columns;

    public function __construct($data, $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $headings = [];
        $columnLabels = [
            'no_pendaftaran' => 'No. Pendaftaran',
            'nama_lengkap' => 'Nama Lengkap',
            'nisn' => 'NISN',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'asal_sekolah' => 'Asal Sekolah',
            'jurusan' => 'Jurusan',
            'gelombang' => 'Gelombang',
            'tanggal_daftar' => 'Tanggal Daftar',
            'status_pendaftaran' => 'Status',
        ];

        foreach ($this->columns as $column) {
            $headings[] = $columnLabels[$column] ?? ucfirst(str_replace('_', ' ', $column));
        }

        return $headings;
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        $mapped = [];

        foreach ($this->columns as $column) {
            switch ($column) {
                case 'jenis_kelamin':
                    $mapped[] = $row->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                    break;
                case 'tanggal_lahir':
                    $mapped[] = $row->tanggal_lahir ? $row->tanggal_lahir->format('d-m-Y') : '-';
                    break;
                case 'tanggal_daftar':
                    $mapped[] = $row->tanggal_daftar ? $row->tanggal_daftar->format('d-m-Y H:i') : '-';
                    break;
                case 'status_pendaftaran':
                    $statusLabels = [
                        'pending' => 'Pending',
                        'diverifikasi' => 'Diverifikasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                        'lulus' => 'Lulus',
                        'tidak_lulus' => 'Tidak Lulus',
                    ];
                    $mapped[] = $statusLabels[$row->status_pendaftaran] ?? $row->status_pendaftaran;
                    break;
                default:
                    $mapped[] = $row->$column ?? '-';
            }
        }

        return $mapped;
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
