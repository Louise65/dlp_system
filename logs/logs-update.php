<!-- Modal -->
<div class="modal fade" id="logsUpdateModal" tabindex="-1" aria-labelledby="logsUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logsUpdateModalLabel">Update Log</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="logsUpdateForm" id=logs-update-form>
          <div class="form-row">
            <div class="row">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-name">Faculty Name</label>
                <input type="text" class="form-control" id="logs-update-faculty-name" name="logsFacultyName" placeholder="Faculty Name" maxlength="50" readonly>
              </div>
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-dlp">DLP No.</label>
                <input type="text" class="form-control" id="logs-update-dlp" name="logsDLP" placeholder="DLP No." maxlength="10" readonly>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-subject">Subject</label>
                <input type="text" class="form-control" id="logs-update-subject" name="logsSubject" placeholder="Subject" maxlength="30" required>
              </div>
              <div class="form-group col-md-3">
                <label style="font-weight: bolder;" for="logs-subject-schedule">Subject Schedule</label>
                <input type="time" class="form-control" id="logs-update-subject-schedule-start" name="logsSubjectScheduleStart" readonly>
              </div>
              <div class="form-group col-md-3">
                <label style="font-weight: bolder;" for="logs-subject-schedule"> </label>
                <input type="time" class="form-control" id="logs-update-subject-schedule-end" name="logsSubjectScheduleEnd" readonly>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-name">Date Borrowed</label>
                <input type="date" class="form-control" id="logs-update-date-borrowed" name="logsDateBorrowed" readonly>
              </div>
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-dlp">Time Borrowed</label>
                <input type="time" class="form-control" id="logs-update-time-borrowed" name="logsTimeBorrowed" required>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label style="font-weight: bolder;" for="logs-dlp">Time Returned</label>
              <input type="time" class="form-control" id="logs-update-time-returned" name="logsTimeReturned" required>
            </div>
            <div class="form-group col-md-12">
              <label style="font-weight: bolder;" for="logs-remarks">Remarks (Optional)</label>
              <textarea class="form-control" rows="5" id="logs-update-remarks" name="logsRemarks" maxlength="255"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="logs-update-id" value="0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="updateToDatabase()">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function editData(update_data) {
    // Fill form with data
    $('#logs-update-faculty-name').val(update_data.faculty_name);
    $('#logs-update-dlp').val(update_data.dlp_no);
    $('#logs-update-date-borrowed').val(update_data.date_borrowed);
    $('#logs-update-time-borrowed').val(update_data.time_borrowed);
    $('#logs-update-subject').val(update_data.subject);
    $('#logs-update-subject-schedule-start').val(update_data.subject_schedule_start);
    $('#logs-update-subject-schedule-end').val(update_data.subject_schedule_end);
    $('#logs-update-time-returned').val(update_data.time_returned);
    $('#logs-update-remarks').val(update_data.remarks);

    $('#logs-update-id').val(update_data.id);
    $('#logsUpdateModal').modal('show');
  }

  function updateToDatabase() {
    // Data to be sent to the database
    let input_data_arr = [
      document.getElementById('logs-update-time-borrowed').value,
      document.getElementById('logs-update-time-returned').value,
      document.getElementById('logs-update-remarks').value,
      document.getElementById('logs-update-id').value,
    ]

    //send data to event handler
    fetch('./api/logsEventHandler.php', {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          request_type: 'editLogs',
          logs_data: input_data_arr
        }),
      })
      .then(response => response.json())
      .then(data => {
        if (data.status == 1) {
          logsTable.draw();

          $('#logsUpdateModal').modal('hide');
          $("#logs-update-form")[0].reset();

          displayToastie("Log successfully updated.", "#198754")
        } else {
          console.log(data.error);
          displayToastie(data.error, "#dc3545")
        }
      })
      .catch(console.error);
  }

  function displayToastie(text, color) {
    Toastify({
      text: (text).toString(),
      duration: 3000,
      newWindow: true,
      close: true,
      gravity: "bottom",
      position: "right",
      stopOnFocus: true,
      style: {
        background: color,
      },
      onClick: function() {}
    }).showToast();
  }
</script>