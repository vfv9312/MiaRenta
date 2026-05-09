<?php

namespace App\Livewire\Admin\Pages\Home\Galery;

use App\Helpers\Utility;
use App\Models\PublicGallery;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $public_gallery_id;
    public $title, $subtitle, $description, $type = 'paquetes', $image;
    public $isEdit = false;
    public $showDeleteModal = false;
    //reglas de validacion
    protected $rules = [
        'title' => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'type' => 'required|in:paquetes,sillas,mesas,manteleria,cristaleria,decoracion,fundas,inflables,otros',
        'image' => 'nullable|image|max:2048', // 2MB Max
    ];
    //metodo render
    public function render()
    {
        //obtener todas las imagenes de la galeria
        $publicGalleries = PublicGallery::latest()->get();
        return view('livewire.admin.pages.home.galery.index', compact('publicGalleries'));
    }
    //metodo para resetear los campos
    public function resetFields()
    {
        $this->reset(['public_gallery_id', 'title', 'subtitle', 'description', 'type', 'image', 'isEdit']);
    }


    //metodo para guardar la imagen
    public function store()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'type' => $this->type,
        ];

        if ($this->image) {
            $data['path'] = Utility::saveFile($this->image, 'gallery');
        }
        DB::beginTransaction();
        try {

            PublicGallery::create($data);
            DB::commit();
            $this->resetFields();
            session()->flash('message', 'Imagen agregada con éxito.');
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th->getMessage());
            session()->flash('message', 'Error al agregar la imagen.');
        }
    }
    //metodo para editar la imagen
    public function edit($id)
    {
        $gallery = PublicGallery::findOrFail($id);
        $this->public_gallery_id = $id;
        $this->title = $gallery->title;
        $this->subtitle = $gallery->subtitle;
        $this->description = $gallery->description;
        $this->type = $gallery->type;
        $this->isEdit = true;
    }
    //metodo para actualizar la imagen
    public function update()
    {
        $this->validate();

        $gallery = PublicGallery::findOrFail($this->public_gallery_id);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'type' => $this->type,
        ];

        if ($this->image) {
            // Eliminar imagen anterior si existe
            if ($gallery->path) {
                if (str_starts_with($gallery->path, 'storage/')) {
                    $pathToDelete = str_replace('storage/', '', $gallery->path);
                    Storage::disk('public')->delete($pathToDelete);
                } else {
                    if (\Illuminate\Support\Facades\File::exists(public_path($gallery->path))) {
                        \Illuminate\Support\Facades\File::delete(public_path($gallery->path));
                    }
                }
            }
            $data['path'] = Utility::saveFile($this->image, 'gallery');
        }
        DB::beginTransaction();
        try {

            $gallery->update($data);
            DB::commit();
            $this->resetFields();
            session()->flash('message', 'Imagen actualizada con éxito.');
            $this->isEdit = false;
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th->getMessage());
            session()->flash('message', 'Error al actualizar la imagen.');
        }
    }
    //metodo para eliminar la imagen
    public function delete($id)
    {
        $gallery = PublicGallery::findOrFail($id);
        if ($gallery->path) {
            if (str_starts_with($gallery->path, 'storage/')) {
                $pathToDelete = str_replace('storage/', '', $gallery->path);
                Storage::disk('public')->delete($pathToDelete);
            } else {
                if (\Illuminate\Support\Facades\File::exists(public_path($gallery->path))) {
                    \Illuminate\Support\Facades\File::delete(public_path($gallery->path));
                }
            }
        }
        $gallery->delete();
        $this->showDeleteModal = false;
        $this->public_gallery_id = null;
        session()->flash('message', 'Imagen eliminada con éxito.');
    }

    public function confirmDelete($id)
    {
        $this->showDeleteModal = true;
        $this->public_gallery_id = $id;
    }
}
