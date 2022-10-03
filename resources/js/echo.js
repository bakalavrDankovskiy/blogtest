Echo
    .private('admin-channel')
    .listen('.article_updated', (e) => {
        document
            .querySelector('#header')
            .insertAdjacentHTML("beforeend", '<div class="row justify-content-center">\n' +
                '        <div class="col-md-11">\n' +
                '            <div class="alert alert-success" role="alert">\n' +
                '                <button class="close" type="button" data-dismiss="alert" aria-label="Close">\n' +
                '                    <span aria-hidden="true">x</span>\n' +
                '                </button>\n' +
                `Статья ${e.article_id} была изменена.\n` +
                `<br>Измененные поля: "${e.updated_fields}".\n` +
                `<br><a href=${e.article_url}>Ссылка на статью</a>\n` +
                '            </div>\n' +
                '        </div>\n' +
                '    </div>');
    })
