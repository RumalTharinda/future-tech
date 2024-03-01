  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?= SYSTEM_PATH ?>index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      
      <!--  Product Nav -->

      <!--  End Product Nav -->
      
      
       <!--  Stock Nav -->

      <!-- End Stock Nav -->
      
      
      <!--  User Product Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Employee-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Employee</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Employee-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>Employee/view.php">
              <i class="bi bi-person"></i><span>View Employee</span>
            </a>
          </li>
          
          <li>
            <a href="<?= SYSTEM_PATH ?>Employee/add.php">
              <i class="bi bi-person-plus"></i><span>Manage Employee</span>
            </a>
          </li>
        </ul>
      </li><!-- End User Nav -->
      
      <!--  Brands Nav -->

      <!-- End Brands Nav -->
      
      <!--  Category Nav -->

      <!-- End Category Nav -->
      
      <!--  Supplier Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Supplier-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Supplier-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>supplier/view.php">
              <i class="bi bi-person-fill"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>supplier/add.php">
              <i class="bi bi-person-plus-fill"></i><span>Manage</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Supplier Nav -->
      
      <!--  Courier Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Courier-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>Courier</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Courier-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>courier/view.php">
              <i class="bi bi-person-fill"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>courier/add.php">
              <i class="bi bi-person-plus-fill"></i><span>Manage</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End courier Nav -->
      
       <!--  Customer Nav -->
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#customer-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Customer</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="customer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>customer/view.php">
              <i class="bi bi-person"></i><span>View Customer</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Customer Nav -->
      
      <!--  User Nav -->
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>User Accounts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>user/view_employee_user_acc.php">
              <i class="bi bi-person"></i><span>View Employee User Accounts</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>user/manage_employee_user_acc.php">
              <i class="bi bi-person-check"></i><span>Manage Employee User Accounts</span>
            </a>
          </li>
           <li>
            <a href="<?= SYSTEM_PATH ?>user/view_customer_user_acc.php">
              <i class="bi bi-person"></i><span>View Customer User Accounts</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>user/manage_customer_user_acc.php">
              <i class="bi bi-person-check"></i><span>Manage Customer User Accounts</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End User Nav -->
      
       <!--  Order Nav -->

      <!-- End Order Nav -->
      
       <!--  Payment Nav -->

      <!-- End Payment Nav -->
      
        <!--  Report Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard-check-fill"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="report-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>Report/Sales.php">
              <i class="bi bi-cash-stack"></i><span>sales</span>
            </a>
          </li>
           <li>
            <a href="<?= SYSTEM_PATH ?>Report/Waiting_Orders.php">
              <i class="bi bi-cash-stack"></i><span>Waiting Orders</span>
            </a>
          </li>
           <li>
            <a href="<?= SYSTEM_PATH ?>Report/today.php">
              <i class="bi bi-cash-stack"></i><span>Today's Report</span>
            </a>
          </li>
         
          
        </ul>
      </li><!-- End Report Nav -->
      

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= SYSTEM_PATH ?>blog/blog.php">
          <i class="bi bi-file-earmark"></i>
          <span>Blog</span>
        </a>
      </li><!-- End Blog Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= SYSTEM_PATH ?>message/manage.php">
          <i class="bi bi-envelope"></i>
          <span>Message</span>
        </a>
      </li><!-- End Message Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= SYSTEM_PATH ?>banner/banner.php">
          <i class="bi bi-image"></i>
          <span>Banner</span>
        </a>
      </li><!-- End Banner Page Nav -->

      

      

      

     

    </ul>

  </aside><!-- End Sidebar-->