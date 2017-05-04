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
            <label class="col-lg-3 control-label">Владение англ. языком:</label>
            <div class="col-lg-8">
              <div class="ui-select">
              <select name="txt_step" class="form-control">
                <option><?php echo $userRo['st_lang']; ?></option>
                <option disabled>Выбрать</option>
                <option>Не владею</option>
                <option>Со словарем</option>
                <option>Разговорный уровень</option>
                <option>Средний уровень</option>
                <option>Свободное владение</option>
              </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Родной язык:</label>
            <div class="col-md-8">
              <input name="txt_lang" class="form-control" type="text" value="<?php echo $userRo['lang']; ?>">
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
              <button name="txt_save" class="btn btn-primary">Сохранить</button>
              <span></span>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
