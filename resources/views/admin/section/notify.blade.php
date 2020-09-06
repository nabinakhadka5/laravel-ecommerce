@if(session('success'))
   <p>
     <div class="alert alert-success" role="alert">
       <button class="close">x</button>
        {{session('success')}}
     </div>
   </p>
@endif

@if(session('error'))
   <div class="alert alert-danger" role="alert">
     <button class="close">x</button>
      {{session('error')}}
   </div>
@endif

@if(session('warning'))
   <div class="alert alert-danger" role="alert">
       <button class="close">x</button>
        {{session('error')}}
   </div>
@endif