<div class="container" style="margin-top:80px">
  <h1 class="text-center h1-tbl">Профиль</h1>
  	<hr>
	<div class="row">
    <div class="col-md-12 personal-info">
      <!--<div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a>
          <i class="fa fa-coffee"></i>
          This is an <strong>.alert</strong>. Use this to show important messages to the user.
        </div>-->

        <form class="form-horizontal" role="form" method="post" action="">
          <div class="form-group">
            <label class="col-lg-3 control-label">Фамилия:</label>
            <div class="col-lg-8">
              <input name="txt_fullname" class="form-control" type="text" value="<?php echo $userRo['full_name']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Имя:</label>
            <div class="col-lg-8">
              <input name="txt_name" class="form-control" type="text" value="<?php echo $userRo['name']; ?>" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Отчество:</label>
            <div class="col-lg-8">
              <input name="txt_secname" class="form-control" type="text" value="<?php echo $userRo['sec_name']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input name="txt_email" class="form-control" type="text" value="<?php echo $userRow['user_email']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Ученая степень:</label>
            <div class="col-lg-8">
            <input name="txt_uch" class="form-control" type="text" value="<?php echo $userRo['uch_st']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Должность:</label>
            <div class="col-md-8">
              <input name="txt_dol" class="form-control" type="text" value="<?php echo $userRo['dol']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Имя пользователя:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" value="<?php echo $userRow['user_name']; ?>" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Пароль:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" value="<?php echo $userRow['user_pass']; ?>" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <button name="txt_savet" class="btn btn-primary">Сохранить</button>
              <span></span>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
