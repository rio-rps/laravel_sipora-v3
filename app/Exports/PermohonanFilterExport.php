<?php

namespace App\Exports;

use App\Models\BparKabKotaModel;
use App\Models\CparJenisPermohonanModel;
use App\Models\PengajuanPermohonanModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\BeforeSheet;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PermohonanFilterExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $filters;
    protected $data;
    private $rowNumber = 0;
    private $keterangan;

    public function __construct($filters)
    {
        $this->filters = $filters;
        $this->data = $this->getData();
    }

    public function getData()
    {
        [$tgl_awal, $tgl_akhir] = explode(' - ', $this->filters['tanggalFilter']);
        $id_jenis_permohonan = $this->filters['id_jenis_permohonan'];
        $status_permohonan = $this->filters['status_permohonan'];
        $id_kabkota = $this->filters['id_kabkota'];
        $tgl_awal = $tgl_awal;
        $tgl_akhir = $tgl_akhir;

        $kabkota = BparKabKotaModel::where('id_kabkota', $id_kabkota)->first();
        $resultPermohonan = PengajuanPermohonanModel::join('bpar_002_kabkota', function ($join) {
            $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
        })
            ->leftJoin('tr_permohonan_002_validasi', function ($join) {
                $join->on('tr_permohonan_002_validasi.id_permohonan_izin', '=', 'tr_permohonan.id_permohonan_izin');
            })
            ->leftJoin('bpar_badan_usaha', function ($join) {
                $join->on('bpar_badan_usaha.id_badan_usaha', '=', 'tr_permohonan.id_badan_usaha');
            })
            ->where('status_permohonan', $status_permohonan)
            // ->when($tgl_awal && $tgl_akhir, function ($query) use ($tgl_awal, $tgl_akhir) {
            //     $query->whereBetween('tr_permohonan.tgl_kirim_permohonan', [$tgl_awal, $tgl_akhir]);
            // })
            ->when($tgl_awal && $tgl_akhir, function ($query) use ($tgl_awal, $tgl_akhir) {
                $query->whereBetween('tr_permohonan.tgl_kirim_permohonan', [Carbon::parse($tgl_awal)->startOfDay(), Carbon::parse($tgl_akhir)->endOfDay()]);
            })
            ->orderBy('tr_permohonan.tgl_kirim_permohonan', 'ASC');

        // Cek jika id_jenis_permohonan bukan 'All'
        if ($id_jenis_permohonan != 'All') {
            $resultPermohonan = $resultPermohonan->where('id_jenis_permohonan', $id_jenis_permohonan);
        }

        // Cek Semua peovinsi
        if ($id_kabkota != 'SEMUA') {
            $resultPermohonan = $resultPermohonan->where('tr_permohonan.kode_provinsi', $kabkota->kode_provinsi)->where('tr_permohonan.kode_kabkota', $kabkota->kode_kabkota);

            $kabkotaRow = $kabkota->nm_kabkota;
        } else {
            $kabkotaRow = 'SEMUA';
        }

        $this->keterangan = [
            'jenisPermohonan' => CparJenisPermohonanModel::where('id_jenis_permohonan', $id_jenis_permohonan)->first()->nm_jenis_permohonan ?? 'SEMUA PERMOHONAN',
            'sttsPermohonan' => cek_status_permohonan($status_permohonan),
            'kabkota' => $kabkotaRow,
            'datePeriode' => cek_ddmmyy_v1($tgl_awal) . ' s/d ' . cek_ddmmyy_v1($tgl_akhir),
        ];
        return $resultPermohonan->get();
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($row): array
    {
        $this->rowNumber++;

        $data = [$this->rowNumber, cek_date_ddmmyyyy_his_v2($row->tgl_kirim_permohonan)];

        // Tambahkan kolom validasi hanya jika status_permohonan == 5
        if ($row->status_permohonan == 5) {
            $data[] = $row->tgl_validasi_selesai ? cek_date_ddmmyyyy_his_v2($row->tgl_validasi_selesai) : '-';
            //$data[] = (string) ($row->no_kartu_pengawas ?? '-');
            //$data[] = "'" . ($row->no_kartu_pengawas ?? '-');

            $noKrtuPengws = $row->no_kartu_pengawas;
            if (is_numeric($noKrtuPengws) && $noKrtuPengws !== '') {
                $data[] = "'" . $noKrtuPengws;
            } elseif (!empty($noKrtuPengws)) {
                $data[] = $noKrtuPengws;
            } else {
                $data[] = '-';
            }

            $data[] = $row->tgl_sk ? cek_ddmmyy_v1($row->tgl_sk) : '-';
            //$data[] = (string) ($row->no_sk ?? '-');
            $no_sk = $row->no_sk;
            if (is_numeric($no_sk) && $no_sk !== '') {
                $data[] = "'" . $no_sk;
            } elseif (!empty($no_sk)) {
                $data[] = $no_sk;
            } else {
                $data[] = '-';
            }

            $data[] = $row->tgl_awal ? cek_ddmmyy_v1($row->tgl_awal) : '-';
            $data[] = $row->tgl_akhir ? cek_ddmmyy_v1($row->tgl_akhir) : '-';
            $data[] = $row->tgl_kir_awal ? cek_ddmmyy_v1($row->tgl_kir_awal) : '-';
            $data[] = $row->tgl_kir_akhir ? cek_ddmmyy_v1($row->tgl_kir_akhir) : '-';

            $data[] = $row->tgl_pkb_awal ? cek_ddmmyy_v1($row->tgl_pkb_awal) : '-';
            $data[] = $row->tgl_pkb_akhir ? cek_ddmmyy_v1($row->tgl_pkb_akhir) : '-';

            $data[] = $row->tgl_iwkbu_awal ? cek_ddmmyy_v1($row->tgl_iwkbu_awal) : '-';
            $data[] = $row->tgl_iwkbu_akhir ? cek_ddmmyy_v1($row->tgl_iwkbu_akhir) : '-';
        }

        $data[] = $row->nm_perusahaan_personal . '/ ' . ($row->BadanUsaha->nm_badan_usaha ?? '-');
        $data[] = $row->nm_pimpinan_pemilik;
        $data[] = $row->JkendaraanMerek->nm_merek_kendaraan ?? '-';
        $data[] = $row->JkendaraanType->nm_type_kendaraan ?? '-';
        $data[] = $row->nm_kendaraan ?? '-';
        $data[] = $row->thn_pembuatan ?? '-';
        $data[] = $row->no_rangka ?? '-';
        $data[] = $row->no_mesin ?? '-';
        $data[] = $row->JjenisPermohonan->nm_jenis_permohonan ?? '-';
        $data[] = $row->JPermohonan->nm_par_permohonan ?? '-';
        $data[] = $row->JjenisAngkutan->nm_jenis_angkutan ?? '-';
        $data[] = $row->Jtrayek->nm_trayek ?? '-';
        $data[] = $row->jmengangkut->nm_mengangkut ?? '-';
        $data[] = $row->daya_angkut_orang ?? '-';
        $data[] = $row->daya_angkut_barang ?? '-';
        $data[] = $row->plat_no_kendaraan ?? '-';
        $data[] = $row->warna_tnkb ?? '-';
        $data[] = $row->bahan_bakar ?? '-';
        $data[] = $row->nm_kabkota ?? '-';

        return $data;
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT, // No Kartu Pengawas
            'U' => NumberFormat::FORMAT_TEXT, // No Rangka
            'V' => NumberFormat::FORMAT_TEXT, // No Mesin
            'AD' => NumberFormat::FORMAT_TEXT, // No Plat Kendaraan
        ];
    }

    public function headings(): array
    {
        $headings = ['No', 'Tanggal Permohonan'];

        if ($this->filters['status_permohonan'] == 5) {
            $headings[] = 'Tanggal Validasi';
            $headings[] = 'No Kartu Pengawas';
            $headings[] = 'Tanggal SK';
            $headings[] = 'No SK';
            $headings[] = 'Tanggal Awal SK';
            $headings[] = 'Tanggal Akhir SK';
            $headings[] = 'Tanggal KIR Awal';
            $headings[] = 'Tanggal KIR Akhir';

            $headings[] = 'Tanggal PKB Awal';
            $headings[] = 'Tanggal PKB Akhir';

            $headings[] = 'Tanggal IWKBU Awal';
            $headings[] = 'Tanggal IWKBU Akhir';
        }

        $headings = array_merge($headings, ['Nama Perusahaan', 'Nama Pimpinan', 'Merek Kendaraan', 'Tipe Kendaraan', 'Nama Kendaraan', 'Tahun Pembuatan', 'No Rangka', 'No Mesin', 'Jenis Permohonan', 'Permohonan', 'Jenis Angkutan', 'Trayek', 'Mengangkut', 'Daya Angkut Orang', 'Daya Angkut Barang / Kg', 'No Plat Kendaraan', 'Warna TNKB', 'Bahan Bakar', 'Kab/Kota']);

        return $headings;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->insertNewRowBefore(1, 5);
                $ket = $this->keterangan;

                $sheet->setCellValue('B1', 'Jenis Permohonan');
                $sheet->setCellValue('C1', ':');
                $sheet->setCellValue('D1', strtoupper($ket['jenisPermohonan']));

                $sheet->setCellValue('B2', 'Status Permohonan');
                $sheet->setCellValue('C2', ':');
                $sheet->setCellValue('D2', strtoupper($ket['sttsPermohonan']));

                $sheet->setCellValue('B3', 'Provinsi/Kab/Kota');
                $sheet->setCellValue('C3', ':');
                $sheet->setCellValue('D3', strtoupper($ket['kabkota']));

                $sheet->setCellValue('B4', 'Tanggal Filter');
                $sheet->setCellValue('C4', ':');
                $sheet->setCellValue('D4', $ket['datePeriode'] ?? '-');

                $sheet->getStyle('A1:C4')->getFont()->setBold(true);
            },

            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestColumn = $sheet->getHighestColumn(); // Contoh: 'R'
                $lastRow = $sheet->getHighestRow(); // Contoh: '14'

                // Header ada di baris ke-7 (baris judul kolom)
                $headerRow = 7;
                $headerRange = "A{$headerRow}:{$highestColumn}{$headerRow}";

                // Style untuk header
                $sheet->getStyle($headerRange)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'D9D9D9'],
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Style border seluruh data (baris 8 ke bawah)
                $dataRange = "A8:{$highestColumn}{$lastRow}";
                $sheet->getStyle($dataRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Freeze agar header tetap terlihat
                $sheet->freezePane('A8');
            },
        ];
    }
}
