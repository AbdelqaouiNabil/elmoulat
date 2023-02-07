<?php

namespace App\Imports;

use App\Models\Projet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;

class ProjetsImport implements ToModel, WithHeadingRow
{
    protected $path;
    public $image;
    public $excel_data = [];
    public function __construct($image, $path)
    {

        $this->image = $image;
        $this->path = $path;

    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function readData()
    {
        $i = 0;
        $spreadsheet = IOFactory::load(storage_path('app/' . $this->path));
        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(1, $row_limit);
        // $column_range = range('J', $column_limit);
        $startcount = 1;
        $data = array();
        foreach ($row_range as $row) {
            $this->excel_data[$i]['name'] = $sheet->getCell('A' . $row)->getValue();
            $this->excel_data[$i]['consistance'] = $sheet->getCell('C' . $row)->getValue();
            $this->excel_data[$i]['titre_finance'] = $sheet->getCell('D' . $row)->getValue();
            $this->excel_data[$i]['superfice'] = $sheet->getCell('E' . $row)->getValue();
            $this->excel_data[$i]['adress'] = $sheet->getCell('F' . $row)->getValue();
            $this->excel_data[$i]['ville'] = $sheet->getCell('G' . $row)->getValue();
            $this->excel_data[$i]['autorisation'] = $sheet->getCell('H' . $row)->getValue();
            $this->excel_data[$i]['datedebut'] ="2023-01-08" ;//$sheet->getCell('I' . $row)->getValue();
            $this->excel_data[$i]['datefin'] = "2023-02-08";//$sheet->getCell('J' . $row)->getValue();
            $this->excel_data[$i]['id_bureau'] = $sheet->getCell('K' . $row)->getValue();
            $this->excel_data[$i]['id_caisse'] = $sheet->getCell('L' . $row)->getValue();
            $startcount++;
            $i++;
        }
       


        return $this->excel_data;

    }
    public function model(array $row)
    {


        $spreadsheet = IOFactory::load(storage_path('app/' . $this->path));

        $i = 0;
        $j = 0;
        $currentImage = "";
        //  fetch images from exel file
        foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {


            if ($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case MemoryDrawing::MIMETYPE_PNG:
                        $extension = 'png';
                        break;
                    case MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case MemoryDrawing::MIMETYPE_JPEG:
                        $extension = 'jpg';
                        break;
                }
            } else {
                $zipReader = fopen($drawing->getPath(), 'r');
                $imageContents = '';
                while (!feof($zipReader)) {
                    $imageContents .= fread($zipReader, 1024);
                }
                fclose($zipReader);
                $extension = $drawing->getExtension();
            }


            $myFileName = time() . ++$i . '.' . $extension;



            Storage::disk('local')->put('public/images/projets/' . $myFileName, $imageContents);

            $this->excel_data[$j]['image'] = 'public/images/projets/' . $myFileName;
            $j++;
        }

        $data = $this->readData();

       
        
        foreach ($data as $d) {
            $projet = array('name'=>$d["name"], 
            'image'=>$d["image"], 
            'consistance'=>$d["consistance"], 
            'titre_finance'=>$d["titre_finance"], 
            'autorisation'=>$d["autorisation"], 
            'superfice'=>$d["superfice"], 
            'ville'=>$d["ville"], 
            'adress'=>$d["adress"], 
            'datedebut'=>$d["datedebut"], 
            'datefin'=>$d["datefin"], 
            'id_bureau'=>$d["id_bureau"],
            'id_caisse'=> $d["id_caisse"]);
            DB::table('projets')->insert($projet);
            // $projet = new Projet;
            // $projet->name = $d["name"];
            // $projet->image = $d["image"];
            // $projet->consistance = $d["consistance"];
            // $projet->titre_finance = $d["titre_finance"];
            // $projet->autorisation = $d["autorisation"];
            // $projet->superfice = $d["superfice"];
            // $projet->ville = $d["ville"];
            // $projet->adress = $d["adress"];
            // $projet->datedebut = "2023-02-08";
            // $projet->datefin = "2023-02-08";
            // $projet->id_bureau = $d["id_bureau"];
            // $projet->id_caisse = $d["id_caisse"];
            // $projet->save();
        }

        // for($i=0 ; $i<count($data) ;$i++){


        //     $projet = new Projet;
        //     $projet->name = $data[$i]["name"];
        //     $projet->image = $data[$i]["image"];
        //     $projet->consistance = $data[$i]["consistance"];
        //     $projet->titre_finance = $data[$i]["titre_finance"];
        //     $projet->autorisation = $data[$i]["autorisation"];
        //     $projet->superfice =  $data[$i]["superfice"];
        //     $projet->ville = $data[$i]["ville"];
        //     $projet->adress =  $data[$i]["adress"];
        //     $projet->datedebut ="2023-02-08";
        //     $projet->datefin = "2023-02-08";
        //     $projet->id_bureau = $data[$i]["id_bureau"];
        //     $projet->id_caisse = $data[$i]["id_caisse"];
        //     $projet->save();
        //     }
    }

    public function mydata(){
        return $this->excel_data;
    }
    
    


}