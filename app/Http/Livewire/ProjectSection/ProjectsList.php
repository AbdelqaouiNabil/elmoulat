<?php

namespace App\Http\Livewire\ProjectSection;

use App;
use App\Exports\ProjectExport;
use App\Models\Charge;
use App\Models\Depense;
use App\Models\Vente;
use Livewire\Component;
use App\Models\Projet;
use App\Models\Bureau;
use App\Models\Caisse;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

use File;
use DB;
use PDF;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

class ProjectsList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $dated, $datef, $autorisation, $superfice, $image, $consistance, $adress, $ville, $titre_finance, $project_edit_id, $id_bureau, $id_caisse, $search;
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


        $charge = Charge::where('id_projet', $this->project_edit_id)->get();
        $vente = Vente::where('project_id', $this->project_edit_id)->get();
        $depense = Depense::where('id_projet', $this->project_edit_id)->get();


        if (count($charge) > 0 ||count($vente)>0 ||count($depense)>0) {
            session()->flash('error', 'you selectd a project use as forieng key in other table');

        } else {
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
        $charge = Charge::whereIn('id_projet', $this->selectedProjects)->get();
        $vente = Vente::whereIn('project_id', $this->selectedProjects)->get();
        $depense = Depense::whereIn('id_projet', $this->selectedProjects)->get();
        if (count($charge) > 0 || count($vente) > 0 || count($depense) > 0) {
            session()->flash('error', 'you selectd a project use as forieng key in other table');
        } else {
            $project = Projet::whereIn('id', $this->selectedProjects)->get();
            foreach ($project as $p) {
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

        $this->validate([

            'exelFile' => 'required|mimes:xlsx,xls',
        ]);
        try {
            $path = $this->exelFile->store('excel', 'app');
            $spreadsheet = IOFactory::load(storage_path('app/' . $path));

            $i = 0;
            $j = 0;

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
            //  add data to array from excel 
            $i = 0;
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $row_range = range(2, $row_limit);
            foreach ($row_range as $row) {

                $this->excel_data[$i]['name'] = $sheet->getCell('A' . $row)->getValue();
                $this->excel_data[$i]['consistance'] = $sheet->getCell('C' . $row)->getValue();
                $this->excel_data[$i]['titre_finance'] = $sheet->getCell('D' . $row)->getValue();
                $this->excel_data[$i]['superfice'] = $sheet->getCell('E' . $row)->getValue();
                $this->excel_data[$i]['adress'] = $sheet->getCell('F' . $row)->getValue();
                $this->excel_data[$i]['ville'] = $sheet->getCell('G' . $row)->getValue();
                $this->excel_data[$i]['autorisation'] = $sheet->getCell('H' . $row)->getValue();
                $this->excel_data[$i]['datedebut'] = Date::excelToDateTimeObject($sheet->getCell('I' . $row)->getValue())->format('Y-m-d');
                $this->excel_data[$i]['datefin'] = Date::excelToDateTimeObject($sheet->getCell('J' . $row)->getValue())->format('Y-m-d');
                $this->excel_data[$i]['id_bureau'] = $sheet->getCell('K' . $row)->getValue();
                $this->excel_data[$i]['id_caisse'] = $sheet->getCell('L' . $row)->getValue();

                $i++;
            }

            //  save data to database from excel using our array
            $data = $this->excel_data;
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
        session()->flash('message', 'les projets bien importer');

        } catch (Throwable $ex) {
            session()->flash('error', '', $ex);
            $this->dispatchBrowserEvent('close-model');

        }
        $this->dispatchBrowserEvent('close-model');





    }
    //  import project end


    public function render()
    {

        $this->bulkDisabled = count($this->selectedProjects) < 1;
        $projets = Projet::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('ville', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
        $bureaus = Bureau::all();
        $caisses = Caisse::all();
        return view('livewire.owner.project-section.projects-list', ['projets' => $projets, 'bureaus' => $bureaus, 'caisses' => $caisses]);

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


    // export data 
    public function export()
    {
        return Excel::download(new ProjectExport($this->selectedProjects), 'projects.xlsx');
    }

    public function pdfExport()
    {
     
        $projects = Projet::all();
        $pdf = "
        <!DOCTYPE html><html><head> <style>
       table {
        border-collapse: collapse;
        font-family: Tahoma, Geneva, sans-serif;
    }
    table td {
        padding: 15px;
    }
    th{
        background-color: #5f63f2;
        color: white;
        font-weight: bold;
        font-size: 16px;
        border: 1px solid #54585d;
        padding:10px;
    }
    table thead td {
        background-color: #54585d;
        color: #ffffff;
        font-weight: bold;
        font-size: 13px;
        border: 1px solid #54585d;
    }
    table tbody td {
        color: #636363;
        border: 1px solid #dddfe1;
    }
    table tbody tr {
        background-color: #f9fafb;
    }
    table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
       </style></head><body>
       <h2>Projects table:</h2>
        <table>
        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Date Début</th>
            <th>Date Fin</th>
            <th>Superfice</th>
            <th>Autorisation</th>
            <th>Titre finance</th>
            <th>Ville</th>
            <th>Consistance</th>
            <th>Caisse</th>
            <th>Bureau</th>
            <th>Adress</th>
        </tr> ";

        foreach ($projects as $project) {
            $pdf = $pdf . '<tr>
            <td>' . $project->id . '</td>
            <td>' . $project->name . '</td>
            <td>' . $project->datedebut . '</td>
            <td>' . $project->datefin . '</td>
            <td>' . $project->superfice . '</td>
            <td>' . $project-> autorisation. '</td>
            <td>' . $project-> titre_finance. '</td>
            <td>' . $project->ville . '</td>
            <td>' . $project->consistance . '</td>
            <td>' . $project->caisse->name . '</td>
            <td>' . $project->bureau->nom . '</td>
            <td>' . $project->adress . '</td>

            </tr> ';
        }

        $pdf .= '</table></body></html>';
        
        // $data = PDF::loadHtml($pdf);
        $file=PDF::loadHtml($pdf);
        // // (Optional) Setup the paper size and orientation
        $file->setPaper('A4', 'landscape');
        // // Render the HTML as PDF
        $file->render();
        return $file->stream('project.pdf');





    }
}