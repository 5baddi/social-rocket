<div class="modal modal-blur fade show" id="modal-password-{{ $user->id }}" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Reset password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
        </div>
        <form action="{{ route('admin.users.password.reset', ['user' => $user->id]) }}" method="POST">
          @csrf
          <div class="modal-body">
              <div>
                  <label class="form-label">New password</label>
                  <input type="password" name="password" class="form-control"/>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark">Reset</button>
          </div>
        </form>
      </div>
    </div>
</div>