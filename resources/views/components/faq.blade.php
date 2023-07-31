<form action="{{ route('admin.faqs.store') }}" method="POST">
  @csrf
  <div class="modal fade" id="add-faqModal" aria-labelledby="add-faqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add-faqModalLabel">Add Faq</h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              Question :
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-sm-12">
              <input type="text" name="title" class="form-control" autocomplete="off" id="q-title">
              @include('layouts.error', ['name' => 'title'])
            </div>
          </div>
          <hr>
          Answer :
          <div class="row mt-3">
            <div class="col-sm-12">
              <input type="text" name="text" class="form-control" autocomplete="off" id="q-text">
              @include('layouts.error', ['name' => 'text'])
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light rounded-pill q-cancel" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary rounded-pill">Add Faq</button>
        </div>
      </div>
    </div>
  </div>
</form>