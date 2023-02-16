<?php

namespace App\Http\Livewire\ProjectSection;

use App\Exports\ProjectExport;
use App\Imports\ProjetsImport;
use App\Models\Charge;
use Illuminate\Database\QueryException;
use Livewire\Component;
use App\Models\Projet;
use App\Models\Bureau;
use App\Models\Caisse;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

use File;
use DB;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;

class ProjectsList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $dated, $datef, $autorisation, $superfice, $image, $consistance, $adress, $ville, $titre_finance, $project_edit_id, $id_bureau, $id_caisse,$search;
    public $exelFile;
    public $excel_data = [];
    public $selectedProjects = [];
    public $selectAll = false;
    public $bulkDisabled = true;
    public $pages = 5;
    public $sortname = "id";
    public $sortdrection = "DESC";
    protected $listeners = ['saveData' => 'saveData'];

    //   validation real -time
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'autorisation' => 'required',
            'image' => 'image|max:3024',
            'ville' => 'required',
            'datef' => 'required|date',
            'dated' => 'required|date',
            'id_bureau' => 'required|integer',
            'id_caisse' => 'required|integer',
            'superfice' => 'required|regex:/^\d*(\.\d{2})?$/',
        ]);
    }

    // save projects start
    public function saveData()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required|image',
            'ville' => 'required',
            'datef' => 'required|date',
            'dated' => 'required|date',
            'id_bureau' => 'required|integer',
            'id_caisse' => 'required|integer',
            'superfice' => 'required|regex:/^\d*(\.\d{2})?$/',


        ]);

        $validatedData = $this->image->store('images/projets', 'public');
        $projet = new Projet;
        $projet->name = $this->name;
        $projet->image = $validatedData;
        $projet->consistance = $this->consistance;
        $projet->titre_finance = $this->titre_finance;
        $projet->autorisation = $this->autorisation;
        $projet->superfice = $this->superfice;
        $projet->ville = $this->ville;
        $projet->adress = $this->adress;
        $projet->datedebut = $this->dated;
        $projet->datefin = $this->datef;
        $projet->id_bureau = $this->id_bureau;
        $projet->id_caisse = $this->id_caisse;
        $projet->save();
        session()->flash('message', 'projet bien ajouter');

        $this->resetInputs();

        $this->dispatchBrowserEvent('add');

        // for hidden the model after adding the project
        $this->dispatchBrowserEvent('close-model');


    }
    // save project end
//  edit project start

    public function resetInputs()
    {

        $this->name = "";
        $this->image = "";
        $this->consistance = "";
        $this->titre_finance = "";
        $this->autorisation = "";
        $this->superfice = "";
        $this->ville = "";
        $this->adress = "";
        $this->dated = "";
        $this->datef = "";
        $this->id_caisse = "";
        $this->id_bureau = "";
        $this->project_edit_id = "";
    }

    public function editProject($id)
    {

        $projet = Projet::where('id', $id)->first();
        $this->project_edit_id = $projet->id;
        $this->id = $projet->id;
        $this->name = $projet->name;
        $this->dated = $projet->datedebut;
        $this->datef = $projet->datefin;
        $this->ville = $projet->ville;
        $this->adress = $projet->adress;
        $this->consistance = $projet->consistance;
        $this->titre_finance = $projet->titre_finance;
        $this->autorisation = $projet->autorisation;
        $this->superfice = $projet->superfice;
        $this->id_bureau = $projet->id_bureau;
        $this->id_caisse = $projet->id_caisse;


    }

    public function editData()
    {
        $this->validate([
            'name' => 'required',
            'autorisation' => 'required',
            'ville' => 'required',
            'datef' => 'required|date',
            'dated' => 'required|date',
            'id_bureau' => 'required|integer',
            'id_caisse' => 'required|integer',
            'superfice' => 'required|regex:/^\d*(\.\d{2})?$/',


        ]);
        $projet = Projet::where('id', $this->project_edit_id)->first();
        $projet->name = $this->name;
        $projet->consistance = $this->consistance;
        $projet->titre_finance = $this->titre_finance;
        $projet->autorisation = $this->autorisation;
        $projet->superfice = $this->superfice;
        $projet->ville = $this->ville;
        $projet->adress = $this->adress;
        $projet->datedebut = $this->dated;
        $projet->datefin = $this->datef;
        $projet->id_bureau = $this->id_bureau;
        $projet->id_caisse = $this->id_caisse;
        $projet->save();
        $this->resetInputs();
        session()->flash('message', 'projet bien modifer');
        $this->dispatchBrowserEvent('close-model');
    }
    //  edit project end
//  delete project start

    public function deleteProject($id)
    {
        $projet = Projet::where('id', $id)->first();
        $this->project_edit_id = $projet->id;
        $this->name = $projet->name;
        $this->dated = $projet->datedebut;
        $this->datef = $projet->datefin;
        $this->ville = $projet->ville;
        $this->adress = $projet->adress;
        $this->consistance = $projet->consistance;
        $this->titre_finance = $projet->titre_finance;
        $this->autorisation = $projet->autorisation;
        $this->superfice = $projet->superfice;
        $this->image = $projet->image;
        $this->id_bureau = $projet->id_bureau;
        $this->id_caisse = $projet->id_caisse;
    }

    public function deleteData()
    {


        $charge= Charge::where('id_projet',$this->project_edit_id)->get();
        if(count($charge)>0){
            session()->flash('error','you selectd a project use as forieng key in other table');

        }else{
            $path = Storage::disk('local')->url($this->image);
            File::delete(public_path($path));
            Projet::where('id', $this->project_edit_id)->delete();
            $this->resetInputs();
            session()->flash('message', 'projet bien supprimer');
            $this->dispatchBrowserEvent('close-model');
            $this->dispatchBrowserEvent('add');

        }



    }
    public function deleteSelected()
    {
        $charge= Charge::whereIn('id_projet',$this->selectedProjects)->get();
        if(count($charge)>0){
            session()->flash('error','you selectd a project use as forieng key in other table');
        }else{
            $project=Projet::whereIn('id',$this->selectedProjects)->get();
            foreach($project as $p){
                $path = Storage::disk('local')->url($p->image);
                File::delete(public_path($path));
                $p->delete();
            }
            $this->selectedProjects = [];
            $this->selectAll = false;
            session()->flash('message', 'projet bien supprimer');
            $this->resetInputs();

        }
        $this->dispatchBrowserEvent('close-model');




    }
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedProjects = Projet::pluck('id');
        } else {
            $this->selectedProjects = [];
        }
    }

    // delete multiple projects end
//  import project start

    public function importData()
    {
       try{
        $this->validate([

            'exelFile' => 'required|mimes:xlsx,xls',
        ]);
        // $path = file_get_contents($tt);

        $path = $this->exelFile->store('excel', 'app');
        // Excel::import(new ProjetsImport($this->exelFile, $path), $path);
        $this->excel($path);
        session()->flash('message', 'projet bien imposter');
        $this->dispatchBrowserEvent('close-model');
       }catch(QueryException $e){
        session()->flash('error',''.$e);
       }
       $this->dispatchBrowserEvent('close-model');



    }
    //  import project end


    public function render()
    {

        $this->bulkDisabled = count($this->selectedProjects) < 1;
        $projets = Projet::where('name', 'like', '%'.$this->search.'%')
        ->orWhere('ville', 'like', '%'.$this->search.'%')
        ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        $bureaus = Bureau::all();
        $caisses = Caisse::all();
        return view('livewire.project-section.projects-list', ['projets' => $projets, 'bureaus' => $bureaus, 'caisses' => $caisses]);

    }
    // sort function
    public function sort($value)
    {
        if ($this->sortname == $value && $this->sortdrection == "DESC") {
            $this->sortdrection = "ASC";
        } else {
            if ($this->sortname == $value && $this->sortdrection == "ASC") {
                $this->sortdrection = "DESC";
            }
        }
        $this->sortname = $value;

    }

    // update pagenation
    protected function updatingPages($value)
    {
        $this->resetPage('new');
    }

    public function excel($path){

        $spreadsheet = IOFactory::load(storage_path('app/' . $path));

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

        $data = $this->readData($path);



        foreach ($data as $d) {
            $projet = array(
                'name' => $d["name"],
                'image' => $d["image"],
                'consistance' => $d["consistance"],
                'titre_finance' => $d["titre_finance"],
                'autorisation' => $d["autorisation"],
                'superfice' => $d["superfice"],
                'ville' => $d["ville"],
                'adress' => $d["adress"],
                'datedebut' => $d["datedebut"],
                'datefin' => $d["datefin"],
                'id_bureau' => $d["id_bureau"],
                'id_caisse' => $d["id_caisse"]
            );
            DB::table('projets')->insert($projet);
        }
    }


    public function readData($path)
    {
        $i = 0;
        $spreadsheet = IOFactory::load(storage_path('app/' . $path));
        $sheet = $spreadsheet->getActiveSheet();
        $row_limit = $sheet->getHighestDataRow();
        // $column_limit = $sheet->getHighestDataColumn();
        $row_range = range(1, $row_limit);
        $startcount = 1;
        // $data = array();
        foreach ($row_range as $row) {

            $this->excel_data[$i]['name'] = $sheet->getCell('A' . $row)->getValue();
            $this->excel_data[$i]['consistance'] = $sheet->getCell('C' . $row)->getValue();
            $this->excel_data[$i]['titre_finance'] = $sheet->getCell('D' . $row)->getValue();
            $this->excel_data[$i]['superfice'] = $sheet->getCell('E' . $row)->getValue();
            $this->excel_data[$i]['adress'] = $sheet->getCell('F' . $row)->getValue();
            $this->excel_data[$i]['ville'] = $sheet->getCell('G' . $row)->getValue();
            $this->excel_data[$i]['autorisation'] = $sheet->getCell('H' . $row)->getValue();
            $this->excel_data[$i]['datedebut'] = Date::excelToDateTimeObject($sheet->getCell('I' . $row)->getValue())->format('Y-m-d');
            $this->excel_data[$i]['datefin'] =Date::excelToDateTimeObject($sheet->getCell('J' . $row)->getValue())->format('Y-m-d');
            $this->excel_data[$i]['id_bureau'] = $sheet->getCell('K' . $row)->getValue();
            $this->excel_data[$i]['id_caisse'] = $sheet->getCell('L' . $row)->getValue();
            $startcount++;
            $i++;
        }

        return $this->excel_data;
    }

    // export data
    public function export(){
        return Excel::download(new ProjectExport($this->selectedProjects), 'projects.xlsx');
    }
}
