@if ($errors->isNotEmpty())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  @foreach ($errors->get($name) as $error)
  <strong>{{ $error }}</strong>
  @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif