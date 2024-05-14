@include('layouts/app')

<section class="search">
    <form action="{{route('photo.index')}}" method="post">
        @csrf
        @method('post')
        <input type="text" name="search-value">
        <input type="submit" value="search">
    </form>
    <a href="{{route('photo.index')}}">back</a>
</section>
<main>
    @foreach ($photos as $photo)
    <section class="container">
        <img class="small-img" src="/img/{{$photo->data}}" alt="no image :(">
        <div>
            <p>{{$photo->data}}</p>
            <p>{{$photo->description}}</p>
            <form action="{{route('photo.delete', [$photo->id])}}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this permanently?')">
            </form>
        </div>
    </section>
    @endforeach
</main>