var config = config || {};

config.methodName = 'schedule';

config.deleteErrorMessage = 'Невозможно удалить выбранную категорию прав, так как уже существуют водитель с такой категорией.';

config.searchDataPromise = [];
config.exceptFields = ['id', 'is_lost'];