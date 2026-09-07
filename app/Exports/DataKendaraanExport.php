<?php

namespace App\Exports;

use App\Models\DataKendaraanModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataKendaraanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    protected $filters;
    protected $no = 1;
    protected $judulLaporan = 'DAFTAR LIST KENDARAAN';

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Data
     */
    public function collection()
    {
        $stts = $this->filters['stts_kendaraan'] ?? 0;

        return DataKendaraanModel::with(['JBiodata.BadanUsaha', 'JkendaraanMerek', 'JkendaraanType'])
            ->when($stts != 0, function ($q) use ($stts) {
                $q->where('status_actived', $stts);
            })
            ->get()
            ->sortBy(fn($item) => $item->JBiodata->nm_perusahaan_personal ?? '');
    }

    /**
     * Heading (ROW 2)
     */
    public function headings(): array
    {
        return ['NO', 'PERUSAHAAN / PERSONAL', 'BADAN USAHA', 'MERK / TYPE', 'NAMA KENDARAAN', 'NO PLAT', 'NO RANGKA', 'NO MESIN', 'DAYA ANGKUT ORANG', 'DAYA ANGKUT BARANG', 'TAHUN', 'STATUS'];
    }

    /**
     * Start cell supaya judul tidak bentrok
     */
    public function startCell(): string
    {
        return 'A2';
    }

    /**
     * Mapping data (DISESUAIKAN DENGAN DATA BAPAK)
     */
    public function map($row): array
    {
        // No Kartu Pengawas
        $noKrtuPengws = $row->no_kartu_pengawas;

        if (is_numeric($noKrtuPengws) && $noKrtuPengws !== '') {
            $noKrtuPengws = "'" . $noKrtuPengws;
        } elseif (!empty($noKrtuPengws)) {
            $noKrtuPengws = $noKrtuPengws;
        } else {
            $noKrtuPengws = '-';
        }

        // No Rangka
        $noRangka = $row->no_rangka;

        if (is_numeric($noRangka) && $noRangka !== '') {
            $noRangka = "'" . $noRangka;
        } elseif (!empty($noRangka)) {
            $noRangka = $noRangka;
        } else {
            $noRangka = '-';
        }

        // No Mesin
        $noMesin = $row->no_mesin;

        if (is_numeric($noMesin) && $noMesin !== '') {
            $noMesin = "'" . $noMesin;
        } elseif (!empty($noMesin)) {
            $noMesin = $noMesin;
        } else {
            $noMesin = '-';
        }

        return [$this->no++, optional($row->JBiodata)->nm_perusahaan_personal ?? '-', optional(optional($row->JBiodata)->BadanUsaha)->nm_badan_usaha ?? 'Personal / Perorangan', (optional($row->JkendaraanMerek)->nm_merek_kendaraan ?? '-') . ' / ' . (optional($row->JkendaraanType)->nm_type_kendaraan ?? '-'), $row->nm_kendaraan ?? '-', $row->plat_no_kendaraan ?? '-', $noRangka, $noMesin, $row->daya_angkut_orang ?? 0, $row->daya_angkut_barang ?? 0, $row->thn_pembuatan ?? '-', $row->status_actived == 1 ? 'Aktif' : 'Tidak Aktif'];
    }

    /**
     * Style header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            2 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
        ];
    }

    /**
     * Event tambahan
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                // JUDUL
                $sheet->mergeCells('A1:L1');
                $sheet->setCellValue('A1', $this->judulLaporan);
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ],
                ]);

                // BORDER
                $sheet
                    ->getStyle("A2:L{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle('thin');

                // FREEZE HEADER
                $sheet->freezePane('A3');
            },
        ];
    }

    public function title(): string
    {
        return 'Data Kendaraan';
    }
}
