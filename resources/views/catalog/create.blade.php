<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-white">
                <div class="p-6 text-center text-2xl font-bold">
                    Add a movie
                </div>
                <div class="p-6">
                    <form action="{{url("/catalog/store/")}}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium">Title</label>
                            <input type="text" value="{{old("title")}}" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 bg-gray-700 text-white">
                        </div>
                        @error("title")
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="year" class="block text-sm font-medium">Year</label>
                            <input type="text" value="{{old("year")}}" name="year" id="year" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 bg-gray-700 text-white">
                        </div>
                        @error('year')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="director" class="block text-sm font-medium">Director</label>
                            <input type="text" value="{{old("director")}}" name="director" id="director" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 bg-gray-700 text-white">
                        </div>
                        @error('director')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="poster" class="block text-sm font-medium">Poster</label>
                            <input type="text" value="{{old("poster")}}" name="poster" id="poster" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 bg-gray-700 text-white">
                        </div>error("title")
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error('poster')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div>
                            <label for="synopsis" class="block text-sm font-medium">Synopsis</label>
                            <textarea name="synopsis" id="synopsis" rows="3" class="mt-1 block w-full rounded-md border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 bg-gray-700 text-white">{{old("synopsis")}}</textarea>
                        </div>
                        @error('synopsis')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="px-12 py-2 bg-indigo-500 hover:bg-indigo-700 text-white font-bold rounded-md focus:outline-none focus:ring focus:ring-indigo-300">
                                Add movie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
