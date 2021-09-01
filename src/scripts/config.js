var config = config || {};

config.apiGetFile = 'src/api/common/get.php';
config.apiPostFile = 'src/api/common/post.php';
config.apiUpdateFile = 'src/api/common/update.php';
config.apiReportFile = 'src/api/common/report.php';
config.apiDeleteFile = 'src/api/common/delete.php';

config.addBtn = document.getElementById('addNewBtn');
config.cancelBtn = document.getElementById('cancelBtn');
config.postBtn = document.getElementById('postBtn');
config.reportBtn = document.getElementById('reportBtn');
config.addForm = document.getElementById('addBlock');
config.searchInput = document.getElementById('searchInput');
config.inputs = document.querySelectorAll('[data-input="inputCtrl"]');
config.selects = document.querySelectorAll('[data-select]');
config.captions = document.querySelectorAll('[data-caption]');

config.iconUpdateClasses = 'fas fa-pencil-alt actionBtnTd editBtnTd';
config.iconDeleteClasses = 'fas fa-times actionBtnTd deleteBtnTd';

config.onUpdate = function () {};
config.onDelete = function () {};

config.letUpdate = [undefined, null].includes(config.letUpdate);
config.letDelete = [undefined, null].includes(config.letDelete);

config.searchDataPromise = [];

config.colorOk = '#94F945';
config.colorError = '#F95845';
