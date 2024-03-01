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

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Products-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Products-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>product/view.php">
              <i class="bi bi-bag-fill"></i><span>View Products</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>product/add.php">
              <i class="bi bi-bag-plus"></i><span>Manage Products</span>
            </a>
          </li>
          
          
        </ul>
      </li><!--  End Product Nav -->
      
      
       <!--  Stock Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Stock-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide-fill"></i><span>Stock</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Stock-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>stock/view.php">
              <i class="bi bi-bag-fill"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>stock/add.php">
              <i class="bi bi-bag-plus-fill"></i><span>Manage</span>
            </a>
          </li>
        
        </ul>
      </li><!-- End Stock Nav -->
      
      
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

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Brands-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-list"></i><span>Brands</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Brands-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>Brands/view.php">
              <i class="bi bi-list-nested"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>Brands/add.php">
              <i class="bi bi-list-nested"></i><span>Manage</span>
            </a>
          </li>
         
        </ul>
      </li><!-- End Brands Nav -->
      
      <!--  Category Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Category-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-list"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Category-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>category/view.php">
              <i class="bi bi-list-nested"></i><span>View</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>category/add.php">
              <i class="bi bi-list-nested"></i><span>Manage</span>
            </a>
          </li>
        
        </ul>
      </li><!-- End Category Nav -->
      
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

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Order-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard-check-fill"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Order-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>Order/view.php">
              <i class="bi bi-clipboard-check"></i><span>View All Orders</span>
            </a>
          </li>
           <li>
            <a href="<?= SYSTEM_PATH ?>Order/waiting.php">
              <i class="bi bi-clipboard-check"></i><span>View Order waiting list</span>
            </a>
          </li>
           <li>
            <a href="<?= SYSTEM_PATH ?>Order/approved.php">
              <i class="bi bi-clipboard-check"></i><span>View Approved Orders</span>
            </a>
          </li>
         
          
        </ul>
      </li><!-- End Order Nav -->
      
       <!--  Payment Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#pay-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash"></i><span>Payment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="pay-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= SYSTEM_PATH ?>payment/view.php">
              <i class="bi bi-cash-coin"></i><span>View</span>
            </a>
          </li>
           <li>
            <a href="<?= SYSTEM_PATH ?>payment/manage.php">
              <i class="bi bi-cash-stack"></i><span>Manage Payment</span>
            </a>
          </li>
         
          
        </ul>
      </li><!-- End Payment Nav -->
      
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
              <i class="bi bi-cash-stack"></i><span>Daily Report</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>Report/monthly.php">
              <i class="bi bi-cash-stack"></i><span>Monthly Report</span>
            </a>
          </li>
          <li>
            <a href="<?= SYSTEM_PATH ?>Report/yearly.php">
              <i class="bi bi-cash-stack"></i><span>Yearly Report</span>
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