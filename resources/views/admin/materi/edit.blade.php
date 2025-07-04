<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Edit Material: <span class="text-indigo-500">{{ Str::limit($materi->title, 30) }}</span>
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Make changes to the material details below.</p>
            </div>
            <div x-data="{ open: false }">
                <button @click="open = true" type="button"
                    class="inline-flex items-center gap-2 bg-red-100 dark:bg-red-500/10 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-500/20 font-semibold py-2 px-4 rounded-lg transition-colors">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.58.22-2.365.468a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193v-.443A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                            clip-rule="evenodd" />
                    </svg>
                    Delete Material
                </button>
                <div x-show="open" x-cloak x-transition :class="{'flex': open, 'hidden': !open}"
                    class="fixed inset-0 z-40 hidden items-center justify-center bg-black bg-opacity-50">
                    <div @click.away="open = false"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 max-w-md w-full">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Confirm Deletion</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Are you sure you want to permanently delete
                            the material <span class="font-semibold">"{{ $materi->title }}"</span>?</p>
                        <div class="mt-6 flex justify-end gap-4">
                            <button @click="open = false" type="button"
                                class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 rounded-lg">Cancel</button>
                            <form action="{{ route('admin.modul.materi.destroy', [$modul, $materi]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg">Yes,
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.modul.materi.update', [$modul, $materi]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Material
                                Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $materi->title) }}"
                                required
                                class="mt-1 block w-full text-lg font-semibold p-3 rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('title') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full
                                Description</label>
                            <textarea name="description" id="description" rows="10" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $materi->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Settings</h3>
                            {{-- Material Order --}}
                            <div class="mt-4">
                                <label for="urutan"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Material Order
                                </label>
                                <input type="number" name="urutan" id="urutan"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ old('urutan', $materi->urutan) }}" required min="1">
                                @error('urutan') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700"
                            x-data="{ showUploader: false }">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Material File</h3>
                            <div x-show="!showUploader" class="space-y-4">
                                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                    <div
                                        class="flex-shrink-0 bg-indigo-100 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 p-2 rounded-lg">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <a href="{{ Storage::url($materi->file_path) }}" target="_blank"
                                            class="text-sm font-semibold text-gray-800 dark:text-gray-200 hover:underline">{{ Str::limit(basename($materi->file_path), 25) }}</a>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Current file. Click to
                                            view.</p>
                                    </div>
                                </div>
                                <button @click="showUploader = true" type="button"
                                    class="w-full text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">Change
                                    File</button>
                            </div>
                            <div x-show="showUploader" x-cloak>
                                <div x-data="fileDrop()"
                                    class="relative flex flex-col items-center justify-center w-full p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg text-center cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors">
                                    <input type="file" name="file" id="file"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                        @change="handleFileSelect($event)">
                                    <div x-show="!fileName" class="z-10">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Drag new file here</p>
                                    </div>
                                    <div x-show="fileName"
                                        class="z-10 text-sm font-medium text-gray-800 dark:text-gray-200"
                                        x-text="fileName"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Leave empty if you don't want to change the current file.
                                </p>
                                <button @click="showUploader = false" type="button"
                                    class="mt-2 text-sm font-semibold text-gray-600 dark:text-gray-400 hover:underline">Cancel
                                    file change</button>
                                @error('file') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="fixed bottom-0 left-0 w-full bg-white dark:bg-gray-800/80 backdrop-blur-sm border-t border-gray-200 dark:border-gray-700 z-30">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-3">
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('admin.modul.materi.index', $modul) }}"
                                class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Cancel</a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-5 rounded-lg shadow-md transition-colors">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v4.59L7.28 9.53a.75.75 0 00-1.06 1.06l3.25 3.25a.75.75 0 001.06 0l3.25-3.25a.75.75 0 10-1.06-1.06L10.75 11.34V6.75z" clip-rule="evenodd" />
                                </svg>
                                Update Material
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function fileDrop() {
            return {
                dragging: false,
                fileName: '',
                fileSize: '',
                handleFileSelect(event) {
                    if (event.target.files.length > 0) {
                        this.fileName = event.target.files[0].name;
                        this.fileSize = this.formatBytes(event.target.files[0].size);
                    }
                },
                removeFile() {
                    const fileInput = document.getElementById('file');
                    fileInput.value = '';
                    this.fileName = '';
                    this.fileSize = '';
                },
                formatBytes(bytes, decimals = 2) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const dm = decimals < 0 ? 0 : decimals;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
                }
            }
        }
    </script>
</x-app-layout>