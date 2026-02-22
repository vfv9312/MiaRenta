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
    public $subtitle;
    public $description;
    public $image;
    public $image_mobile;
    public $button_text;
    public $button_link;
    public $button_text_two;
    public $button_link_two;

    public $new_image;
    public $new_image_mobile;

    public function mount()
    {
        $footer = PageFooter::first();
        if ($footer) {
            $this->footer_id = $footer->id;
            $this->title = $footer->title;
            $this->subtitle = $footer->subtitle;
            $this->description = $footer->description;
            $this->image = $footer->image;
            $this->image_mobile = $footer->image_mobile;
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
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'new_image' => 'nullable|image|max:2048',
            'new_image_mobile' => 'nullable|image|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'button_text_two' => 'nullable|string|max:255',
            'button_link_two' => 'nullable|string|max:255',
        ]);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
            'button_text_two' => $this->button_text_two,
            'button_link_two' => $this->button_link_two,
        ];

        if ($this->new_image) {
            if ($this->image) {
                Storage::disk('public')->delete($this->image);
            }
            $data['image'] = $this->new_image->store('footer', 'public');
            $this->image = $data['image'];
            $this->new_image = null;
        }

        if ($this->new_image_mobile) {
            if ($this->image_mobile) {
                Storage::disk('public')->delete($this->image_mobile);
            }
            $data['image_mobile'] = $this->new_image_mobile->store('footer', 'public');
            $this->image_mobile = $data['image_mobile'];
            $this->new_image_mobile = null;
        }

        DB::beginTransaction();
        try {
            PageFooter::updateOrCreate(['id' => $this->footer_id], $data);
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
