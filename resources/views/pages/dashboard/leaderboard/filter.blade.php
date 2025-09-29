<div class="row">
  <div class="col-md-6">
    <div class="d-sm-flex align-items-end">
      <div class="me-3" style="width: 100%">
        <label for="start_date">Search</label>
        <div class="input-group">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" id="custom_search" class="form-control" placeholder="Search by title or email">
        </div>
      </div>

      <div class="me-3" style="width: 100%">
        <label for="start_date">Group</label>
        <div class="input-group">
          <select name="search_group" id="search_group" class="form-control" placeholder="Search by group">
            <option value="all">All</option>
            <option value="running">Running</option>
            <option value="music">Music</option>
            <option value="gym">Gym</option>
          </select>
        </div>
      </div>

      <button type="button" id="reset" class="btn btn-secondary mb-0">Reset</button>
    </div>
  </div>
</div>
