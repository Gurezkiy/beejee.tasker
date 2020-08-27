<script>
    const TASKS = <?php echo json_encode($params['tasks']); ?>;
</script>
<div class="container index">
    <div class="modal fade" id="task-add-modal" tabindex="-1" role="dialog" aria-labelledby="taskAddModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить новую задачу</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/tasks">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputEmail">Email адрес</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailError" placeholder="Введите email">
                            <small id="emailError" class="form-text text-danger">Некорректный email</small>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Ваше имя</label>
                            <input type="text"  name="name" class="form-control" id="inputName" aria-describedby="nameError" placeholder="Ваше имя">
                            <small id="nameError" class="form-text text-danger">Имя должно быть от 2 до 255 символов</small>
                        </div>
                        <div class="form-group">
                            <label for="inputTask">Задача</label>
                            <textarea class="form-control"  name="task" id="inputTask" aria-describedby="textError" rows="3"></textarea>
                            <small id="textError" class="form-text text-danger">Текст задачи может быть от 2 до 5000 символов</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary" id="saveNewTask">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row w-100">
        <div class="col-md-12 mx-auto text-center">
            <h2 class="title">Добро пожаловать в Tasker</h2>
            <h4 class="sub-title">Не упустите ничего!</h4>
        </div>
    </div>
    <div class="row mt-5 w-100">
        <div class="row align-self-center w-100">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body card-tasks">
                        <h5 class="card-title d-flex">
                            Задачи
                            <span class="flex-spacer"></span>
                            <button type="button" class="btn btn-primary" data-toggle="modal" id="openModalAdd">Добавить</button>
                        </h5>
                        <table class="table tasks">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <?php if($params['order'] != '-id' && $params['order'] != 'id'): ?>
                                        <span class="order-pos" data-order="id">
                                            #
                                        </span>
                                        <?php else: ?>
                                            #
                                    <?php endif; ?>
                                    <?php
                                        if($params['order'] == '-id'):
                                    ?>
                                        <i class="fas fa-arrow-down order-pos" data-order="id"></i>
                                    <?php endif; ?>

                                    <?php
                                    if($params['order'] == 'id'):
                                        ?>
                                        <i class="fas fa-arrow-up order-pos"  data-order="-id"></i>
                                    <?php endif; ?>
                                </th>
                                <th scope="col">
                                    <?php if($params['order'] != '-status' && $params['order'] != 'status'): ?>
                                        <span class="order-pos" data-order="status">
                                                Статус
                                            </span>
                                    <?php else: ?>
                                        Статус
                                    <?php endif; ?>
                                    <?php
                                    if($params['order'] == '-status'):
                                        ?>
                                        <i class="fas fa-arrow-down order-pos" data-order="status"></i>
                                    <?php endif; ?>

                                    <?php
                                    if($params['order'] == 'status'):
                                        ?>
                                        <i class="fas fa-arrow-up order-pos"  data-order="-status"></i>
                                    <?php endif; ?>
                                </th>
                                <th scope="col">
                                    <?php if($params['order'] != '-name' && $params['order'] != 'name'): ?>
                                        <span class="order-pos" data-order="name">
                                            Пользователь
                                        </span>
                                        <?php else: ?>
                                            Пользователь
                                    <?php endif; ?>
                                    <?php
                                    if($params['order'] == '-name'):
                                        ?>
                                        <i class="fas fa-arrow-down order-pos" data-order="name"></i>
                                    <?php endif; ?>

                                    <?php
                                    if($params['order'] == 'name'):
                                        ?>
                                        <i class="fas fa-arrow-up order-pos"  data-order="-name"></i>
                                    <?php endif; ?>
                                </th>
                                <th scope="col">
                                    <?php if($params['order'] != '-email' && $params['order'] != 'email'): ?>
                                            <span class="order-pos" data-order="email">
                                                Email
                                            </span>
                                            <?php else: ?>
                                                Email
                                    <?php endif; ?>
                                    <?php
                                    if($params['order'] == '-email'):
                                        ?>
                                        <i class="fas fa-arrow-down order-pos" data-order="email"></i>
                                    <?php endif; ?>

                                    <?php
                                    if($params['order'] == 'email'):
                                        ?>
                                        <i class="fas fa-arrow-up order-pos"  data-order="-email"></i>
                                    <?php endif; ?>
                                </th>
                                <th scope="col">
                                    Задача
                                </th>
                                <?php if(!is_null($user)): ?>
                                    <th scope="col">
                                        Редактировать
                                    </th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($params['tasks'] as $task):  ?>
                                <tr class="<?php if($task->completed) echo  'checked'; ?>" data-id="task-<?php echo $task->id; ?>">
                                    <td>
                                        <?php echo $task->id; ?>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input taskscheckbox"
                                                   data-id="<?php echo $task->id; ?>"
                                                   id="taskcheck-<?php echo $task->id; ?>"
                                                    <?php if(is_null($user)) echo  'disabled'; ?>
                                                    <?php if($task->completed) echo  'checked'; ?>>
                                            <label class="custom-control-label" for="taskcheck-<?php echo $task->id; ?>"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $task->name; ?>
                                    </td>
                                    <td>
                                        <?php echo $task->email; ?>
                                    </td>
                                    <td data-id="tasks-<?php echo $task->id; ?>-text">
                                        <?php echo $task->text; ?>
                                    </td>
                                    <?php if(!is_null($user)): ?>
                                        <td>
                                            <button type="button" class="btn btn-primary edit-task" data-id="<?php echo $task->id; ?>">Редактировать</button>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if($params['all'] > 1) : ?>
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <?php if($params['current'] > 1) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="\index\<?php
                                                    echo ($params['current'] - 1) . '?order=' . $params['order'];
                                                ?>">
                                                        Предыдущая
                                                </a>
                                        </li>
                                    <?php  endif; ?>
                                    <?php for($i = 1; $i <= $params['all']; $i++): ?>
                                        <li class="page-item  <?php if($i == $params['current']) echo 'active'; ?>">
                                            <a class="page-link" href="\index\<?php echo $i . '?order=' . $params['order'] ; ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                    <?php if($params['current'] < $params['all']) : ?>
                                        <li class="page-item"><a class="page-link" href="\index\<?php echo ($params['current'] + 1) . '?order=' . $params['order']; ?>">Следующая</a></li>
                                    <?php  endif; ?>
                                </ul>
                            </nav>
                        <?php  endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="\scripts\index.js"></script>
</div>