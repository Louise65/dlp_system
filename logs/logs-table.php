<div class="table-responsive">
  <table border="0" cellspacing="5" cellpadding="5">
    <tbody>
      <tr>
        <td>Set date:</td>
        <td><input type="date" id="set-date" name="setDate"></td>
      </tr>
    </tbody>
  </table>
  <table id="log-table" class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Faculty Name</th>
        <th scope="col">DLP No.</th>
        <th scope="col" class="text-center">Date Borrowed</th>
        <th scope="col" class="text-center">Time Borrowed</th>
        <th scope="col" class="text-center">Time Returned</th>
        <th scope="col" class="text-center" style="width: 20%">Action</th>
      </tr>
    </thead>
    <tbody id="logs_data">
    </tbody>
  </table>
</div>

<script>
  //datatables
  var logsTable = $('#log-table').DataTable({
    ajax: './api/fetch_logs.php',
    columns: [{
        'data': 'faculty_name',
        responsivePriority: 1
      },
      {
        'data': 'dlp_no',
        responsivePriority: 1
      },
      {
        'data': 'date_borrowed',
        responsivePriority: 2
      },
      {
        'data': 'time_borrowed',
        responsivePriority: 3
      },
      {
        'data': 'time_returned',
        responsivePriority: 3
      },
      {
        'data': 'actions',
        responsivePriority: 1
      },
    ],
    processing: true,
    serverSide: true,
    responsive: true
  });

  $(document).ready(function() {
    // Draw the table
    logsTable.draw();
  });

  let currentDate = new Date().toJSON().slice(0, 10);

  document.addEventListener('DOMContentLoaded', function() {
    $('#set-date').val(currentDate);
  }, false);

  $(document).ready(function() {
    logsTable.search(currentDate).draw();
  })

  //change table result on change of date
  $('#set-date').on('change', function() {
    logsTable.search(this.value).draw();
  });
</script>