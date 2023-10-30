@if (isset($errors) && count($errors) > 0)
    

 
    <ul class="list-group">
        @foreach ($errors->all() as $error )
   
          <li class="list-group-item list-group-item-danger mb-3"> {{$error}}</li> 
    
        @endforeach
    </ul>


    
@endif