$( document ).ready(() => {
    const email = $('#inputEmail');
    const name = $('#inputName');
    const task = $('#inputTask');
    const emailError = $('#emailError');
    const nameError = $('#nameError');
    const taskError = $('#textError');
    const saveButton = $('#saveNewTask');

    let hideErrors = () => {
        $(emailError).hide();
        $(nameError).hide();
        $(taskError).hide();
    };
    let reset = ()=> {
        $(email).val("");
        $(name).val("");
        $(task).val("");
        $(email).prop('disabled', false);
        $(name).prop('disabled', false);
        $(task).prop('disabled', false);
    };
    hideErrors();
    reset();

    let editedTask = null;
    $("#openModalAdd").click((ev) => {
        reset();
        hideErrors();
        editedTask = null;
        $('#task-add-modal').modal();
    });
    $("#task-add-modal").on('shown.bs.modal', () => {
        if(editedTask !== null) {
            $(email).val(editedTask.email);
            $(name).val(editedTask.name);
            $(task).val(editedTask.text);
            $(email).prop('disabled', true);
            $(name).prop('disabled', true);
        }
    });
    $(saveButton).click((e) => {
        hideErrors();
        const emailText = $(email).val();
        const nameText = $(name).val();
        const taskText = $(task).val();
        let error = false;

        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(emailText.toLowerCase())) {
            $(emailError).show();
            error = true;
        }
        if(nameText.length < 2 || nameText.length > 255) {
            $(nameError).show();
            error = true;
        }
        if(taskText.length < 2 || taskText.length > 5000) {
            $(taskError).show();
            error = true;
        }
        if(error) {
            e.preventDefault();
            e.stopPropagation();
        }
        if(editedTask !== null) {
            e.preventDefault();
            e.stopPropagation();
            $.ajax({

                url: "\\tasks\\" + editedTask.id,
                method: "POST", // Что бы воспользоваться POST методом, меняем данную строку на POST
                data: {
                    "task": taskText
                },
                success: (data) => {
                    data = JSON.parse(data);
                    editedTask.text = taskText;
                    $(`p[data-id='tasks-${data.data.id}-text']`).text(taskText);
                    $(`small[data-id='tasks-${data.data.id}-editted']`).show();
                    $('#task-add-modal').modal('hide');
                }
            });
        }
    });
    $('.edit-task').click((ev) => {
        editedTask = null;
        const id = $(ev.currentTarget).attr('data-id');
        for(let i = 0; i < TASKS.length; i++) {
           if(TASKS[i].id == id) {
               editedTask = TASKS[i];
               $('#task-add-modal').modal();
               break;
           }
        }
    });
    $('.taskscheckbox').click((ev)=>{
        let state = $(ev.currentTarget).is(':checked');
        const id = $(ev.currentTarget).attr('data-id');
        const tr = $(`tr[data-id="task-${id}"]`);
        if(state) {
            $(tr).addClass("checked");
        } else {
            $(tr).removeClass("checked");
        }

        $.ajax({

            url: "\\tasks\\" + id,
            method: "POST", // Что бы воспользоваться POST методом, меняем данную строку на POST
            data: {
                "state": state
            },
            success: (data) => {
                console.log(data); // Возвращаемые данные выводим в консоль
            },
            error: (e) => {
                state = !state;
                $(ev.currentTarget).prop('checked', state);
                if(state) {
                    $(tr).addClass("checked");
                } else {
                    $(tr).removeClass("checked");
                }
            }
        });
    });
    $('.order-pos').click((ev) => {
        const newOrder = $(ev.currentTarget).attr('data-order');
        const u = new URL(window.location);
        u.search = '?order=' + newOrder;
        window.location = u.toString();
    });
});