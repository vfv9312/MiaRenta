<?php

namespace App\Livewire\Admin\Pages\Home\Catalog;

use Livewire\Component;
use App\Models\PageCatalag;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    //Titulo inicio
    public $catalog_id;
    public $title, $subtitle;

    // Card 1
    public $icon_one, $title_button_one, $text_button_one, $button_url_one, $status_one;
    // Card 2
    public $icon_two, $title_button_two, $text_button_two, $button_url_two, $status_two;
    // Card 3
    public $icon_three, $title_button_three, $text_button_three, $button_url_three, $status_three;
    // Card 4
    public $icon_four, $title_button_four, $text_button_four, $button_url_four, $status_four;
    //validacion
    protected $rules = [
        'title' => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'icon_one' => 'required|string',
        'title_button_one' => 'required|string',
        'text_button_one' => 'required|string',
        'button_url_one' => 'required|string',
        'icon_two' => 'required|string',
        'title_button_two' => 'required|string',
        'text_button_two' => 'required|string',
        'button_url_two' => 'required|string',
        'icon_three' => 'required|string',
        'title_button_three' => 'required|string',
        'text_button_three' => 'required|string',
        'button_url_three' => 'required|string',
        'icon_four' => 'required|string',
        'title_button_four' => 'required|string',
        'text_button_four' => 'required|string',
        'button_url_four' => 'required|string',
    ];
    //montar datos
    public function mount()
    { //revisar si existe el registro
        $catalog = PageCatalag::first();

        if ($catalog) {
            $this->catalog_id = $catalog->id;
            $this->title = $catalog->title;
            $this->subtitle = $catalog->subtitle;

            $this->icon_one = $catalog->icon;
            $this->title_button_one = $catalog->title_button_one;
            $this->text_button_one = $catalog->text_button_one;
            $this->button_url_one = $catalog->button_url_one;
            $this->status_one = (bool)$catalog->status_one;

            $this->icon_two = $catalog->icon_two;
            $this->title_button_two = $catalog->title_button_two;
            $this->text_button_two = $catalog->text_button_two;
            $this->button_url_two = $catalog->button_url_two;
            $this->status_two = (bool)$catalog->status_two;

            $this->icon_three = $catalog->icon_three;
            $this->title_button_three = $catalog->title_button_three;
            $this->text_button_three = $catalog->text_button_three;
            $this->button_url_three = $catalog->button_url_three;
            $this->status_three = (bool)$catalog->status_three;

            $this->icon_four = $catalog->icon_four;
            $this->title_button_four = $catalog->title_button_four;
            $this->text_button_four = $catalog->text_button_four;
            $this->button_url_four = $catalog->button_url_four;
            $this->status_four = (bool)$catalog->status_four;
        } else {
            // valores por defecto si no existe el registro
            $this->title = 'Nuestro Catálogo';
            $this->subtitle = 'Todo lo que necesitas para que tu evento sea inolvidable, con el respaldo de Mía Renta.';

            $this->icon_one = 'fas fa-chair';
            $this->title_button_one = 'Sillas';
            $this->text_button_one = 'Modelos Tiffany, madera y acojinadas. Confort y elegancia.';
            $this->button_url_one = '#';
            $this->status_one = true;

            $this->icon_two = 'fas fa-table';
            $this->title_button_two = 'Mesas';
            $this->text_button_two = 'Variedad en tamaños y formas para cualquier cantidad de invitados.';
            $this->button_url_two = '#';
            $this->status_two = true;

            $this->icon_three = 'fas fa-scroll';
            $this->title_button_three = 'Mantelería';
            $this->text_button_three = 'Colores y texturas que realzan la estética de tu celebración.';
            $this->button_url_three = '#';
            $this->status_three = true;

            $this->icon_four = 'fas fa-glass-martini-alt';
            $this->title_button_four = 'Cristalería';
            $this->text_button_four = 'Detalles premium en vasos y copas para un brindis perfecto.';
            $this->button_url_four = '#';
            $this->status_four = true;
        }
    }
    //guardar datos
    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        try {

            //actualizar o crear registro
            PageCatalag::updateOrCreate(
                ['id' => $this->catalog_id],
                [
                    'title' => $this->title,
                    'subtitle' => $this->subtitle,

                    'icon' => $this->icon_one,
                    'title_button_one' => $this->title_button_one,
                    'text_button_one' => $this->text_button_one,
                    'button_url_one' => $this->button_url_one,
                    'status_one' => $this->status_one,

                    'icon_two' => $this->icon_two,
                    'title_button_two' => $this->title_button_two,
                    'text_button_two' => $this->text_button_two,
                    'button_url_two' => $this->button_url_two,
                    'status_two' => $this->status_two,

                    'icon_three' => $this->icon_three,
                    'title_button_three' => $this->title_button_three,
                    'text_button_three' => $this->text_button_three,
                    'button_url_three' => $this->button_url_three,
                    'status_three' => $this->status_three,

                    'icon_four' => $this->icon_four,
                    'title_button_four' => $this->title_button_four,
                    'text_button_four' => $this->text_button_four,
                    'button_url_four' => $this->button_url_four,
                    'status_four' => $this->status_four,
                ]
            );
            DB::commit();
            session()->flash('message', 'Catálogo actualizado correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th->getMessage());
            session()->flash('error', 'Error al actualizar el catálogo');
        }
    }

    public function render()
    {
        return view('livewire.admin.pages.home.catalog.index');
    }
}
