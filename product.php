<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/manager.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <title>ระบบจัดการข้อมูลสินค้า</title>
</head>

<body>
  <?php
  require_once('script/script.php');
  $db_handle = new myDBControl();
  $tsearch = '';
  if (isset($_GET['search'])) {
    $k = $_GET['search'];
    $tsearch = ' WHERE (Product_name LIKE "%' . $k . '%") OR (Category_id LIKE "' . $k . '")';
  }

  $limit = 5;
  $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
  $offset = ($page - 1) * $limit;

  // สร้างคำสั่ง SQL
  $sql = "SELECT * FROM Product_DATA";
  if (!empty($tsearch)) {
    $sql .= " $tsearch";
  }
  $sql .= " LIMIT $limit OFFSET $offset";

  $data = $db_handle->Textquery($sql);

  // หาจำนวนหน้า
  $count_sql = "SELECT COUNT(*) as total FROM Product_DATA";
  if (!empty($tsearch)) {
    $count_sql .= " $tsearch";
  }
  $total_rows = $db_handle->Textquery($count_sql)[0]['total'];
  $total_pages = ceil($total_rows / $limit);
  ?>

  <div class="container">
    <?php include('sidebar.php'); ?>

    <main class="main-content">
      <header class="header">
        <span>: ระบบจัดการข้อมูลสินค้า</span>
        <button class="add-employee" onclick="InsertClick()">➕ เพิ่มสินค้า</button>
      </header>

      <section class="table-container">
        <h3>ข้อมูลสินค้า</h3>
        <div class="section4">
          <div class="SLeft">
            <input type="text" placeholder="ระบุคำค้น" id="keyword">
            <button name="act" onclick="searchClick()">Search</button>
          </div>
          <div class="SRight">
            <?php $Typedetail = $db_handle->Textquery("SELECT * FROM ProductCategory;") ?>
            <select id="Stype" onchange="searchType()">
              <?php if (empty($Typedetail)) { ?>
                <option selected>ไม่มีประเภทสินค้า</option>
              <?php } else { ?>
                <option selected>เลือกประเภทสินค้า</option>
                <?php foreach ($Typedetail as $key => $value) { ?>
                  <option value="<?php echo $Typedetail[$key]["Category_id"]; ?>">
                    <?php echo $Typedetail[$key]["Category_name"]; ?>
                  </option>
              <?php }
              } ?>
            </select>
          </div>
        </div>

        <table>
          <thead>
            <tr>
              <th>รหัสสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th>รหัสหมวดหมู่สินค้า</th>
              <th>ราคา</th>
              <th>สถานะสินค้า</th>
              <th>รูปภาพสินค้า</th>
              <th>การจัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($data)) {
              foreach ($data as $key => $value) { ?>
                <tr>
                  <td><?= htmlspecialchars($value['Product_id'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Product_name'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Category_id'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Product_price'], ENT_QUOTES); ?></td>
                  <td><?= htmlspecialchars($value['Product_status'], ENT_QUOTES); ?></td>
                  <td>
                    <?php
                    if (file_exists(htmlspecialchars($value['Product_picture'], ENT_QUOTES))) { ?>
                      <img src="<?= htmlspecialchars($value['Product_picture'], ENT_QUOTES); ?>" alt="Product_picture">
                    <?php } else { ?>
                      <img src="img/about/02.jpg" alt="Product_picture">
                    <?php } ?>
                  </td>
                  <td>
                    <button type="button" class="edit-button"
                      onclick="editClick(<?= $key; ?>, '<?= htmlspecialchars(json_encode($value), ENT_QUOTES); ?>')">
                      แก้ไขข้อมูล
                    </button>
                    <button type="button" class="delete-button"
                      onclick="if(confirm('กรุณายืนยันการลบข้อมูล ?')) location.href='ProductProcess.php?st=del&Product_id=<?= $value['Product_id']; ?>'">
                      ลบข้อมูล
                    </button>
                  </td>
                </tr>
            <?php }
            } else {
              echo "<tr><td colspan='7' style='text-align:center;'>ไม่พบสินค้าในปัจจุบัน...</td></tr>";
            } ?>
          </tbody>
        </table>
        <?php
        $window_size = 4;

        // หาจำนวนกลุ่มหน้าทั้งหมด
        $total_windows = ceil($total_pages / $window_size);

        // หาหมายเลขกลุ่มของหน้าปัจจุบัน
        $current_window = ceil($page / $window_size);

        // หาหน้าเริ่มและจบของกลุ่มปัจจุบัน
        $start_page = ($current_window - 1) * $window_size + 1;
        $end_page = min($start_page + $window_size - 1, $total_pages);

        // เรียกพารามิเตอร์ search ถ้ามี
        $searchParam = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';
        ?>
        <div class="pagination">
          <?php if ($current_window > 1): ?>
            <a href="?page=<?php echo $start_page - 1 . $searchParam; ?>">«</a>
          <?php endif; ?>

          <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
            <a href="?page=<?php echo $i . $searchParam; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
              <?php echo $i; ?>
            </a>
          <?php endfor; ?>

          <?php if ($end_page < $total_pages): ?>
            <a href="?page=<?php echo $end_page + 1 . $searchParam; ?>">»</a>
          <?php endif; ?>
        </div>
      </section>
    </main>
  </div>

  <form action="ProductProcess.php" method="post" enctype="multipart/form-data">
    <div id="info1" class="info_Member" style="display: none;">
      <div class="info_Detail">
        <div class="infoLeft">
          <h4 id="topicname">เพิ่มข้อมูลสินค้าใหม่</h4>
          <input type="hidden" id="st" name="st">
          <div class="row">
            <label>รหัสสินค้า</label>
            <input type="text" id="Pid" name="Pid" maxlength="8" placeholder="รหัสสินค้า">
          </div>
          <div class="row">
            <label>ชื่อสินค้า</label>
            <input type="text" id="Pname" name="Pname" maxlength="50" placeholder="ชื่อสินค้า">
          </div>
          <div class="row">
            <label>รหัสหมวดหมู่สินค้า</label>
            <div class="row">
              <select id="PCatid" name="PCatid">
                <option value="">-- กรุณาเลือกหมวดหมู่สินค้า --</option>
                <?php
                $categoryData = $db_handle->Textquery("SELECT * FROM ProductCategory");
                foreach ($categoryData as $category) {
                  echo '<option value="' . htmlspecialchars($category['Category_id'], ENT_QUOTES) . '">' .
                    htmlspecialchars($category['Category_id'], ENT_QUOTES) . ' - ' .
                    htmlspecialchars($category['Category_name'], ENT_QUOTES) .
                    '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <label>ราคา</label>
            <input type="text" id="price" name="price" placeholder="ราคา">
          </div>
          <div class="row">
            <label>สถานะสินค้า</label>
            <input type="radio" id="status" name="status" value="1">
            <label for="status">พร้อมขาย</label><br>
            <input type="radio" id="status" name="status" value="2">
            <label for="status">หมด</label><br>
          </div>
        </div>
        <div class="infoRight">
          <p>รูปภาพสินค้า</p>
          <img src="img/p2.jpg" id="profileImg">
          <input type="file" name="Product_picture" accept="image/jpeg">
          <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
          <button type="button" class="btn btn-secondary" onclick="cancelClick()">ยกเลิก</button>
        </div>
      </div>
    </div>
  </form>

  <script>
    function InsertClick() {
      document.getElementById("info1").style.display = "flex";
      document.getElementById("topicname").innerText = "เพิ่มข้อมูลสินค้าใหม่";
      document.getElementById("st").value = 'add';
      document.querySelector("form").reset();
      document.getElementById("profileImg").src = "img/p2.jpg";
    }

    function cancelClick() {
      document.getElementById("info1").style.display = "none";
    }

    function editClick(index, dataJson) {
      let data = JSON.parse(dataJson);
      document.getElementById("info1").style.display = "flex";
      document.getElementById("topicname").innerText = "แก้ไขข้อมูลสินค้า";
      document.getElementById("st").value = 'edit';
      document.getElementById("Pid").value = data.Product_id;
      document.getElementById("Pname").value = data.Product_name;
      document.getElementById("PCatid").value = data.Category_id;
      document.getElementById("price").value = data.Product_price;
      document.getElementById("status").value = data.Product_status;
      document.getElementById("profileImg").src = data.Product_picture;
    }

    function searchClick() {
      let kword = document.getElementById('keyword').value;
      window.location = 'product.php?search=' + kword;
      console.log(kword);
    }

    function searchType() {
      var kword = document.getElementById('Stype').value;
      window.location = 'product.php?search=' + kword;
      console.log('Category id = ' + kword);
    }
  </script>
</body>

</html>