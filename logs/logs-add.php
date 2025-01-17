<!-- Modal -->
<div class="modal fade" id="logsAddModal" tabindex="-1" aria-labelledby="logsAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logsAddModalLabel">Add New Logs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="logsAddForm" id=logs-add-form>
          <div class="form-row">
            <div class="row" style="margin: 10px;">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-name">Faculty Name</label>
                <input type="text" class="form-control" id="logs-add-faculty-name" name="logsFacultyName" placeholder="Faculty Name" maxlength="50" required>
              </div>
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-dlp">DLP No.</label>
                <input type="text" class="form-control" id="logs-add-dlp" name="logsDLP" placeholder="DLP No." maxlength="10" required>
              </div>
            </div>
            <div class="row" style="margin: 10px;">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-name">Date Borrowed</label>
                <input type="date" class="form-control" id="logs-add-date-borrowed" name="logsDateBorrowed" required>
              </div>
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-dlp">Time Borrowed</label>
                <input type="time" class="form-control" id="logs-add-time-borrowed" name="logsTimeBorrowed" required>
              </div>
            </div>
            <div class="row" style="margin: 10px;">
              <div class="form-group col-md-6">
                <label style="font-weight: bolder;" for="logs-subject">Subject</label>
                <input type="text" class="form-control" id="logs-add-subject" name="logsSubject" placeholder="Subject" maxlength="30" required>
              </div>
              <div class="form-group col-md-3">
                <label style="font-weight: bolder;" for="logs-subject-schedule">Subject Schedule</label>
                <input type="time" class="form-control" id="logs-add-subject-schedule-start" name="logsSubjectScheduleStart" required>
              </div>
              <div class="form-group col-md-3">
                <label style="font-weight: bolder;" for="logs-subject-schedule"> </label>
                <input type="time" class="form-control" id="logs-add-subject-schedule-end" name="logsSubjectScheduleEnd" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="addToDatabase()">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function addData() {
    // Initialize form
    var date = new Date();
    var currentDate = date.toISOString().slice(0, 10);
    var currentTime = date.getHours() + ':' + date.getMinutes();

    $('#logs-add-faculty-name').val('');
    $('#logs-add-dlp').val('');
    $('#logs-add-date-borrowed').val(currentDate);
    $('#logs-add-time-borrowed').val(currentTime);
    $('#logs-add-subject').val('');
    $('#logs-add-subject-schedule-start').val('');
    $('#logs-add-subject-schedule-end').val('');

    $('#logsAddModal').modal('show');
  }

  function addToDatabase() {
    // Data to be sent to the database
    let input_data_arr = [
      document.getElementById('logs-add-faculty-name').value,
      document.getElementById('logs-add-dlp').value,
      document.getElementById('logs-add-date-borrowed').value,
      document.getElementById('logs-add-time-borrowed').value,
      document.getElementById('logs-add-subject').value,
      document.getElementById('logs-add-subject-schedule-start').value,
      document.getElementById('logs-add-subject-schedule-end').value,
    ]

    console.log(input_data_arr);

    //send data to event handler
    fetch('./api/logsEventHandler.php', {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          request_type: 'addLogs',
          logs_data: input_data_arr
        }),
      })
      .then(response => response.json())
      .then(data => {
        if (data.status == 1) {
          logsTable.draw();

          $('#logsAddModal').modal('hide');
          $("#logs-add-form")[0].reset();
          displayToastie("Log successfully added.", "#198754")
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