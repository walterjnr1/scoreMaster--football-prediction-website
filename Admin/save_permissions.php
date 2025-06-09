<?php 
include('../inc/config.php');

if (empty($_SESSION['user_id'])) {
  header("Location: ../Auth/user_login");
  //exit;
}

$selected_role = $_POST['role'] ?? '';
$selected_permissions = $_POST['permissions'] ?? [];

// Handle form submission
if (isset($_POST['btnsave'])) {
    if (!empty($selected_role) && !empty($selected_permissions)) {
        // Delete old permissions
        $delete = $dbh->prepare("DELETE FROM permissions WHERE role = ? AND school_id = ?");
        $delete->execute([$selected_role, $school_id]);

        $stmt = $dbh->prepare("INSERT INTO permissions (school_id, role, module, permission_type, can_access) VALUES (?, ?, ?, ?, ?)");

        foreach ($selected_permissions as $module => $actions) {
            foreach ($actions as $permission_type => $can_access) {
                $stmt->execute([$school_id, $selected_role, $module, $permission_type, 1]);
            }
        }
          //activity log
              $operation = "Created permission on $current_date";
              log_activity($conn, $school_id, $user_id,$role, $operation, $ip_address);

        $_SESSION['success'] = "Permissions updated successfully!";
    } else {
        $_SESSION['error'] = "Please select a role and assign at least one permission.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $app_name; ?> | Save Permissions</title>
  <?php include('partials/head.php'); ?>
  <script>
    function toggleSelectAll(source) {
      const checkboxes = document.querySelectorAll('input[type="checkbox"]');
      checkboxes.forEach(cb => cb.checked = source.checked);
    }
  </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include('partials/navbar.php'); ?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include('partials/sidebar.php'); ?>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1>Save Permissions</h1>
        
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Set Permissions</h3>
              </div>

              <form action="" method="POST">
                <div class="card-body">

                  <div class="form-group">
                    <label for="role">Select Role</label>
                    <select name="role" class="form-control" required>
                      <option value="">-- Select Role --</option>
                      <option value="Teacher">Teacher</option>
                     <option value="Admin">Admin</option>


                    </select>
                  </div>

                  <label>Assign Permissions:</label>
                  <div class="mb-2">
                    <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"> <label for="selectAll">Select All</label>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                      <thead>
                        <tr>
                          <th>Module</th>
                          <th>Create</th>
                          <th>Read</th>
                          <th>Update</th>
                          <th>Delete</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $modules = [
                          'dashboard','account management', 'add user', 'user record', 'change password',  'profile',
                          'class management', 'add class', 'class record','assign subject class', 'teacher management', 'teacher record', 'assign teacher to class',
                          'grade setup', 'add grade', 'grade record', 'session Management','create session', 'session record', 'subject management', 'add subject', 'subject record',
                          'subject allocation', 'subject allocation record','subject assignment record', 'payment record','result management', 'result record','upload scores', 'score record', 'student management', 'register student','student record','assign student to class', 
                          'scratch card management','scratch card record','permission management','add permission','permission record','promotion management','promotion','exam management',
                          'add exam','exam record','school setting','activity log','report management','student report','teacher report','class report','subject report','result report','score report','database backup'
                        ];

                        $all_permissions = ['create', 'read', 'update', 'delete'];

                        foreach ($modules as $module):
                        ?>
                        <tr>
                          <td><?php echo (str_replace('_', ' ', $module)); ?></td>
                          <?php foreach ($all_permissions as $perm): ?>
                            <td>
                              <input 
                                type="checkbox" 
                                name="permissions[<?php echo $module; ?>][<?php echo $perm; ?>]" 
                                value="1"
                                <?php
                                  if (isset($selected_permissions[$module][$perm])) echo 'checked';
                                ?>
                              >
                            </td>
                          <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" name="btnsave" class="btn btn-primary">Save Permissions</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

  <footer class="main-footer">
    <strong><?php include('partials/footer.php'); ?></strong>
  </footer>

</div>

<?php include('partials/bottom-script.php'); ?>
</body>
</html>
