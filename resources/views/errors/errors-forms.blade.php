@if (count($errors) > 0)
  <div class="alert alert-danger alert-dismissible fade show" role="alert" id="dangerAlert">
    <ul class="list-unstyled mb-0">
    @foreach ($errors->all() as $error)
      <li><i class="far fa-times-circle"></i> {{$error}}</li>
    @endforeach
    </ul>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
@endif
