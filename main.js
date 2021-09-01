const {app, BrowserWindow} = require('electron');
const path = require('path');
const url = require('url');

function createWindow() {
    const mainWindow = new BrowserWindow({
        width: 1200,
        height: 780,
        webPreferences: {
          nodeIntegration: true,
          nodeIntegrationInWorker: true
        }
    });

    mainWindow.webContents.session.clearCache(function() {
        //some callback.
    });
      
    mainWindow.loadURL('http://goodsstorage/authorization');
}

app.whenReady()
   .then(createWindow);

app.on('window-all-closed', function() {
    if (process.platform !== 'darwin') {
        app.quit();
    }
});
  
app.on('activate', function() {
    if (BrowserWindow.getAllWindows().length === 0) {
        createWindow();
    }
});










// const mysql = require('mysql2');
  
// const connection = mysql.createConnection({
//   host: 'localhost',
//   user: 'root',
//   database: 'irort_selam',
//   password: 'root'
// });

// connection.connect(function(error) {
//     if (error) {
//       return console.error(`Error: ${err.message}`);
//     } else {
//       console.log('Success!');
//     }
// });
