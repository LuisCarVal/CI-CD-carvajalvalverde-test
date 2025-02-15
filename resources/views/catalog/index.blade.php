<x-app-layout>
    <div class="pt-8 flex  flex-wrap justify-center gap-4 text-white ">

        @foreach( $movies as $movie )
            <div class="col-xs-6 col-sm-4 col-md-3 text-center">

                <a href="{{ url('/catalog/show/'. $movie["id"]) }}">
                    <img src="{{$movie['poster']}}"  class="w-[200px] h-[300px] object-cover rounded-md block"/>
                    <h4 class="min-height:45px;margin:5px 0 10px 0 font-bold">
                        {{$movie->title}}
                    </h4>
                </a>

            </div>
        @endforeach
    </div>
</x-app-layout>
