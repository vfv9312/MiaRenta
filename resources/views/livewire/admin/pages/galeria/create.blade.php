<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-black text-gray-900 dark:text-white">
            Nueva <span class="text-red-600">Imagen</span>
        </h2>
    </div>

    <div x-data="{ photoName: null, photoPreview: null }" class="space-y-8">
        <!-- Image Upload Section -->
        <div class="w-full">
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-4 uppercase tracking-wider">
                Fotografía
            </label>

            <!-- Hidden File Input -->
            <input type="file" class="hidden" x-ref="photo"
                x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => { photoPreview = e.target.result; };
                    reader.readAsDataURL($refs.photo.files[0]);
                ">

            <!-- Upload Placeholder -->
            <div class="mt-2" x-show="!photoPreview">
                <div @click="$refs.photo.click()"
                    class="flex flex-col items-center justify-center pt-10 pb-12 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 border-gray-300 dark:border-gray-600 hover:border-red-500 dark:hover:border-red-500 transition-all duration-300 group">
                    <div
                        class="p-4 rounded-full bg-gray-100 dark:bg-gray-600 group-hover:bg-red-50 dark:group-hover:bg-red-900/30 transition-colors mb-4">
                        <svg class="w-10 h-10 text-gray-400 group-hover:text-red-600 transition-colors"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                    </div>
                    <p class="mb-2 text-lg text-gray-500 dark:text-gray-400 font-medium"><span
                            class="font-bold text-red-600">Haz clic para subir</span> o arrastra y suelta</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">SVG, PNG, JPG o GIF (Max. 10MB)</p>
                </div>
            </div>

            <!-- Image Preview -->
            <div class="mt-2 relative group" x-show="photoPreview" style="display: none;">
                <div
                    class="aspect-video w-full rounded-2xl overflow-hidden shadow-2xl ring-4 ring-white dark:ring-gray-700">
                    <span
                        class="block w-full h-full bg-cover bg-center transition-transform duration-700 hover:scale-105"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <!-- Remove Button -->
                <button type="button"
                    class="absolute top-4 right-4 bg-red-600 text-white p-2 rounded-full shadow-lg hover:bg-red-700 transition-all transform hover:scale-110 focus:outline-none ring-4 ring-white dark:ring-gray-800 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 duration-300"
                    @click="photoPreview = null; photoName = null; $refs.photo.value = ''">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- File Name Badge -->
                <div class="absolute bottom-4 left-4">
                    <span
                        class="px-3 py-1 bg-black/70 backdrop-blur-md text-white text-xs font-bold rounded-full border border-white/20"
                        x-text="photoName"></span>
                </div>
            </div>
        </div>

        <!-- Title Input -->
        <div>
            <label for="title"
                class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 uppercase tracking-wider">Título de
                la Imagen</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <input type="text" id="title"
                    class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-4 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 transition-all font-medium"
                    placeholder="Ej. Decoración Vintage para Bodas" required>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end pt-6 border-t border-gray-100 dark:border-gray-700">
            <button type="button"
                class="px-6 py-3 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-500 dark:focus:ring-gray-700 transition-all mr-3">
                Cancelar
            </button>
            <button type="button"
                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-bold rounded-xl text-sm px-8 py-3 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 shadow-lg shadow-red-500/30 transition-all transform hover:-translate-y-0.5">
                Guardar Imagen
            </button>
        </div>
    </div>
</div>
