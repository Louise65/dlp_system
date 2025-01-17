<!-- Modal -->
<div class="modal fade" id="logsDeleteModal" tabindex="-1" aria-labelledby="logsDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logsDeleteModalLabel">Delete Log</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="logsDeleteForm" id=logs-delete-form>
          <div class="form-row">
            <div class="row">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-name">Faculty Name</label>
                <input type="text" class="form-control" id="logs-delete-faculty-name" name="logsFacultyName" placeholder="Faculty Name" readonly>
              </div>
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-dlp">DLP No.</label>
                <input type="text" class="form-control" id="logs-delete-dlp" name="logsDLP" placeholder="DLP No." readonly>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-subject">Subject</label>
                <input type="text" class="form-control" id="logs-delete-subject" name="logsSubject" placeholder="Subject" maxlength="30" required>
              </div>
              <div class="form-group col-md-3">
                <label style="font-weight: bolder;" for="logs-subject-schedule">Subject Schedule</label>
                <input type="time" class="form-control" id="logs-delete-subject-schedule-start" name="logsSubjectScheduleStart" readonly>
              </div>
              <div class="form-group col-md-3">
                <label style="font-weight: bolder;" for="logs-subject-schedule"> </label>
                <input type="time" class="form-control" id="logs-delete-subject-schedule-end" name="logsSubjectScheduleEnd" readonly>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-name">Date Borrowed</label>
                <input type="date" class="form-control" id="logs-delete-date-borrowed" name="logsDateBorrowed" readonly>
              </div>
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-dlp">Time Borrowed</label>
                <input type="time" class="form-control" id="logs-delete-time-borrowed" name="logsTimeBorrowed" readonly>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label style="font-weight: bolder;" for="logs-dlp">Time Returned</label>
              <input type="time" class="form-control" id="logs-delete-time-returned" name="logsTimeReturned" readonly>
            </div>
            <div class="form-group col-md-12">
              <label style="font-weight: bolder;" for="logs-remarks">Remarks (Optional)</label>
              <textarea class="form-control" rows="5" id="logs-delete-remarks" name="logsRemarks" readonly></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="logs-delete-id" value="0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" onclick="deleteFromDatabase()">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function deleteData(delete_data) {
    // Fill form with data
    $('#logs-delete-faculty-name').val(delete_data.faculty_name);
    $('#logs-delete-dlp').val(delete_data.dlp_no);
    $('#logs-delete-date-borrowed').val(delete_data.date_borrowed);
    $('#logs-delete-time-borrowed').val(delete_data.time_borrowed);
    $('#logs-delete-subject').val(delete_data.subject);
    $('#logs-delete-subject-schedule-start').val(delete_data.subject_schedule_start);
    $('#logs-delete-subject-schedule-end').val(delete_data.subject_schedule_end);
    $('#logs-delete-time-returned').val(delete_data.time_returned);
    $('#logs-delete-remarks').val(delete_data.remarks);

    $('#logs-delete-id').val(delete_data.id);
    $('#logsDeleteModal').modal('show');
  }

  function deleteFromDatabase() {
    // Data to be sent to the database
    let input_data_arr = [
      document.getElementById('logs-delete-id').value,
    ]

    //send data to event handler
    fetch('./api/logsEventHandler.php', {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          request_type: 'deleteLogs',
          logs_data: input_data_arr
        }),
      })
      .then(response => response.json())
      .then(data => {
        if (data.status == 1) {
          logsTable.draw();

          $('#logsDeleteModal').modal('hide');
          $("#logs-delete-form")[0].reset();
          displayToastie("Log successfully deleted.", "#198754")
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