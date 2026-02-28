<?php

namespace App\Livewire\Admin\Pages\Home\Banner;

use App\Helpers\Utility;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\carousel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $items;
    public $carousel_id;
    public $titulo;
    public $descripcion;
    public $imagen;
    public $new_imagen;
    public $boton_texto;
    public $boton_url;
    public $boton_texto_two;
    public $boton_url_two;
    public $activo = true;
    public $isOpen = false;

    public function mount()
    {
        $this->loadItems();
    }
    //cargar valor del carrusel
    public function loadItems()
    {
        $this->items = carousel::whereIn('activo', [1, 2])->get();
    }
    //abrir modal
    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }
    //Editar
    public function edit($id)
    { //doy los valores que tenia
        $carousel = carousel::findOrFail($id);
        $this->carousel_id = $id;
        $this->titulo = $carousel->titulo;
        $this->descripcion = $carousel->descripcion;
        $this->imagen = $carousel->imagen;
        $this->boton_texto = $carousel->boton_texto;
        $this->boton_url = $carousel->boton_url;
        $this->boton_texto_two = $carousel->boton_texto_two;
        $this->boton_url_two = $carousel->boton_url_two;
        $this->activo = $carousel->activo == 1  ? true : false;
        //abro el modal
        $this->isOpen = true;
    }
    //guardar
    public function store()
    {
        $this->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'boton_texto' => 'nullable',
            'boton_url' => 'nullable',
            'boton_texto_two' => 'nullable',
            'boton_url_two' => 'nullable',
            'new_imagen' => $this->carousel_id ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $data = [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'boton_texto' => $this->boton_texto,
            'boton_url' => $this->boton_url,
            'boton_texto_two' => $this->boton_texto_two,
            'boton_url_two' => $this->boton_url_two,
            'activo' => $this->activo ? 1 : 2,
        ];

        if ($this->new_imagen) {
            //$imagePath = $this->new_imagen->store('carousel', 'public');
            $data['imagen'] = Utility::saveFile($this->new_imagen, 'carousel');
            // $data['imagen'] = $imagePath;
        }
        DB::beginTransaction();
        try {

            carousel::updateOrCreate(['id' => $this->carousel_id], $data);
            session()->flash('message', $this->carousel_id ? 'Slide actualizado.' : 'Slide creado.');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th->getMessage());
            session()->flash('error', 'Error al actualizar el slide.');
        }

        $this->closeModal();
        $this->loadItems();
    }
    //elimminar banner
    public function delete($id)
    {
        carousel::find($id)->update(['activo' => 3]);
        session()->flash('message', 'Slide eliminado.');
        $this->loadItems();
    }
    //Cerrar Modal
    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }
    //resetear valores del modal
    private function resetInputFields()
    {
        $this->carousel_id = null;
        $this->titulo = '';
        $this->descripcion = '';
        $this->imagen = '';
        $this->new_imagen = null;
        $this->boton_texto = '';
        $this->boton_url = '';
        $this->boton_texto_two = '';
        $this->boton_url_two = '';
        $this->activo = true;
    }

    public function render()
    {
        return view('livewire.admin.pages.home.banner.index');
    }
}
