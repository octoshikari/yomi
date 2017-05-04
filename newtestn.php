<form role="form" method="post" action="">
    <div class="panel-body">
      <div class="input-group">
        <input type="text" class="form-control" name="txt_testname" value="<?php echo $_SESSION['curr_test'];?>" placeholder="Введите название теста" required>
        <div class="input-group-btn">
          <button class="btn btn-success" type="submit" name="txt_savetestname">Добавить</button>
        </div>
        </div>

</form>
