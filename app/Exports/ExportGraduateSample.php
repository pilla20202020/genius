<?php

namespace App\Exports;

use App\Modules\Models\Graduates\Graduates;
use App\Modules\Models\Graduation\Graduation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportGraduateSample implements FromCollection,WithHeadings,WithEvents,ShouldAutoSize
{
    protected $selects;
    protected $row_count;
    protected $column_count;

    public function __construct()
    {
        $graduation = Graduation::selectRaw('CONCAT(id, " - ", title) as IdAndName')->orderBy('id')->pluck('IdAndName')->toArray();
        $marital_status = ['Eligible','Register','Incomplete'];
        $selects = [
            ['columns_name'=>'A','options'=>$graduation],
            ['columns_name'=>'G','options'=>$marital_status],
        ];
        $this->selects = $selects;
        $this->row_count = 10000;
        $this->column_count = 13;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'Graduation',
            'Student Id',
            'First Name',
            'Last Name',
            'Email',
            'Mobile',
            'Status',
            
        ];
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                $row_count = $this->row_count;
                $column_count = $this->column_count;
                foreach ($this->selects as $select){
                    $drop_column = $select['columns_name'];
                    $options = $select['options'];
                    // set dropdown list for first data row
                    $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST );
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input error');
                    $validation->setError('Value is not in list.');
                    $validation->setPromptTitle('Pick from list');
                    $validation->setPrompt('Please pick a value from the drop-down list.');
                    $validation->setFormula1(sprintf('"%s"',implode(',',$options)));

                    // clone validation to remaining rows
                    for ($i = 3; $i <= $row_count; $i++) {
                        $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    }
                    // set columns to autosize
                    for ($i = 1; $i <= $column_count; $i++) {
                        $column = Coordinate::stringFromColumnIndex($i);
                        $event->sheet->getColumnDimension($column)->setAutoSize(true);
                    }
                }

            },
        ];
    }
}
