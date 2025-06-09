    
    <?php
$user_role = $row_user['role'];

// Fetch permissions based on role
$sql_permissions = "SELECT * FROM permissions WHERE role = '$user_role' AND school_id = '$school_id' AND can_access = 1";
$permissions_result = $conn->query($sql_permissions);
$permissions = [];
while ($row = $permissions_result->fetch_assoc()) {
    $module = $row['module'];
    $permission_type = $row['permission_type'];
    
    if (!isset($permissions[$module])) {
        $permissions[$module] = [];
    }
    $permissions[$module][$permission_type] = (bool) $row['can_access'];
      }

    ?>    
     
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
    <img src="../<?php echo $app_logo; ?>" alt="app Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 100px; height: 200px;">
      <span class="brand-text font-weight-light"><?php echo $app_name; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php if (!empty($permissions['dashboard']['read'])): ?>      
                       <li class="nav-item">
         <a href="index" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
               </a>
             </li>
            <?php endif; ?>
                   <?php if (!empty($permissions['account management']['read']) ): ?>      
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Account Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['add user']['create']) ): ?>      

              <li class="nav-item">
                <a href="add_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New User</p>
                </a>
              </li>
              <?php endif ?>
              <?php if (!empty($permissions['user record']['read']) ): ?>      

              <li class="nav-item">
                <a href="user_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Record</p>
                </a>
              </li>
              <?php endif ?>
                <li class="nav-item">
                <a href="change_password" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <?php if (!empty($permissions['profile']['read']) ): ?>      

              <li class="nav-item">
                <a href="profile" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <?php endif ?> 

            </ul>
          </li>
                <?php endif ?> 
                <?php if (!empty($permissions['class management']['read']) ): ?>      

  <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-chalkboard"></i> 
      <p>
        Class Management
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
    <?php if (!empty($permissions['add class']['create']) ): ?>      

      <li class="nav-item">
        <a href="add_class" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>New Class</p>
        </a>
      </li>
  <?php  endif ?>
  <?php if (!empty($permissions['assign subject class']['create']) ): ?>      

<li class="nav-item">
  <a href="add_assign_subject_class" class="nav-link">
    <i class="far fa-circle nav-icon"></i>
    <p>Assign subject to Class</p>
  </a>
</li>
<?php  endif ?>
  <?php if (!empty($permissions['class record']['read']) ): ?>      

      <li class="nav-item">
        <a href="class_record" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Class Record</p>
        </a>
      </li>
      <?php  endif ?>
      <?php if (!empty($permissions['subject assignment record']['read']) ): ?>      

<li class="nav-item">
  <a href="subject_assignment_record" class="nav-link">
    <i class="far fa-circle nav-icon"></i>
    <p>Subject Assignment Record</p>
  </a>
</li>
<?php  endif ?>
    </ul>
  </li>
  <?php endif ?>
  <?php if (!empty($permissions['teacher management']['read'])): ?>      

       <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chalkboard"></i> 
              <p>
               Teacher Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['teacher management']['read'])): ?>      

              <li class="nav-item">
                <a href="teacher_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teacher Record</p>
                </a>
              </li>
              <?php endif ?>
              <?php if (!empty($permissions['assign teacher to class']['create']) ): ?>      

              <li class="nav-item">
                <a href="add_assign_teacher" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Teacher to class</p>
                </a>
              </li>
              <?php  endif ?>
            </ul>
          </li>
              <?php endif ?>
          <?php if ( !empty($permissions['grade setup']['read'])): ?>      

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-award"></i> 
              <p>
               Grade Setup
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['grade setup']['create']) ): ?>      

              <li class="nav-item">
                <a href="add_grade" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Grade</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['grade record']['create']) ): ?>      

              <li class="nav-item">
                <a href="grade_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grade Record</p>
                </a>
              </li>
              <?php endif ?>
            </ul>
          </li>
      <?php endif ?>
      <?php if ( !empty($permissions['session Management']['read'])): ?>      

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Session Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['create session']['create']) ): ?>      

              <li class="nav-item">
                <a href="add_session" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Session</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['session record']['read']) ): ?>      

              <li class="nav-item">
                <a href="session_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Session Record</p>
                </a>
              </li>
              <?php  endif ?>

            </ul>
          </li>
          <?php endif ?>
          <?php if (!empty($permissions['subject management']['read'])): ?>      

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i> 
              <p>
                Subject Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['add subject']['create']) ): ?>      

              <li class="nav-item">
                <a href="add_subject" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Subject</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['subject record']['create']) ): ?>      

              <li class="nav-item">
                <a href="subject_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject Record</p>
                </a>
              </li>
              <?php  endif ?>

              <?php if (!empty($permissions['subject allocation']['create']) ): ?>      

              <li class="nav-item">
                <a href="add_subject_allocation" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject Allocation</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['subject allocation record']['read']) ): ?>      
              <li class="nav-item">

                <a href="subject_allocation_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject Allocation Record</p>
                </a>
              </li>
              <?php  endif ?>
            </ul>
          </li>
        <?php endif ?>
          <?php if (!empty($permissions['result management']['create'])): ?>      

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-upload"></i>
              <p>Result Management<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['upload scores']['create']) ): ?>      

              <li class="nav-item">
                <a href="start_upload_score" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Scores</p>
                </a>
              </li>
              <?php endif ?>
              <?php if (!empty($permissions['result record']['read']) ): ?>      
         
              <li class="nav-item">
                <a href="score_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Score Record</p>
                </a>
              </li>
              <?php  endif ?>
  
              <li class="nav-item">
                <a href="result_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Result Summary</p>
                </a>
              </li>
            </ul>
          </li>

         <?php endif ?>
        <?php if (!empty($permissions['promotion management']['create'])): ?>      

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-upload"></i>
              <p>Promotion Management<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
            
              <?php if (!empty($permissions['promotion']['create']) ): ?>      
              <li class="nav-item">
                <a href="promotion" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promotion </p>
                </a>
              </li>
              <?php  endif ?>
              
              <li class="nav-item">
                <a href="promotion_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promotion Record</p>
                </a>
              </li>
            </ul>
          </li>

         <?php endif ?>
         <?php if (!empty($permissions['student management']['read'])): ?>      

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-graduation-cap"></i> 
              <p>Student Management<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
               <?php if (!empty($permissions['register student']['create']) ): ?>      

              <li class="nav-item">
                <a href="register_student" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register Student</p>
                </a>
              </li>
              <?php  endif ?>
            <?php if (!empty($permissions['student record']['read']) ): ?>      

              <li class="nav-item">
                <a href="student_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Record</p>
                </a>
              </li>
              <?php  endif ?>

              <?php if (!empty($permissions['assign student to class']['create']) ): ?>      
              <li class="nav-item">
                <a href="add_assign_student" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Student to class</p>
                </a>
              </li>
              <?php  endif ?>
              </ul>
          </li>
          <?php endif ?>
          <?php if (!empty($permissions['scratch card management']['read'])): ?>      

        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-id-card"></i>
            <p>Scratch Card Management<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
         
              <?php if (!empty($permissions['scratch card record']['create'])): ?>      

              <li class="nav-item">
                <a href="scratch_card_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Scratch Card Record</p>
                </a>
              </li>
              <?php endif ?>

              </ul>
          </li>
         <?php endif ?>
         <?php if (!empty($permissions['permission management']['read']) || $user_role === 'Admin'): ?>      
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shield-alt"></i>
            <p>Permission Management<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['add permission']['create'])|| $user_role === 'Admin'): ?>      
              <li class="nav-item">
                <a href="save_permissions" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Permissions</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['permission record']['read']) ): ?>      

              <li class="nav-item">
                <a href="permission_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permissions Record</p>
                </a>
              </li>
              <?php  endif ?>
              </ul>
          </li>
        <?php endif ?>

            <?php if (!empty($permissions['exam management']['create'])): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-pen-alt"></i>  
              <p>Exam Management<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['add exam']['create']) ): ?>
              <li class="nav-item">
                <a href="add_exam" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Exam</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['exam record']['read']) ): ?>      

              <li class="nav-item">
                <a href="exams_record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Record</p>
                </a>
              </li>
              <?php  endif ?>
              </ul>
             </li>
            <?php endif ?>
            <?php if (!empty($permissions['payment record']['read']) ): ?>

          <li class="nav-item">
            <a href="payment_record" class="nav-link">
            <i class="nav-icon fas fa-dollar-sign"></i> 
              <p>
                Payment Records
              </p>
            </a>
          </li>
          <?php endif ?>

            <?php if (!empty($permissions['school setting']['create']) || !empty($permissions['school setting']['read'])): ?>

          <li class="nav-item">
            <a href="update_school" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i> 
              <p>
                School Settings
              </p>
            </a>
          </li>
          <?php endif ?>
          <?php if (!empty($permissions['activity log']['create']) || !empty($permissions['activity log']['read'])): ?>

          <li class="nav-item">
            <a href="activity_log" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i> 
              <p>
                Activity Log
              </p>
            </a>
          </li>
    <?php endif ?>

    <?php if (!empty($permissions['database backup']['create'])): ?>

<li class="nav-item">
  <a href="backup_db" class="nav-link">
  <i class="nav-icon fas fa-database"></i> 
    <p>Database Backup</p>
  </a>
</li>
        <?php endif ?>
        <?php if (!empty($permissions['report management']['create'])): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>  
              <p>Report Management<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (!empty($permissions['student report']['create']) ): ?>
              <li class="nav-item">
                <a href="student_report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['teacher report']['read']) ): ?>      

              <li class="nav-item">
                <a href="teacher_report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teacher</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['class report']['read']) ): ?>      

              <li class="nav-item">
                <a href="class_report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['subject report']['read']) ): ?>      

              <li class="nav-item">
                <a href="subject_report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject</p>
                </a>
              </li>
              <?php  endif ?>
              <?php if (!empty($permissions['result report']['read']) ): ?>      

              <li class="nav-item">
                <a href="result_report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Result</p>
                </a>
              </li>
              <?php  endif ?>
               <?php if (!empty($permissions['score report']['read']) ): ?>      

              <li class="nav-item">
                <a href="score_report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Scores</p>
                </a>
              </li>
              <?php  endif ?>
              </ul>
             </li>
            <?php endif ?>

          <li class="nav-item">
            <a href="logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>

              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
