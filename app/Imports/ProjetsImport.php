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


class ProjetsImport implements ToModel,WithHeadingRow
{
    protected $path;
    public $image;
        public function __construct($image,$path){
            
            $this->image =$image;
            $this->path =$path;

        }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null



    */
   
    public function model(array $row)
    {
        
     
        $spreadsheet = IOFactory::load(storage_path('app/'.$this->path));
       
        $i = 0;
        $j = 0;
        $currentImage = "";
//  fetch images from exel file
foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as  $drawing) {


    if ($drawing instanceof MemoryDrawing) {
        ob_start();
        call_user_func(
            $drawing->getRenderingFunction(),
            $drawing->getImageResource()
        );
        $imageContents = ob_get_contents();
        ob_end_clean();
        switch ($drawing->getMimeType()) {
            case MemoryDrawing::MIMETYPE_PNG :
                $extension = 'png';
                break;
            case MemoryDrawing::MIMETYPE_GIF:
                $extension = 'gif';
                break;
            case MemoryDrawing::MIMETYPE_JPEG :
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
    
   
    $myFileName = time() .++$i. '.' . $extension;
   
    $imagesCollection[] =$myFileName;
   
    Storage::disk('local')->put('public/images/projets/'.$myFileName,$imageContents);

   
}

   
   
     Projet::create([
            'name'     => $row['name'],
            'image'    => 'images/projets/'.$myFileName, 
            'consistance'    => $row['consistance'], 
            'titre_finance'    => $row['titre_finance'], 
            'superfice'    => $row['superfice'], 
            'adress'    => $row['adress'], 
            'ville'    => $row['ville'], 
            'autorisation'    => $row['autorisation'], 
            'datedebut'    =>  Carbon::parse($row['datedebut' ])->format('Y-m-d'), 
            'datefin'    => Carbon::parse($row['datefin' ])->format('Y-m-d'), 
        ]);

        
    
    }
}
