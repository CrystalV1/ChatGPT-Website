const express = require('express');
const multer = require('multer');
const path = require('path');
const app = express();
const port = 3000;

const storage = multer.diskStorage({
    destination: './uploads',
    filename: function(req, file, cb){
        cb(null,file.fieldname + '-' + Date.now() + path.extname(file.originalname));
    }
});

const upload = multer({
    storage: storage
}).single('video');

app.use(express.static('public'));

app.post('/upload', (req, res) => {
    upload(req, res, (err) => {
        if(err){
             res.send('Error uploading video');
        } else {
             res.send('Video uploaded successfully');
        }
    });
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});

