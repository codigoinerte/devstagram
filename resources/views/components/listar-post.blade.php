
    <section class="container mx-auto mt-10">
        {{$slot}}
        @if ($posts->count())
                
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mx-5">
                @foreach ($posts as $post)
                
                    <div>
                        <a href="{{ route('posts.show', ['post' =>$post, 'user'=> $post->user]) }}">
                        <img src="{{ asset('uploads'). '/' .$post->imagen}}"   alt="Imagen del posts {{$post->titulo}}" />
                        </a>
                    </div>

                @endforeach
                </div>

            <div class="my-10">
                {{ $posts->links() }}
            </div>
                
        
        @else
            <p class="text-center">No hay posts, sigue a alguien para poder mostrar sus posts</p>
            
        @endif

    </section>
