<!-- Modal -->
<div class="modal fade" id="logsViewModal" tabindex="-1" aria-labelledby="logsViewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logsViewModalLabel">View Log</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="logsViewForm" id=logs-view-form>
          <div class="form-row">
            <div class="row">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-name">Faculty Name</label>
                <input type="text" class="form-control" id="logs-view-faculty-name" name="logsFacultyName" placeholder="Faculty Name" readonly>
              </div>
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-dlp">DLP No.</label>
                <input type="text" class="form-control" id="logs-view-dlp" name="logsDLP" placeholder="DLP No." readonly>
              </div>
            </div>
            <div class="row">
              <div class=" form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-subject">Subject</label>
                <input type="text" class="form-control" id="logs-view-subject" name="logsSubject" placeholder="Subject" maxlength="30" readonly>
              </div>
              <div class="form-group col-md-3">
                <label style="font-weight: bolder;" for="logs-subject-schedule">Subject Schedule</label>
                <input type="time" class="form-control" id="logs-view-subject-schedule-start" name="logsSubjectScheduleStart" readonly>
              </div>
              <div class="form-group col-md-3">
                <label style="font-weight: bolder;" for="logs-subject-schedule"> </label>
                <input type="time" class="form-control" id="logs-view-subject-schedule-end" name="logsSubjectScheduleEnd" readonly>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-name">Date Borrowed</label>
                <input type="date" class="form-control" id="logs-view-date-borrowed" name="logsDateBorrowed" readonly>
              </div>
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-dlp">Time Borrowed</label>
                <input type="time" class="form-control" id="logs-view-time-borrowed" name="logsTimeBorrowed" readonly>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label style="font-weight: bolder;" for="logs-dlp">Time Returned</label>
              <input type="time" class="form-control" id="logs-view-time-returned" name="logsTimeReturned" readonly>
            </div>
            <div class="form-group col-md-12">
              <label style="font-weight: bolder;" for="logs-remarks">Remarks (Optional)</label>
              <textarea class="form-control" rows="5" id="logs-view-remarks" name="logsRemarks" readonly></textarea>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label style="font-weight: bolder;" for="logs-datetime-added">Date and time added</label>
              <input type="text" class="form-control" id="logs-view-datetime-added" name="logsDateTimeAdded" readonly>
            </div>
            <div class="form-group col-md-6">
              <label style="font-weight: bolder;" for="logs-datetime-modified">Date and time last modified</label>
              <input type="text" class="form-control" id="logs-view-datetime-modified" name="logsDateTimeModified" readonly>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="logs-view-id" value="0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function viewData(view_data) {
    // Fill form with data
    $('#logs-view-faculty-name').val(view_data.faculty_name);
    $('#logs-view-dlp').val(view_data.dlp_no);
    $('#logs-view-date-borrowed').val(view_data.date_borrowed);
    $('#logs-view-time-borrowed').val(view_data.time_borrowed);
    $('#logs-view-subject').val(view_data.subject);
    $('#logs-view-subject-schedule-start').val(view_data.subject_schedule_start);
    $('#logs-view-subject-schedule-end').val(view_data.subject_schedule_end);
    $('#logs-view-time-returned').val(view_data.time_returned);
    $('#logs-view-remarks').val(view_data.remarks);

    $('#logs-view-datetime-added').val(view_data.date_added);
    $('#logs-view-datetime-modified').val(view_data.date_modified);

    $('#logs-view-id').val(view_data.id);
    $('#logsViewModal').modal('show');
  }
</script>