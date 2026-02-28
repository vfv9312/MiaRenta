<?php

namespace App\Livewire\Admin\Pages\Us;

use App\Helpers\Utility;
use App\Models\PageNosotros;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithFileUploads;

    public $item_id;

    public $banner_title, $banner_subtitle;

    public $history_title, $history_text, $history_image, $new_history_image, $history_stat_number, $history_stat_text;

    public $mission_text, $vision_text;

    // Values stored as an array, but managed in simple inputs (we'll keep up to 3 for now matching the view)
    public $value_1_title, $value_1_desc;
    public $value_2_title, $value_2_desc;
    public $value_3_title, $value_3_desc;

    public $cta_title, $cta_button_text, $cta_button_url;

    protected $rules = [
        'banner_title' => 'required|string|max:255',
        'banner_subtitle' => 'required|string',
        'history_title' => 'required|string|max:255',
        'history_text' => 'required|string',
        'new_history_image' => 'nullable|image|max:2048',
        'history_stat_number' => 'nullable|string|max:255',
        'history_stat_text' => 'nullable|string|max:255',
        'mission_text' => 'required|string',
        'vision_text' => 'required|string',
        'value_1_title' => 'required|string|max:255',
        'value_1_desc' => 'required|string|max:255',
        'value_2_title' => 'required|string|max:255',
        'value_2_desc' => 'required|string|max:255',
        'value_3_title' => 'required|string|max:255',
        'value_3_desc' => 'required|string|max:255',
        'cta_title' => 'required|string|max:255',
        'cta_button_text' => 'required|string|max:255',
        'cta_button_url' => 'required|string|max:255',
    ];

    public function mount()
    {
        $page = PageNosotros::first();
        if ($page) {
            $this->item_id = $page->id;

            $this->banner_title = $page->banner_title;
            $this->banner_subtitle = $page->banner_subtitle;

            $this->history_title = $page->history_title;
            $this->history_text = $page->history_text;
            $this->history_image = $page->history_image;
            $this->history_stat_number = $page->history_stat_number;
            $this->history_stat_text = $page->history_stat_text;

            $this->mission_text = $page->mission_text;
            $this->vision_text = $page->vision_text;

            if ($page->values_list && is_array($page->values_list)) {
                $this->value_1_title = $page->values_list[0]['title'] ?? '';
                $this->value_1_desc = $page->values_list[0]['desc'] ?? '';
                $this->value_2_title = $page->values_list[1]['title'] ?? '';
                $this->value_2_desc = $page->values_list[1]['desc'] ?? '';
                $this->value_3_title = $page->values_list[2]['title'] ?? '';
                $this->value_3_desc = $page->values_list[2]['desc'] ?? '';
            }

            $this->cta_title = $page->cta_title;
            $this->cta_button_text = $page->cta_button_text;
            $this->cta_button_url = $page->cta_button_url;
        } else {
            // Default Values from the blade view provided
            $this->banner_title = "Nuestra Historia";
            $this->banner_subtitle = "Más de una década llevando elegancia y compromiso a cada rincón de Tuxtla Gutiérrez.";

            $this->history_title = "Mía Renta: Una Tradición en Excelencia";
            $this->history_text = "Nacimos hace más de una década en el corazón de **Tuxtla Gutiérrez**...";
            $this->history_stat_number = "+10";
            $this->history_stat_text = "Años creando memorias inolvidables en Tuxtla.";

            $this->mission_text = "Proveer mobiliario de alta gama y servicios excepcionales que faciliten la realización de eventos espectaculares, superando siempre las expectativas de nuestros clientes.";
            $this->vision_text = "Ser la empresa líder en renta de mobiliario en Chiapas, reconocida por nuestra innovación constante, elegancia en diseños y compromiso inquebrantable con la excelencia.";

            $this->value_1_title = "Integridad";
            $this->value_1_desc = "Trato honesto.";
            $this->value_2_title = "Calidad";
            $this->value_2_desc = "Equipo impecable.";
            $this->value_3_title = "Cercanía";
            $this->value_3_desc = "De Tuxtla para Tuxtla.";

            $this->cta_title = "Sé parte de nuestra historia";
            $this->cta_button_text = "Explora nuestro mobiliario";
            $this->cta_button_url = "/#servicios";
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'banner_title' => $this->banner_title,
            'banner_subtitle' => $this->banner_subtitle,
            'history_title' => $this->history_title,
            'history_text' => $this->history_text,
            'history_stat_number' => $this->history_stat_number,
            'history_stat_text' => $this->history_stat_text,
            'mission_text' => $this->mission_text,
            'vision_text' => $this->vision_text,
            'values_list' => [
                ['title' => $this->value_1_title, 'desc' => $this->value_1_desc],
                ['title' => $this->value_2_title, 'desc' => $this->value_2_desc],
                ['title' => $this->value_3_title, 'desc' => $this->value_3_desc],
            ],
            'cta_title' => $this->cta_title,
            'cta_button_text' => $this->cta_button_text,
            'cta_button_url' => $this->cta_button_url,
        ];

        DB::beginTransaction();
        try {
            if ($this->new_history_image) {
                if ($this->history_image) {
                    // Remove 'storage/' prefix to get the correct relative path for the public disk
                    $pathToDelete = str_replace('storage/', '', $this->history_image);
                    Storage::disk('public')->delete($pathToDelete);
                }
                $data['history_image'] = Utility::saveFile($this->new_history_image, 'nosotros');
            }

            PageNosotros::updateOrCreate(
                ['id' => $this->item_id],
                $data
            );

            DB::commit();
            session()->flash('message', 'Página actualizada correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th->getMessage());
            session()->flash('error', 'Ocurrió un error al actualizar la página.');
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.us.index');
    }
}
