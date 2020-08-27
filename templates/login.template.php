<div class="container-fluid ">
    <div class="row align-self-center w-100">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Авторизация</h5>
                    <?php if(isset($params['error'])): ?>
                        <h3 class="text-danger">Пользователь не найден</h3>
                    <?php endif; ?>
                    <form method="post" action="\login">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputName">Ваш логин</label>
                                <input type="text"  name="login" class="form-control" id="inputLogin" placeholder="Ваш логин">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Пароль</label>
                                <input type="password"  name="password" class="form-control" id="inputPassword" placeholder="Ваш пароль">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>