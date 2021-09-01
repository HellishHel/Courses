var config = config || {};

config.methodName = 'course';

config.deleteErrorMessage = 'Невозможно удалить выбранный курс, так как уже существуют заявки с этим курсом.';

config.searchDataPromise = [];
config.exceptFields = ['id', 'author_id', 'is_claim'];
config.additionFuelds = {};