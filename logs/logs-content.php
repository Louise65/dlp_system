<div class="col py-3">
  <h3>Logs List</h3>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-success" data-bs-toggle="modal" onclick="addData()">
    <span class="bi bi-plus"></span> Add Log
  </button>

  <!-- Modularity -->

  <?php
  include('logs-add.php');
  ?>

  <?php
  include('logs-table.php');
  ?>

  <?php
  include('logs-view.php');
  ?>
  <?php
  include('logs-update.php');
  ?>
  <?php
  include('logs-delete.php');
  ?>
</div>