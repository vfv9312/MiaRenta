<form wire:submit.prevent="update">
    <div class="container px-4 mx-auto"></div>
    <div class="grid w-full gap-4 mb-6 md:grid-cols-2">
        <div> <label class="block mb-2 text-sm font-medium dark:text-gray-400" for="names">Nombres
                @include('partials.required')
            </label>
            <input wire:model.lazy="names" id="names"
                class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded dark:text-gray-400 dark:border-gray-900 dark:bg-gray-800"
                type="text" name="" placeholder="Juan Antonio">
            @include('partials.message', ['input' => 'names'])
        </div>
        <div> <label class="block mb-2 text-sm font-medium dark:text-gray-400" for="surnames">Apellidos
                @include('partials.required')
            </label>
            <input wire:model.lazy="surnames" id="surnames"
                class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded dark:text-gray-400 dark:border-gray-900 dark:bg-gray-800"
                type="text" name="" placeholder="Perez Lopez">
            @include('partials.message', ['input' => 'surnames'])
        </div>
    </div>
    <div class="grid w-full gap-4 mb-6 md:grid-cols-2">
        <div> <label class="block mb-2 text-sm font-medium dark:text-gray-400" for="email">Correo
                @include('partials.required')
            </label>
            <input wire:model.lazy="email" id="email"
                class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded dark:text-gray-400 dark:border-gray-900 dark:bg-gray-800"
                type="text" name="" placeholder="test@test.com">
            @include('partials.message', ['input' => 'email'])
        </div>
        <div> <label class="block mb-2 text-sm font-medium dark:text-gray-400" for="roleId">Rol
                @include('partials.required')
            </label>
            <div class="relative">
                <select wire:model.lazy="roleId"
                    class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded appearance-none dark:text-gray-400 dark:border-gray-900 dark:bg-gray-800"
                    id="roleId">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach

                </select>
                <div
                    class="absolute inset-y-0 right-0 flex items-center px-2 text-xl text-gray-500 pointer-events-none">
                    <i class="w-4 h-4 fill-current bi bi-chevron-down"></i>
                </div>
            </div>
            @include('partials.message', ['input' => 'roleId'])
        </div>
    </div>

    <div class="mt-7">
        <div class="flex justify-start space-x-2">
            <button type="submit"
                class="inline-block px-4 py-2 text-xs font-medium leading-tight text-white bg-blue-500 rounded shadow-md hover:bg-blue-600">Guardar</button>
            <a href="{{ route('users.index') }}"
                class="inline-block px-4 py-2 text-xs font-medium leading-tight text-white bg-red-500 rounded shadow-md hover:bg-red-600">Regresar</a>
        </div>
    </div>
    {{-- @include('partials.error-alert') --}}
</form>
