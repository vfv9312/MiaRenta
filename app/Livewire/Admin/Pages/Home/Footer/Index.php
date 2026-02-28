<?php

namespace App\Livewire\Admin\Pages\Home\Footer;

use App\Models\PageFooter;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $footer_id;
    public $title;
    public $title_two;
    public $description;
    public $button_text;
    public $button_link;
    public $button_text_two;
    public $button_link_two;

    public function mount()
    {
        $footer = PageFooter::first();
        if ($footer) {
            $this->footer_id = $footer->id;
            $this->title = $footer->title;
            $this->title_two = $footer->title_two;
            $this->description = $footer->description;
            $this->button_text = $footer->button_text;
            $this->button_link = $footer->button_link;
            $this->button_text_two = $footer->button_text_two;
            $this->button_link_two = $footer->button_link_two;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'title_two' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'button_text_two' => 'nullable|string|max:255',
            'button_link_two' => 'nullable|string|max:255',
        ]);

        $data = [
            'title' => $this->title,
            'title_two' => $this->title_two,
            'description' => $this->description,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
            'button_text_two' => $this->button_text_two,
            'button_link_two' => $this->button_link_two,
        ];

        DB::beginTransaction();
        try {
            // Buscamos si ya existe el registro para asegurarnos de no duplicar
            $footer = PageFooter::first();
            if ($footer) {
                $footer->update($data);
            } else {
                PageFooter::create($data);
            }
            session()->flash('message', 'Footer actualizado correctamente.');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th->getMessage());
            session()->flash('error', 'Error al actualizar el footer.');
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.home.footer.index');
    }
}
