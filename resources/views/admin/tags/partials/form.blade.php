<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el Nombre de la Eiqueta']) !!}

    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class'=>'form-control','placeholder'=>'Ingrese el Slug de la Etiqueta','readonly']) !!}

    @error('slug')
    <span class="text-danger">{{$message}}</span>
@enderror
</div>

<div class="form-group">
  
    {{-- <label for="color" class="mt-2">Color</label>
    <select class="form-select form-control " name="color" id="color">
        <option value="" selected>Seleccione Color</option>
        <option value="dsada">azul</option>
        <option value="red">Rojo</option>
    </select>

    @error('color')
    <span class="text-danger">{{$message}}</span>
    @enderror --}}
    {!! Form::label('color', 'Color') !!}
    {!! Form::select('color', $colors,null, ['class'=>'form-control']) !!}
</div>