<div class="row justify-content-between">
  <div class="col-md-6">
    <div class="d-sm-flex align-items-end">
      <div class="me-3" style="width: 100%">
        <label for="start_date">Search</label>
        <div class="input-group">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" id="custom_search" class="form-control" placeholder="Search by title">
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="col-md-3">
    <div class="d-sm-flex justify-content-end">
      <a href="/dashboard/activity-submit/create" class="btn btn-icon btn-3 btn-primary">
        <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
        <span class="btn-inner--text">Add new activity-submit</span>
      </a>
    </div>
  </div> -->
  <div class="col-md-6">
    <div class="d-sm-flex align-items-end justify-content-end">
      <div class="me-3">
        <label for="start_date">Start Date</label>
        <input type="text" id="start_date" placeholder="From Date" class="form-control datepicker">
      </div>
      <div class="me-3">
        <label for="end_date">End Date</label>
        <input type="text" id="end_date" placeholder="To Date" class="form-control datepicker">
      </div>
      <button type="button" id="filter" class="btn btn-primary mb-0 me-3">Filter</button>
      <button type="button" id="reset" class="btn btn-secondary mb-0">Reset</button>
    </div>
  </div>
</div>
