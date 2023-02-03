<?php

namespace App\Http\Livewire\ProjectSection;

use App\Imports\ProjetsImport;
use Illuminate\Database\QueryException;
use Livewire\Component;
use App\Models\Projet;
use App\Models\Bureau;
use App\Models\Caisse;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;
use File;

class ProjectsList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $dated, $datef, $autorisation, $superfice, $image, $consistance, $adress, $ville, $titre_finance, $project_edit_id, $id_bureau, $id_caisse;
    public $exelFile;
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
            'image' => 'image|max:3024',
            'ville' => 'required',
            'datef' => 'required|date',
            'dated' => 'required|date',
            'id_bureau' => 'required|integer',
            'id_caisse' => 'required|integer',
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
        $this->$this->project_edit_id = "";
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

         
        try {
            $path = Storage::disk('local')->url($this->image);
            File::delete(public_path($path));
            $projet = Projet::where('id', $this->project_edit_id)->first();
            $projet->delete();
            $this->resetInputs();
            session()->flash('message', 'projet bien supprimer');
            $this->dispatchBrowserEvent('add');
            $this->dispatchBrowserEvent('close-model');
        } catch (QueryException $e) {
            session()->flash('error', 'Id of project is used  as foringKey in other tables ');
        }

    }
    public function deleteSelected()
    {


        $id = [];
        $deleted = [];
        $projects = Projet::query()->whereIn('id', $this->selectedProjects)->get();
        foreach ($projects as $project) {
            try {
                $project = Projet::where('id', $project->id)->first();
                $project->delete();
                $path = Storage::disk('local')->url($project->image);
                File::delete(public_path($path));
                $deleted[] = $project->id;
            } catch (QueryException $ex) {
                $id[] = $project->id;
            }
        }
        if (count($deleted) > 0) {
            session()->flash('message', "Deleted seccesfully Projects of Id=[" . implode(",", $deleted) . "]");
        }
        if (count($id) > 0) {
            session()->flash('error', "Can't delete Domaines of Id=[" . implode(",", $id) . "] Because is Used as ForeignKey ");
        }
        $this->selectedProjects = $id;
        $this->selectAll = false;
        $id = [];
        $deleted = [];

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
        // $path = file_get_contents($tt);

        $path = $this->exelFile->store('', 'app');
        Excel::import(new ProjetsImport($this->exelFile, $path), $path);
        session()->flash('message', 'projet bien imposter');


    }
    //  import project end


    public function render()
    {

        $this->bulkDisabled = count($this->selectedProjects) < 1;
        $projets = Projet::orderBy($this->sortname, $this->sortdrection)->paginate($this->pages, ['*'], 'new');
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
}