<?php
declare(strict_types=1);

namespace Jikerdev\SimpleExport\Export;

use Jikerdev\SimpleExport\Exception\FileNotGeneratedException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelExport
{
    protected $spreadsheet;
    protected $writer;
    protected $fileName;
    protected $format;
    protected $title;
    protected $tabName;

    public function __construct(
        string $fileName = 'my_excel',
        string $format = 'xlsx',
        string $title = 'my_sheet',
        string $tabName = 'Sheet1'
    )
    {
        $this->fileName = $fileName;
        $this->format = $format;
        $this->title = $title;
        $this->tabName = $tabName;
        $this->spreadsheet = $this->createSpreadsheet();
    }

    /**
     * Create a new instance of the PhpSpreadsheet object for each sheet on the spreadsheet
     *
     * @return Spreadsheet
     */
    protected function createSpreadsheet(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($this->tabName);

        return $spreadsheet;
    }

    /**
     * Set the name of the file to save the spreadsheet as
     *
     * @param string $fileName
     * @return void
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * Set the format of the spreadsheet
     *
     * @param string $format
     * @return void
     */
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * Set the title of the spreadsheet
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Set the name of the tab on the spreadsheet
     *
     * @param string $tabName
     * @return void
     */
    public function setTabName(string $tabName): void
    {
        $this->tabName = $tabName;
        $this->spreadsheet->getActiveSheet()->setTitle($tabName);
    }

    /**
     * Append data to the spreadsheet
     *
     * @param array $data
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function appendData(array $data): void
    {
        $sheet = $this->spreadsheet->getActiveSheet();

        // Get the last row of data
        $lastRow = $sheet->getHighestRow();

        // Write new data to the spreadsheet
        foreach ($data as $rowData) {
            $colNum = 0;
            foreach ($rowData as $cellData) {
                $sheet->setCellValueByColumnAndRow($colNum++, $lastRow + 1, $cellData);
            }
            $lastRow++;
        }

        // Save the updated spreadsheet
        $this->writer = IOFactory::createWriter($this->spreadsheet, $this->format);
        $this->writer->save($this->fileName . '.' . $this->format);
    }

    /**
     * Download the generated file
     *
     * @return void
     * @throws FileNotGeneratedException
     */
    public function download(): void
    {
        $file = $this->fileName . '.' . $this->format;

        if (!file_exists($file)) {
            throw new FileNotGeneratedException('File not generated yet');
        }

        $mime = [
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xls' => 'application/vnd.ms-excel'
        ][$this->format];

        header('Content-Type: ' . $mime);
        header('Content-Disposition: attachment;filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        readfile($file);
    }
}
