<?php 
// start_upload_score.php
include('../inc/config.php');
session_start();
if (empty($_SESSION['user_id'])) {
    header("Location: ../Auth/user_login");
  
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($app_name) ?> | Upload Scores</title>
  <?php include('partials/head.php'); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include('partials/navbar.php'); ?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include('partials/sidebar.php'); ?>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>Upload Student Scores</h1>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary shadow-sm">
          <div class="card-header">
            <h3 class="card-title">Step 1: Select Exam Details</h3>
          </div>
          <form id="scoreForm" method="GET" action="enter_scores.php">
            <div class="card-body">
              <div class="row">
                <!-- Left column -->
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Academic Session and Term</label>
                    <select name="session_term_id" class="form-control" required>
                      <option value="">-- Select Session and Term --</option>
                      <?php
                      $stmt = $dbh->query("SELECT * FROM academic_session WHERE school_id = '$school_id'");
                      while ($sessionTerm = $stmt->fetch()):
                      ?>
                      <option value="<?= (int)$sessionTerm['id'] ?>"><?= htmlspecialchars($sessionTerm['session'] . ' - ' . $sessionTerm['term']) ?>
                      </option>
                      <?php endwhile; ?>
                    </select>
                    </div>

                   
                  <div class="form-group">
                    <label>Exam Type</label>
                    <select name="exam_type" class="form-control" required>
                      <option value="">-- Select Exam --</option>
                      <?php
                      $stmt = $dbh->query("SELECT id, exam_name FROM exams WHERE school_id = '$school_id'");
                      while ($exam = $stmt->fetch()):
                      ?>
                        <option value="<?= (int)$exam['id'] ?>"><?= htmlspecialchars($exam['exam_name']) ?></option>
                      <?php endwhile; ?>
                    </select>
                  </div>
                </div>

                <!-- Right column -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Class</label>
                    <select id="class_id" name="class_id" class="form-control" required>
                      <option value="">-- Select Class --</option>
                      <?php
                      $stmt = $dbh->query("SELECT id, name, section FROM classes WHERE school_id = '$school_id'");
                      while ($cls = $stmt->fetch()):
                      ?>
                        <option value="<?= (int)$cls['id'] ?>"><?= htmlspecialchars($cls['name'] . ' ' . $cls['section']) ?>
                        </option>
                      <?php endwhile; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Subject</label>
                    <select id="subject_id" name="subject_id" class="form-control" required>
                      <option value="">-- Select Subject --</option>
                      <!-- options will be loaded via AJAX -->
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-success float-right">
                <i class="fas fa-arrow-right"></i> Continue
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

  <?php include('partials/footer.php'); ?>
</div>
<?php include('partials/bottom-script.php'); ?>

<script>
// When Class changes, fetch subjects for this teacher+class
document.getElementById('class_id').addEventListener('change', function() {
  const classId = this.value;
  const subjSelect = document.getElementById('subject_id');
  subjSelect.innerHTML = '<option>Loading...</option>';

  fetch(`get_subjects.php?class_id=${encodeURIComponent(classId)}`)
    .then(res => res.json())
    .then(data => {
      subjSelect.innerHTML = '<option value="">-- Select Subject --</option>';
      if (data.length === 0) {
        subjSelect.innerHTML += '<option disabled>No subjects assigned</option>';
      } else {
        data.forEach(s => {
          const opt = document.createElement('option');
          opt.value = s.id;
          opt.textContent = s.name;
          subjSelect.appendChild(opt);
        });
      }
    })
    .catch(err => {
      console.error(err);
      subjSelect.innerHTML = '<option disabled>Error loading subjects</option>';
    });
});
</script>
</body>
</html>
