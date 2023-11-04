
<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Nombre del Post']) !!}
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, [
        'class' => 'form-control',
        'placeholder' => 'Ingrese Nombre del Slug',
        'readonly'
    ]) !!}
    @error('slug')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categoría:') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    @error('category_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <p class="font-weight-bold">Etiquetas:</p>

    @foreach ($tags as $tag)
        <label class="mr-2">
            {{-- in_array($tag->id,[1,4]) para que en vez de null pongas eso --}}
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{ $tag->name }}
        </label>
    @endforeach



    @error('tags')
        <br>
        <span class="text-danger">{{ $message }}</span>
    @enderror

    @error('tags.*')
    <br>
    <span class="text-danger">{{ $message }}</span>
@enderror

</div>


<div class="form-group">
    <p class="font-weight-bold">Estado:</p>

    <label for="status1">
        {!! Form::radio('status', 1, true) !!}
        Borrador

    </label>

    <label for="status2">
        {!! Form::radio('status', 2) !!}
        Publicado
    </label>

    @error('status')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset($post->image)
            <img id="picture" src="{{Storage::url($post->image->url)}}"
            alt="">
            @else
            <img id="picture" src="https://cdn.pixabay.com/photo/2023/10/21/11/46/sunset-8331285_1280.jpg"
            alt="">
            @endisset
        
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrará en el Post') !!}


            <div class="row">

                <label for="file" class="btn btn-primary mr-2 ">Subir Imagen</label>
                <label><button class="btn btn-danger mr-2" id="eliminar-img">Eliminar Imagen
                        personalizada</button></label>
            </div>


            {!! Form::file('file', ['class' => 'form-control-file', 'hidden','accept'=>'image/*']) !!}
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere nobis, hic possimus debitis,
                libero enim fugiat saepe provident voluptates vel id illum ipsam laudantium corporis dolorem eos
                aspernatur? Perferendis, ea.</p>

                @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror   

        </div>
    </div>
</div>


<div class="form-group">
    {!! Form::label('extract', 'Extracto:') !!}
    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

    @error('extract')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('body', 'Cuerpo del Post:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

    @error('body')
        <span class="text-danger">{{ $message }}</span>
    @enderror

</div>