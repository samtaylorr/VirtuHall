import os
from flask import Flask, request, flash, redirect, url_for
from werkzeug.utils import secure_filename

UPLOAD_FOLDER = '/uploads'
ALLOWED_EXTENSIONS = { 'txt', 'pdf', 'png', 'jpg', 'jpeg', 'gif', 'doc', 'docx', 'pdf' }

app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['SECRET_KEY'] = 'c4720248f1cf85571ba8a3ca';

def allowed_file(filename):
    return '.' in filename and \
           filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

@app.route('/ms/uploader', methods = [ 'POST' ])
def upload_file():
    print(request)
    # check if the post request has the file part
    if 'file' not in request.files:
        flash('No file part')
        return "No file part"
    file = request.files['file']
    # If the user does not select a file, the browser submits an
    # empty file without a filename.
    if file.filename == '':
        flash('No selected file')
        return "No selected file"
    if file and allowed_file(file.filename):
        filename = secure_filename(file.filename)
        file.save(os.path.join("../../public" + app.config['UPLOAD_FOLDER'], filename))
        return os.path.join(app.config['UPLOAD_FOLDER'], filename)

if __name__ == '__main__':
    app.run(debug = True)