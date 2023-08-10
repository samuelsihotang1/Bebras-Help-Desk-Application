@if ($errors->isNotEmpty())
@foreach ($errors->get($name) as $error)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{ $error }}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endforeach
@endif