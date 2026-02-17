<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class ListaProductos extends Component
{
    public $search = '';
    public $category = 'todos';
    public $cart = [];
    public $products = [];

    public function mount()
    {
        $this->products = [
            ['id' => 1, 'name' => 'Silla Acojinada Blanca', 'price' => 15, 'category' => 'sillas', 'image' => 'imagenes/imagenes/1.jpeg'],
            ['id' => 2, 'name' => 'Silla Tiffany Dorada', 'price' => 25, 'category' => 'sillas', 'image' => 'imagenes/imagenes/2.jpeg'],
            ['id' => 3, 'name' => 'Mesa Tablón 2.4m', 'price' => 120, 'category' => 'mesas', 'image' => 'imagenes/imagenes/3.jpeg'],
            ['id' => 4, 'name' => 'Mesa Redonda 10 personas', 'price' => 150, 'category' => 'mesas', 'image' => 'imagenes/imagenes/4.jpg'],
            ['id' => 5, 'name' => 'Mantel Rectangular Blanco', 'price' => 45, 'category' => 'manteleria', 'image' => 'imagenes/imagenes/5.jpeg'],
            ['id' => 6, 'name' => 'Cubre Mantel de Color', 'price' => 25, 'category' => 'manteleria', 'image' => 'imagenes/imagenes/6.jpeg'],
            ['id' => 7, 'name' => 'Copa de Cristal Agua/Vino', 'price' => 8, 'category' => 'cristaleria', 'image' => 'imagenes/imagenes/7.jpeg'],
            ['id' => 8, 'name' => 'Plato Base Cuadrado', 'price' => 12, 'category' => 'cristaleria', 'image' => 'imagenes/imagenes/8.jpeg'],
        ];
    }

    public function addToCart($productId)
    {
        $product = collect($this->products)->firstWhere('id', $productId);

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            $this->cart[$productId] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
    }

    public function removeFromCart($productId)
    {
        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
            } else {
                unset($this->cart[$productId]);
            }
        }
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->reduce(function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function render()
    {
        $filteredProducts = collect($this->products)
            ->when($this->category !== 'todos', function ($collection) {
                return $collection->where('category', $this->category);
            })
            ->filter(function ($product) {
                return empty($this->search) || str_contains(strtolower($product['name']), strtolower($this->search));
            });

        return view('livewire.dashboard.lista-productos', [
            'filteredProducts' => $filteredProducts
        ]);
    }
}
